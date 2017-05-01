<?php

include_once 'task.php';

class WorkersGroups extends BaseModel {

    public $id, $owner_person, $owner_group;

    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Workers_groups (owner_person, owner_group) '
                . 'VALUES (:owner_person, :owner_group) RETURNING id');
        $query->execute(array('owner_person' => $this->owner_person, 'owner_group' => $this->owner_group));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function destroyByWorker($owner_person) {
        $query = DB::connection()->prepare('DELETE FROM Workers_groups WHERE owner_person= :owner_person');
        $query->execute(array('owner_person' => $owner_person));
        $row = $query->fetchAll();
    }

    public function destroyOne($owner_person, $owner_group) {
        $query = DB::connection()->prepare('DELETE FROM Workers_groups WHERE owner_person= :owner_person AND owner_group = :owner_group');
        $query->execute(array('owner_person' => $owner_person, 'owner_group' => $owner_group));
        $row = $query->fetch();
    }

    public static function findGroupsByPerson($owner_person) {
        $query = DB::connection()->prepare('SELECT Workers_groups.owner_group FROM Workers_groups '
                . 'WHERE owner_person = :owner_person');
        $query->execute(array('owner_person' => $owner_person));
        $rows = $query->fetchAll();
        $groups = array();

        foreach ($rows as $row) {
            $groups[] = $row['owner_group'];
        }
//            Kint::dump($rows);
        return $groups;
    }

    public static function findPersonsByGroup($owner_group) {
        $query = DB::connection()->prepare('SELECT owner_person FROM Workers_groups WHERE owner_group = :owner_group');
        $query->execute(array('owner_group' => $owner_group));
        $rows = $query->fetchAll();

        foreach ($rows as $row) {
            $persons[] = array(
                'owner_person' => $row['owner_person']
            );
            return $persons;
        }

        return null;
    }

}
