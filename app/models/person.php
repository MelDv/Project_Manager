<?php

class Person extends BaseModel {

    public $id, $name, $password, $email, $description, $active, $current_rights;

    public function __construct($attributes) {
        parent::__construct($attributes);
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
             return $persons;
        }

        return 'Personnel database is empty';
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

    public static function findActivePersons($active) {
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
