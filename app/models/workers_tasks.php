<?php

include_once 'task.php';

class WorkersTasks extends BaseModel {

    public $id, $owner_task, $worker;

    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }

    public static function findTasksByWorker($worker) {
        $query = DB::connection()->prepare('SELECT owner_task FROM Workers_tasks WHERE worker = :worker');
        $query->execute(array('worker' => $worker));
        $rows = $query->fetchAll();

        foreach ($rows as $row) {
            $tasks[] = array(
                'owner_task' => $row['owner_task']
            );
            return $tasks;
        }

        return null;
    }

    public static function findWorkerByTask($task) {
        $query = DB::connection()->prepare('SELECT worker FROM Workers_tasks WHERE owner_task = :task');
        $query->execute(array('owner_task' => $task));
        $rows = $query->fetchAll();

        foreach ($rows as $row) {
            $workers[] = array(
                'owner_task' => $row['owner_task']
            );
            return $workers;
        }

        return null;
    }

}
