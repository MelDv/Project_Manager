<?php

class Task extends BaseModel {

    public $id, $project, $name, $current_status, $late, $description, $start_date, $deadline, $approved;

    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Task');
        $query->execute();

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
        return 'Task doesn\'t exist';
    }

}
