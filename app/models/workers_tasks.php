<?php

include_once 'task.php';

class WorkersTasks extends BaseModel {

    public $id, $owner_task, $worker;

    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Workers_tasks (owner_task, worker) '
                . 'VALUES (:owner_task, :worker) RETURNING id');
        $query->execute(array('owner_task' => $this->owner_task, 'worker' => $this->worker));
        $row = $query->fetch();
        $this->id = $row['id'];
        Kint::dump($row);
    }

    public function destroy($owner_task) {
        $query = DB::connection()->prepare('DELETE FROM Workers_tasks WHERE owner_task = :owner_task ');
        $query->execute(array('owner_task' => $owner_task));
        $rows = $query->fetchAll();
        Kint::trace();
        Kint::dump($rows);
    }

    public static function findTasksByWorker($worker) {
        $query = DB::connection()->prepare('SELECT owner_task FROM Workers_tasks WHERE worker = :worker');
        $query->execute(array('worker' => $worker));
        $rows = $query->fetchAll();
        $tasks = array();

        foreach ($rows as $row) {
            $tasks[] = $row['owner_task'];
        }
        Kint::dump($rows);
        return $tasks;
    }

    public static function findWorkersByTask($owner_task) {
        $query = DB::connection()->prepare('SELECT worker FROM Workers_tasks WHERE owner_task = :owner_task');
        $query->execute(array('owner_task' => $owner_task));
        $rows = $query->fetchAll();
        $workers = array();

        foreach ($rows as $row) {
            $workers[] = $row['worker'];
        }
//        Kint::trace();
//        Kint::dump($rows);
        return $workers;
    }

}
