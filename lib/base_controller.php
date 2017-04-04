<?php

  class BaseController{

    public static function get_user_logged_in(){
        if(isset($_SESSION['user'])){
            $user_id = $_SESSION['user'];
            $user = User::find($user_id);

            return $user;
        }

      return null;
    }

    public static function check_logged_in(){
      // Toteuta kirjautumisen tarkistus tähän.
      // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
    }
 // Siirrytään seuraavaksi kansiossa lib sijaitsevaan tiedostoon base_controller.php, jossa sijaitsee kaikkien kontrollerien yläluokka BaseController. Luokasta löytyy pohja metodille get_user_logged_in. Toteutetaan metodi niin, että se palauttaa sovellukseemme kirjautuneen käyttäjän oliona, jotta voimme käyttää tietoa kirjautuneesta käyttäjästä näkymissä ja kontrollereissa. Olen toteuttanut sovellukseni käyttäjiä kuvaavan User-malliluokan ja sille find-metodin, joka hakee tietokannasta käyttäjä parametrina annetulla id:llä, jolloin oma totetukseni metodista on seuraava:

  }
