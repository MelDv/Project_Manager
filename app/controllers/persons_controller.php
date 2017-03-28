<?php

class PersonController extends BaseController {

    public static function kayttajat() {
        View::make('kayttaja/kayttajat.html');
    }
    
    public static function muokkaa_hlotietoja($id) {
        $person = Person::find($id);
        View::make('kayttaja/muokkaa', array('person' => $person));
    }

    public static function index() {
        $persons = Person::all();
        View::make('kayttaja/kayttajat.html', array('persons' => $persons));
    }

}
