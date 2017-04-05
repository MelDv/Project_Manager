<?php

class BaseModel {

// "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null) {
// Käydään assosiaatiolistan avaimet läpi
        foreach ($attributes as $attribute => $value) {
// Jos avaimen niminen attribuutti on olemassa...
            if (property_exists($this, $attribute)) {
// ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }
    }

    public function errors() {
// Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
        $errors = array();

        foreach ($this->validators as $validator) {
// Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
            $errors = array_merge($errors, $this->{$validator}());
        }

        return $errors;
    }

    public function validate_name() {
        $errors = array();
        if ($this->name == '' || $this->name == null) {
            $errors[] = 'Nimi ei saa olla tyhjä!';
        }

        $length_bool = self::validate_length($this->name, 4);
        if ($length_bool == FALSE) {
            $errors[] = 'Nimen pitää olla vähintään neljä merkkiä pitkä.';
        }

        $slug = '/^[a-öA-Ö0-9- ]+$/';
        $slug_match = preg_match($slug, $this->name);
        if (!$slug_match) {
            $errors[] = 'Nimessä saa olla vain merkkejä a-ö, A-Ö, 0-9 välilyönti tai -';
        }

        return $errors;
    }

    public function validate_password() {
        $errors = array();
        if ($this->password == '' || $this->password == null) {
            $errors[] = 'Salasana ei saa olla tyhjä!';
        }

        $length_bool = self::validate_length($this->password, 7);
        if ($length_bool == FALSE) {
            $errors[] = 'Salasanan pitää olla vähintään seitsemän merkkiä pitkä. ';
        }

        $slug = '/^[a-öA-Ö0-9-&%+?!]+$/';
        $slug_match = preg_match($slug, $this->password);
        if (!$slug_match) {
            $errors[] = 'Salasanassa saa olla vain merkkejä a-ö, A-Ö, 0-9, tai -&%+?!';
        }

        return $errors;
    }

    public function validate_description() {
        $errors = array();
        if (mb_strlen($this->description, 'utf-8') > 2000) {
            $errors[] = 'Kuvaus voi olla enintään 2 000 merkkiä pitkä. ';
        }
        return $errors;
    }

    private function validate_length($string, $length) {
        if (mb_strlen($string, 'utf-8') < $length) {
            return false;
        } else {
            return true;
        }
    }

}
