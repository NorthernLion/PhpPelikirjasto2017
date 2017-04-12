<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();

      foreach($this->validators as $validator){
        $errors = array_merge($errors, $this->{$validator}());
      }

      return $errors;
    }
    
        public function validate_name() {
        $errors = array();
        if ($this->name == '' || $this->name == null) {
            array_push($errors, 'Nimi ei saa olla tyhjä!');
        }
        if (strlen($this->name) < 3) {array_push($errors, 'Nimen pituuden tulee olla vähintään kolme merkkiä!');
        }
        return $errors;
    }
    
    public function validate_published() {
        $errors = array();
        $published = DateTime::createFromFormat('Y-m-d', $this->published);
        $dateNow = DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
        if ($published === false) {
            array_push($errors, 'Julkaisu vuosi pitää kirjoittaa muodossa: Vuosi-Kuukausi-Päivä');
        }
        if ($published)
        return $errors;
    }
    
    public function validate_description() {
        $errors = array();
        if ($this->description == '' || $this->description == null) {
            array_push($errors, 'Kuvaus ei saa olla tyhjä!');
        }
        return $errors;
    }
  }
