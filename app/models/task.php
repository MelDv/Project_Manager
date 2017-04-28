<?php

class Task extends BaseModel {

    public $id, $project, $name, $current_status, $late, $description, $start_date, $deadline, $approved;

    public function __construct($attributes = null) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_date');
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
        $query = DB::connection()->prepare('UPDATE Task SET (project, name, current_status, '
                . 'description, start_date, deadline) = (:project, :name, :current_status, '
                . ':description, :start_date, :deadline) WHERE id = :id');
        $query->execute(array('id' => $this->id, 'project' => $this->project, 'name' => $this->name, 'current_status' => $this->current_status,
            'description' => $this->description, 'start_date' => $this->start_date,
            'deadline' => $this->deadline));
        $row = $query->fetch();

        Kint::dump($row);
    }

    public function destroy($id) {
        WorkersTasks::destroy($id);
        $query = DB::connection()->prepare('DELETE FROM Task WHERE id= :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        Kint::dump($row);
    }

    public function ready($id) {
        $query = DB::connection()->prepare('UPDATE Task SET current_status=\'finished\' WHERE id = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        Kint::dump($row);
    }

    public function reassign($id) {
        $query = DB::connection()->prepare('UPDATE Task SET current_status=\'pending\' WHERE id = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        Kint::dump($row);
    }

    public function approve($id) {
        $query = DB::connection()->prepare('UPDATE Task SET approved=TRUE WHERE id = :id');
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

    public static function myActiveTasks($page, $page_size, $person) {
        if (!isset($page, $page_size)) {
            $page_size = 20;
            $page = 1;
        }
        $query = DB::connection()->prepare('SELECT Task.*, Workers_tasks.worker, Project.name AS project_name FROM Task '
                . 'INNER JOIN Workers_tasks ON Task.id = Workers_tasks.owner_task '
                . 'INNER JOIN Project ON Task.project = Project.id WHERE Workers_tasks.worker = :person '
                . 'AND Task.approved = FALSE ORDER BY late desc  LIMIT :limit OFFSET :offset');
        $query->execute(array('limit' => $page_size, 'offset' => $page_size * ($page - 1), 'person' => $person));
        $rows = $query->fetchAll();
        $tasks = array();

        foreach ($rows as $row) {
            $tasks[] = array(
                'id' => $row['id'],
                'project' => $row['project'],
                'name' => $row['name'],
                'current_status' => $row['current_status'],
                'late' => $row['late'],
                'description' => $row['description'],
                'start_date' => $row['start_date'],
                'deadline' => $row['deadline'],
                'approved' => $row['approved'],
                'project_name' => $row['project_name']
            );
        }
//        Kint::trace();
//        Kint::dump($rows);
        return $tasks;
    }

    public static function find($pid, $id) {
        $query = DB::connection()->prepare('SELECT Task.*, Project.name AS project_name, Project.manager, '
                . 'Workers_tasks.worker FROM Task LEFT JOIN Project ON Task.project = Project.id '
                . 'LEFT JOIN Workers_tasks on Task.id = Workers_tasks.owner_task WHERE Task.id = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $task = array(
                'id' => $id,
                'project' => $row['project'],
                'name' => $row['name'],
                'current_status' => $row['current_status'],
                'late' => $row['late'],
                'description' => $row['description'],
                'start_date' => $row['start_date'],
                'deadline' => $row['deadline'],
                'approved' => $row['approved'],
                'project_name' => $row['project_name'],
                'manager' => $row['manager']
            );
            $pid = $task['manager'];
            $manager_name = Person::findName($pid);
            $task['manager_name'] = $manager_name;

//            Kint::trace();
//            Kint::dump($row);
            return $task;
        }
        return null;
    }

    public static function findTask($id) {
        $query = DB::connection()->prepare('SELECT * FROM Task WHERE id = :id');
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
                'approved' => $row['approved'],
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

    public static function countByStatus($pid, $current_status) {
        $query = DB::connection()->prepare('SELECT name FROM Task WHERE project = :pid AND current_status = :current_status');
        $query->execute(array('pid' => $pid, 'current_status' => $current_status));
        $rows = $query->fetchAll();

        return count($rows);
    }

    public static function findByProject($project) {
        $query = DB::connection()->prepare('SELECT * FROM Task WHERE project = :project ORDER BY deadline, name');
        $query->execute(array('project' => $project));
        $rows = $query->fetchAll();
        $tasks = array();

        foreach ($rows as $row) {
            $tasks[] = array(
                'id' => $row['id'],
                'project' => $row['project'],
                'name' => $row['name'],
                'current_status' => $row['current_status'],
                'late' => $row['late'],
                'description' => $row['description'],
                'start_date' => $row['start_date'],
                'deadline' => $row['deadline'],
                'approved' => $row['approved']
            );
        }
        return $tasks;
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

    public static function findName($id) {
        $query = DB::connection()->prepare('SELECT Name FROM Task WHERE id = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $name = $row['name'];
            return $name;
        }
        return null;
    }

    public static function nameExists($name) {
        $query = DB::connection()->prepare('SELECT * FROM Task WHERE name = :name');
        $query->bindValue(':name', $name, PDO::PARAM_STR);
        $query->execute();
        $rows = $query->fetchAll();

        if ($rows == null) {
            return false;
        }
        return true;
    }

}
