<?php

class Project extends BaseModel {

    public $id, $manager, $name, $current_status, $late, $description, $start_date, $deadline, $approved;

    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Project');
        $query->execute();

        $rows = $query->fetchAll();
        $projects = array();

        foreach ($rows as $row) {
            $projects[] = new Project(array(
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
        }
        return $projects;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Project WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $project = new Project(array(
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
            return $project;
        }
        return 'Project doesn\'t exist';
    }

}
