<?php

class PersonController extends BaseController {

    public static function index() {
        $persons = Person::all();
        View::make('kayttaja/kayttajat.html', array('persons' => $persons));
    }

    public static function omasivu($id) {
        $person = Person::find($id);
        View::make('kayttaja/omasivu.html', array('person' => $person));
    }

    public static function muokkaa_hlotietoja($id) {
        $person = Person::find($id);
        View::make('kayttaja/muokkaa_omasivu.html', array('person' => $person));
    }

    public static function uusikayttaja() {
        View::make('kayttaja/uusikayttaja.html');
    }

    //POST
    public static function uusi() {
        $params = $_POST;
        $person = new Person(array(
            'active' => $params['active'],
            'name' => $params['name'],
            'email' => $params['email'],
            'password' => $params['password'],
            'current_rights' => $params['current_rights']
        ));
//        Kint::dump($params);
        $person->save();
        Redirect::to('/kayttajat/' . $person->id, array('message' => 'Käyttäjä on lisätty tietokantaan'));
    }

    public static function muokkaa_omasivu() {
        View::make('kayttaja/muokkaa_omasivu.html');
    }

}
