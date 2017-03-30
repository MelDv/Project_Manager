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
        //project-luokka
        $all = Project::all();
        $findProject = Project::find(1);

        Kint::dump($all);
        Kint::dump($findProject);

        //task-luokka
        $allTasks = Task::all();
        $findTask = Task::find(1);

        Kint::dump($allTasks);
        Kint::dump($findTask);

        //workers_tasks-luokka
//        $findMyTasks= Workers_tasks::findWorkersTasks(1);
//        
//        Kint::dump($findMyTasks);
        //person-luokka
        $findOne = Person::find(2);
        $persons = Person::all();
        $authorized_personnel = Person::findByActivity(true);

        Kint::dump($findOne);
        Kint::dump($persons);
        Kint::dump($authorized_personnel);
    }

    public static function etusivu() {
        View::make('projektit/etusivu.html');
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

    public static function kirjaudu() {
        View::make('kayttaja/kirjaudu.html');
    }

}
