<?php

class Project extends BaseModel {

    public $id, $manager, $name, $current_status, $late, $description, $start_date, $deadline, $approved;

    public function __construct($attributes = null) {
        parent::__construct($attributes);
        $this->validators = array('validate_name');
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Project (manager, name, current_status, late, '
                . 'description, start_date, deadline, approved) VALUES (:manager, :name, :current_status, '
                . ':late, :description, :start_date, :deadline, :approved) RETURNING id');
        $query->execute(array('manager' => $this->manager, 'name' => $this->name, 'current_status' => $this->current_status,
            'late' => $this->late, 'description' => $this->description, 'start_date' => $this->start_date,
            'deadline' => $this->deadline, 'approved' => $this->approved));
        $row = $query->fetch();
//        Kint::trace();
//        Kint::dump($row);
        $this->id = $row['id'];
        Kint::dump($row);
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Project SET (manager, name, current_status, late, '
                . 'description, start_date, deadline, approved) = (:manager, :name, :current_status, '
                . ':late, :description, :start_date, :deadline, :approved) WHERE id = :id');
        $query->execute(array('manager' => $this->manager, 'name' => $this->name, 'current_status' => $this->current_status,
            'late' => $this->late, 'description' => $this->description, 'start_date' => $this->start_date,
            'deadline' => $this->deadline, 'approved' => $this->approved));
        $row = $query->fetch();

        Kint::dump($row);
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Project WHERE id= :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        Kint::dump($row);
    }

    public static function count() {
        $query = DB::connection()->prepare('SELECT * FROM Project');
        $query->execute();
        $rows = $query->fetchAll();

        return count($rows);
    }
  public static function allActive() {
        $query = DB::connection()->prepare('SELECT Project.*, Task.late AS task_late, Task.approved AS task_approved, '
                . 'Task.id AS task_id, Task.name AS task_name FROM Project LEFT JOIN Task ON Project.id = Task.project '
                . 'WHERE Project.approved = FALSE ORDER BY approved desc, deadline, name, task_approved');
        $query->execute();
        $rows = $query->fetchAll();
        $projects = array();

        foreach ($rows as $row) {
            $projects[] = array(
                'id' => $row['id'],
                'manager' => $row['manager'],
                'name' => $row['name'],
                'current_status' => $row['current_status'],
                'late' => $row['late'],
                'description' => $row['description'],
                'start_date' => $row['start_date'],
                'deadline' => $row['deadline'],
                'approved' => $row['approved'],
                'task_name' => $row['task_name'],
                'task_id' => $row['task_id'],
                'task_late' => $row['task_late'],
                'task_approved' => $row['task_approved']
            );
        }
//        Kint::trace();
//        Kint::dump($rows);
        return $projects;
    }

    public static function allClosed() {
        $query = DB::connection()->prepare('SELECT Project.id, Project.manager, Project.name, Project.description, Project.start_date, Person.name AS person_name FROM Project LEFT JOIN Person ON Project.manager = Person.id WHERE approved = TRUE ORDER BY name');
        $query->execute();
        $rows = $query->fetchAll();
        $projects = array();

        foreach ($rows as $row) {
            $projects[] = array(
                'id' => $row['id'],
                'manager' => $row['manager'],
                'name' => $row['name'],
                'description' => $row['description'],
                'start_date' => $row['start_date'],
                'person_name' => $row['person_name']
            );
        }
//        Kint::trace();
//        Kint::dump($rows);
        return $projects;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Project WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $project = new Project(array(
                'id' => $id,
                'manager' => $row['manager'],
                'name' => $row['name'],
                'current_status' => $row['current_status'],
                'late' => $row['late'],
                'description' => $row['description'],
                'start_date' => $row['start_date'],
                'deadline' => $row['deadline'],
                'approved' => $row['approved']
            ));
            return $project;
        }
        return null;
    }

    public static function findByStatus($status) {
        $query = DB::connection()->prepare('SELECT * FROM Project WHERE current_status = :status ORDER BY deadline, name');
        $query->execute(array('current_status' => $status));
        $rows = $query->fetchAll();
        $projects = array();

        foreach ($rows as $row) {
            $projects[] = new $projects(array(
                'id' => $row['id'],
                'manager' => $row['manager'],
                'name' => $row['name'],
                'current_status' => $row['current_status'],
                'late' => $row['late'],
                'description' => $row['description'],
                'start_date' => $row['start_date'],
                'deadline' => $row['deadline'],
                'approved' => $row['approved']
            ));
            return $projects;
        }
        return null;
    }

    public static function findByLate() {
        $query = DB::connection()->prepare('SELECT * FROM Project WHERE late = TRUE ORDER BY deadline, name');
        $query->bindValue(':late', TRUE, PDO::PARAM_BOOL);
        $query->execute();
        $rows = $query->fetchAll();
        $projects = array();

        foreach ($rows as $row) {
            $projects[] = new $projects(array(
                'id' => $row['id'],
                'manager' => $row['manager'],
                'name' => $row['name'],
                'current_status' => $row['current_status'],
                'late' => $row['late'],
                'description' => $row['description'],
                'start_date' => $row['start_date'],
                'deadline' => $row['deadline'],
                'approved' => $row['approved']
            ));
            return $projects;
        }
        return null;
    }

}
