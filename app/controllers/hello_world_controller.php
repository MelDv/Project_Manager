<?php

class HelloWorldController extends BaseController {
//
//    public static function index() {
//        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
//        echo 'Tämä on etusivu!';
//    }

    public static function sandbox() {
        // Testaa koodiasi täällä
        //View::make('helloworld.html');
        //
        //testausta:

        $findOne = Person::find(2);
        $persons = Person::all();
        $authorized_personnel = Person::findActivePersons(true);

        Kint::dump($findOne);
        Kint::dump($persons);
        Kint::dump($authorized_personnel);
    }

    public static function etusivu() {
        View::make('projektit/etusivu.html');
    }

    public static function omasivu() {
        View::make('kayttaja/omasivu.html');
    }

    public static function omatTehtavat() {
        View::make('kayttaja/omattehtavat.html');
    }

    public static function projektit() {
        View::make('projektit/projektit.html');
    }

    public static function projekti() {
        View::make('projektit/projekti.html');
    }

    public static function tehtava() {
        View::make('projektit/tehtava.html');
    }

    public static function muokkaa_omasivu() {
        View::make('kayttaja/muokkaa_omasivu.html');
    }

    public static function kirjaudu() {
        View::make('kayttaja/kirjaudu.html');
    }

    public static function uusikayttaja() {
        View::make('kayttaja/uusikayttaja.html');
    }

//    public static function kayttajat() {
//        View::make('kayttaja/kayttajat.html');
//    }

    public static function muokkaa() {
        View::make('kayttaja/muokkaa.html');
    }

}
