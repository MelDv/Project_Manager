<?php

class Person extends BaseModel {

    public $id, $name, $password, $email, $description, $active, $current_rights;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_password', 'validate_description');
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Person (name, password, email, description, active, current_rights) VALUES (:name, :password, :email, :description, :active, :current_rights) RETURNING id');
        $query->execute(array('name' => $this->name, 'password' => $this->password, 'email' => $this->email, 'description' => $this->description, 'active' => $this->active, 'current_rights' => $this->current_rights));
        $row = $query->fetch();
//        Kint::trace();
//        Kint::dump($row);
        $this->id = $row['id'];
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Person');
        $query->execute();

        $rows = $query->fetchAll();
        $persons = array();

        foreach ($rows as $row) {
            $persons[] = new Person(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password'],
                'email' => $row['email'],
                'description' => $row['description'],
                'active' => $row['active'],
                'current_rights' => $row['current_rights']
            ));
        }
        return $persons;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Person WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $person = new Person(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password'],
                'email' => $row['email'],
                'description' => $row['description'],
                'active' => $row['active'],
                'current_rights' => $row['current_rights']
            ));
            return $person;
        }
        return 'Id doesn\'t exist';
    }

    public static function findByActivity($active) {
        $query = DB::connection()->prepare('SELECT * FROM Person WHERE active = :active');
        $query->bindValue(':active', $active, PDO::PARAM_BOOL);
        $query->execute();
        $rows = $query->fetchAll();
        $persons = array();

        foreach ($rows as $row) {
            $persons[] = new Person(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password'],
                'email' => $row['email'],
                'description' => $row['description'],
                'active' => $row['active'],
                'current_rights' => $row['current_rights']
            ));
            return $persons;
        }
        return 'No active personnel';
    }

}
