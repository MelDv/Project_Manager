<?php

class PersonController extends BaseController {

    public static function index() {
        self::check_logged_in();
        $persons_count = Person::count();

        $page_size = 10;
        $pages = ceil($persons_count / $page_size);
        $page = (isset($_GET['page']) AND (int) $_GET['page'] > 0) ? (int) $_GET['page'] : 1;
        $prev_page = $page - 1;
        $next_page = $page + 1;

        if ($prev_page < 1) {
            $prev_page = null;
        } elseif ($next_page > $pages) {
            $next_page = null;
        }

        $persons = Person::all($page, $page_size);
        View::make('kayttaja/kayttajat.html', array('pages' => $pages, 'page' => $page, 'prev_page' => $prev_page,
            'next_page' => $next_page, 'page_size' => $page_size, 'persons' => $persons));
    }

    public static function kirjaudu() {
        View::make('kayttaja/kirjaudu.html');
    }

    public static function kirjaudu_ulos() {
        $_SESSION['person'] = null;
        Redirect::to('/', array('message' => 'Sinut on kirjattu ulos.'));
    }

    public static function kirjaudu_sisaan() {
        $params = $_POST;
        $person = Person::authenticate($params['email'], $params['password']);
        if (!$person) {
            View::make('kayttaja/kirjaudu.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'email' => $params['email']));
        } else {
            $_SESSION['person'] = $person->id;
            Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $person->name . '!'));
        }
    }

    public static function omasivu() {
        self::check_logged_in();
        View::make('kayttaja/omasivu.html');
    }

    //käyttäjän tietojen muokkaaminen
    public static function muokkaa_oma($id) {
        self::check_logged_in();
        $params = $_POST;
        $attributes = array(
            'id' => $id,
            'name' => $params['name'],
            'email' => $params['email'],
            'password' => $params['password'],
            'description' => $params['description']
        );
//        Kint::dump($params);
        $person = new Person($attributes);
        $errors = $person->errors();
        if (count($errors) > 0) {
            View::make('kayttaja/muokkaa_omasivu.html', array('errors' => $errors, 'person' => $person));
        } else {
            $person->update();
            Redirect::to('/kayttajat/' . $person->id, array('message' => 'Tiedot on päivitetty'));
        }
    }

    public static function muokkaa_muita($id) {
        self::check_logged_in();
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'name' => $params['name'],
            'email' => $params['email'],
            'password' => $params['password'],
            'active' => $params['active'],
            'current_rights' => $params['current_rights']
        );

        $person = new Person($attributes);
        $errors = $person->errors();
        if (count($errors) > 0) {
            View::make('kayttaja/muokkaa.html', array('errors' => $errors, 'person' => $person));
        } else {
            $person->updateRights();
            Redirect::to('/kayttajat/' . $person->id, array('message' => 'Käyttäjän tiedot päivitettiin'));
        }
    }

    //uuden käyttäjän lisääminen
    public static function uusi() {
        self::check_logged_in();
        $params = $_POST;
        $attributes = array(
            'name' => $params['name'],
            'email' => $params['email'],
            'password' => $params['password'],
            'active' => $params['active'],
            'current_rights' => $params['current_rights']
        );
//        Kint::dump($params);
        $person = new Person($attributes);
        $errors = $person->errors();

        if (Person::emailExists($params['email'])) {
            $errors[] = 'Sähköpostiosoite löytyy jo tietokannasta. Et voi luoda sille toista tiliä.';
        }
        if (count($errors) == 0) {
            $person->save();
            Redirect::to('/kayttajat/' . $person->id, array('message' => 'Käyttäjä lisättiin tietokantaan'));
        } else {
            array_unshift($errors, 'Antamissasi tiedoissa oli virheitä. ');
            View::make('kayttaja/muokkaa.html', array('errors' => $errors, 'person' => $person));
        }
    }

    //käyttäjän poistaminen
    public static function poista_kayttaja($id) {
        self::check_logged_in();
        $person = new Person(array('id' => $id));
        $nimi = Person::findName($id);
        $person->destroy($id);
        Redirect::to('/kayttajat', array('message' => 'Käyttäjä ' . $nimi . ' on poistettu'));
    }

    //lomakkeen näyttäminen
    public static function muokkaa_omasivu($id) {
        self::check_logged_in();
        $person = Person::find($id);
        View::make('kayttaja/muokkaa_omasivu.html', array('person' => $person));
    }

    //lomakkeen näyttäminen - admin
    public static function muokkaa_hlotietoja($id) {
        self::check_logged_in();
        $person = Person::find($id);
        View::make('kayttaja/muokkaa.html', array('person' => $person));
    }

    //käyttäjän esittelysivu
    public static function esittely($id) {
        self::check_logged_in();
        $person = Person::find($id);
        View::make('kayttaja/esittely.html', array('person' => $person));
    }

    //lomakkeen näyttäminen
    public static function uusikayttaja() {
        self::check_logged_in();
        View::make('kayttaja/muokkaa.html');
    }

}
