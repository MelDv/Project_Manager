<?php

include_once 'task.php';

class Workers_tasks extends BaseModel {

    public $id, $owner_task, $worker;

    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }

    public static function findTaskIDs($worker) {
        $query = DB::connection()->prepare('SELECT owner_task FROM Workers_tasks WHERE worker = :worker LIMIT 1');
        $query->execute(array('worker' => $worker));
        $rows = $query->fetchAll();

//        
//        foreach ($rows as $row) {
//            $tasks[] = new Workers_tasks(array(
//                'owner_task'=>$row['owner_task']
//            ));
//            return $tasks;
//        }
        $tasks = array(findTaskByID($rows));
        return $tasks;
    }

    public static function findTaskByID($array) {
        $tasks = array();

        foreach ($array as $task) {
            $tasks[] = new Task(find($task));
        }
    }

}
