<?php

include_once 'task.php';

class WorkersGroups extends BaseModel {

    public $id, $owner_person, $owner_group;

    public function __construct($attributes = null) {
        parent::__construct($attributes);
    }

    public static function findGroupsByPerson($person) {
        $query = DB::connection()->prepare('SELECT owner_group FROM Workers_groups WHERE owner_person = :person');
        $query->execute(array('owner_person' => $person));
        $rows = $query->fetchAll();

        foreach ($rows as $row) {
            $groups[] = array(
                'owner_group' => $row['owner_group']
            );
            return $groups;
        }

        return null;
    }

    public static function findPersonsByGroup($group) {
        $query = DB::connection()->prepare('SELECT owner_person FROM Workers_groups WHERE owner_group = :group');
        $query->execute(array('owner_group' => $group));
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
