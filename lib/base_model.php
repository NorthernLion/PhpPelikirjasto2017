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
            $errors = array_merge($errors, $this->{$validator}());
        }

        return $errors;
    }

    public function validate_name() {
        $errors = array();
        if ($this->name == '' || $this->name == null) {
            array_push($errors, 'Nimi ei saa olla tyhjä!');
        }
        if (strlen($this->name) < 3) {
            array_push($errors, 'Nimen pituuden pitää olla vähintään kolme merkkiä!');
        }
        if (strlen($this->name) > 50) {
            array_push($errors, 'Nimen pituuden pitää olla enintään 50 merkkiä!');
        }

        return $errors;
    }

    public function validate_username() {
        $errors = array();
        if ($this->username == '' || $this->username == null) {
            array_push($errors, 'Nimi ei saa olla tyhjä!');
        }
        if (strlen($this->username) < 3) {
            array_push($errors, 'Nimen pituuden pitää olla vähintään kolme merkkiä!');
        }
        if (strlen($this->username) > 50) {
            array_push($errors, 'Nimen pituuden pitää olla enintään 50 merkkiä!');
        }

        return $errors;
    }

    public function validate_password() {
        $errors = array();
        if ($this->password == '' || $this->password == null) {
            array_push($errors, 'Salasana ei saa olla tyhjä!');
        }
        if (strlen($this->password) < 7) {
            array_push($errors, 'Salasanan pituuden pitää olla vähintään seitsemän merkkiä!');
        }
        if (strlen($this->password) > 50) {
            array_push($errors, 'Salasanan pituuden pitää olla enintään 50 merkkiä!');
        }
        if (!preg_match("#[0-9]+#", $this->password)) {
            array_push($errors, 'Salasanassa pitää olla ainakin yksi numero!');
        }
        if (!preg_match("#[A-Z]+#", $this->password)) {
            array_push($errors, 'Salasanassa pitää olla ainakin yksi suuri kirjain!');
        }
        if (!preg_match("#[a-z]+#", $this->password)) {
            array_push($errors, 'Salasanassa pitää olla ainakin yksi pieni kirjain!');
        }

        return $errors;
    }

    public function validate_published() {
        $errors = array();
        if (strtotime($this->published) === false) {
            array_push($errors, "Julkaisuaika on virheellinen!");
        }
        $published = DateTime::createFromFormat('Y-m-d', $this->published);
        if ($published === false) {
            array_push($errors, 'Julkaisu vuosi pitää kirjoittaa muodossa: Vuosi-Kuukausi-Päivä');
        }
        return $errors;
    }

    public function validate_description() {
        $errors = array();
        if ($this->description == '' || $this->description == null) {
            array_push($errors, 'Kuvaus ei saa olla tyhjä!');
        }
        if (strlen($this->description) > 10000) {
            array_push($errors, 'Kuvaus on liian pitkä!');
        }
        return $errors;
    }

}
