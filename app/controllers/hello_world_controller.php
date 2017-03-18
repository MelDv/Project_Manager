<?php

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        echo 'Tämä on etusivu!';
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
        View::make('helloworld.html');
    }
    
    public static function etusivu() {
        View::make('suunnitelmat/etusivu.html');
    }
        public static function omasivu() {
        View::make('suunnitelmat/omasivu.html');
    }
        public static function omatTehtavat() {
        View::make('suunnitelmat/omattehtavat.html');
    }
        public static function projektit() {
        View::make('suunnitelmat/projektit.html');
    }
        public static function projekti() {
        View::make('suunnitelmat/projekti.html');
    }
        public static function tehtava() {
        View::make('suunnitelmat/tehtava.html');
    }
}
