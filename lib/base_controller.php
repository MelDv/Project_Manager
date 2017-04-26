<?php

class BaseController {

    public static function get_user_logged_in() {
        // kirjautuneen käyttäjän haku tähän
        if (isset($_SESSION['person'])) {
            $person_id = $_SESSION['person'];
            $person = Person::find($person_id);
            return $person;
        }
        return null;
    }

    public static function check_logged_in() {
        // kirjautumisen tarkistus tähän.
        if (!isset($_SESSION['person'])) {
            Redirect::to('/kirjaudu', array('message' => 'Kirjaudu ensin sisään!'));
        }
    }

}
