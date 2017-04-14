<?php

class Task extends BaseModel {

    public $id, $project, $name, $current_status, $late, $description, $start_date, $deadline, $approved;

    public function __construct($attributes = null) {
        parent::__construct($attributes);
        $this->validators = array('validate_name');
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Task (project, name, current_status, late, '
                . 'description, start_date, deadline, approved) VALUES (:project, :name, :current_status, '
                . ':late, :description, :start_date, :deadline, :approved) RETURNING id');
        $query->execute(array('project' => $this->project, 'name' => $this->name, 'current_status' => $this->current_status,
            'late' => $this->late, 'description' => $this->description, 'start_date' => $this->start_date,
            'deadline' => $this->deadline, 'approved' => $this->approved));
        $row = $query->fetch();
//        Kint::trace();
//        Kint::dump($row);
        $this->id = $row['id'];
        Kint::dump($row);
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Tas SET (project, name, current_status, late, '
                . 'description, start_date, deadline, approved) = (:manager, :name, :current_status, '
                . ':late, :description, :start_date, :deadline, :approved) WHERE id = :id');
        $query->execute(array('project' => $this->project, 'name' => $this->name, 'current_status' => $this->current_status,
            'late' => $this->late, 'description' => $this->description, 'start_date' => $this->start_date,
            'deadline' => $this->deadline, 'approved' => $this->approved));
        $row = $query->fetch();

        Kint::dump($row);
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Task WHERE id= :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        Kint::dump($row);
    }

    public static function count() {
        $query = DB::connection()->prepare('SELECT * FROM Task');
        $query->execute();
        $rows = $query->fetchAll();

        return count($rows);
    }

    public static function all($page, $page_size) {
        if (!isset($page, $page_size)) {
            $page_size = 20;
            $page = 1;
        }
        $query = DB::connection()->prepare('SELECT * FROM Task ORDER BY project, deadline, name LIMIT :limit OFFSET :offset');
        $query->execute(array('limit' => $page_size, 'offset' => $page_size * ($page - 1)));
        $rows = $query->fetchAll();
        $tasks = array();

        foreach ($rows as $row) {
            $tasks[] = new Task(array(
                'id' => $row['id'],
                'project' => $row['project'],
                'name' => $row['name'],
                'current_status' => $row['current_status'],
                'late' => $row['late'],
                'description' => $row['description'],
                'start_date' => $row['start_date'],
                'deadline' => $row['deadline'],
                'approved' => $row['approved']
            ));
        }
//        Kint::trace();
//        Kint::dump($rows);
        return $tasks;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Task WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $task = new Task(array(
                'id' => $row['id'],
                'project' => $row['project'],
                'name' => $row['name'],
                'current_status' => $row['current_status'],
                'late' => $row['late'],
                'description' => $row['description'],
                'start_date' => $row['start_date'],
                'deadline' => $row['deadline'],
                'approved' => $row['approved']
            ));
            return $task;
        }
        return null;
    }

    public static function findByStatus($status) {
        $query = DB::connection()->prepare('SELECT * FROM Task WHERE current_status = :status ORDER BY project, deadline, name');
        $query->execute(array('current_status' => $status));
        $rows = $query->fetchAll();
        $projects = array();

        foreach ($rows as $row) {
            $tasks[] = new $tasks(array(
                'id' => $row['id'],
                'project' => $row['project'],
                'name' => $row['name'],
                'current_status' => $row['current_status'],
                'late' => $row['late'],
                'description' => $row['description'],
                'start_date' => $row['start_date'],
                'deadline' => $row['deadline'],
                'approved' => $row['approved']
            ));
            return $tasks;
        }
        return null;
    }

    public static function findByProject($project) {
        $query = DB::connection()->prepare('SELECT * FROM Task WHERE project = :project ORDER BY deadline, name');
        $query->execute(array('project' => $project));
        $rows = $query->fetchAll();
        $projects = array();

        foreach ($rows as $row) {
            $tasks[] = new $tasks(array(
                'id' => $row['id'],
                'project' => $row['project'],
                'name' => $row['name'],
                'current_status' => $row['current_status'],
                'late' => $row['late'],
                'description' => $row['description'],
                'start_date' => $row['start_date'],
                'deadline' => $row['deadline'],
                'approved' => $row['approved']
            ));
            return $tasks;
        }
        return null;
    }

    public static function findByStatus($manager) {
        $query = DB::connection()->prepare('SELECT * FROM Task WHERE manager = :manager ORDER BY project, deadline, name');
        $query->execute(array('manager' => $manager));
        $rows = $query->fetchAll();
        $projects = array();

        foreach ($rows as $row) {
            $tasks[] = new $tasks(array(
                'id' => $row['id'],
                'project' => $row['project'],
                'name' => $row['name'],
                'current_status' => $row['current_status'],
                'late' => $row['late'],
                'description' => $row['description'],
                'start_date' => $row['start_date'],
                'deadline' => $row['deadline'],
                'approved' => $row['approved']
            ));
            return $tasks;
        }
        return null;
    }

    public static function findByApproved($approved) {
        $query = DB::connection()->prepare('SELECT * FROM Task WHERE approved = :approved ORDER BY current_status, name');
        $query->bindValue(':approved', $approved, PDO::PARAM_BOOL);
        $query->execute();
        $rows = $query->fetchAll();
        $projects = array();

        foreach ($rows as $row) {
            $tasks[] = new $tasks(array(
                'id' => $row['id'],
                'project' => $row['project'],
                'name' => $row['name'],
                'current_status' => $row['current_status'],
                'late' => $row['late'],
                'description' => $row['description'],
                'start_date' => $row['start_date'],
                'deadline' => $row['deadline'],
                'approved' => $row['approved']
            ));
            return $tasks;
        }
        return null;
    }

    public static function findByLate() {
        $query = DB::connection()->prepare('SELECT * FROM Task WHERE late = TRUE ORDER BY deadline, name');
        $query->bindValue(':late', TRUE, PDO::PARAM_BOOL);
        $query->execute();
        $rows = $query->fetchAll();
        $projects = array();

        foreach ($rows as $row) {
            $tasks[] = new $tasks(array(
                'id' => $row['id'],
                'project' => $row['project'],
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
