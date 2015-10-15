<?php

namespace carriera\GratkaWebapiDom;

class GratkaWebapiDaneDostepowe {

    /**
     * @var string
     */
    private $login;
    /**
     * @var string
     */
    private $haslo;
    /**
     * @var string
     */
    private $klucz_webapi;
    /**
     * @var integer
     */
    private $id_kategorii;
    /**
     * @var integer
     */
    private $wersja;

    /**
     * @param string $login
     * @return self
     */
    public function ustaw_login($login) {
        $this->login = (string) $login;
        return $this;
    }

    /**
     * @return string
     */
    public function pobierz_login() {
        return $this->login;
    }

    /**
     * @param string $haslo
     * @return self
     */
    public function ustaw_haslo($haslo) {
        $this->haslo = (string) $haslo;
        return $this;
    }

    /**
     * @return string
     */
    public function pobierz_haslo() {
        return $this->haslo;
    }

    /**
     * @param string $klucz
     * @return self
     */
    public function ustaw_klucz_webapi($klucz) {
        $this->klucz_webapi = (string) $klucz;
        return $this;
    }

    /**
     * @return string
     */
    public function pobierz_klucz_webapi() {
        return $this->klucz_webapi;
    }

    /**
     * @param integer $id_kategorii
     * @return self
     */
    public function ustaw_id_kategorii($id_kategorii) {
        $this->id_kategorii = (int) $id_kategorii;
        return $this;
    }

    /**
     * @return integer
     */
    public function pobierz_id_kategorii() {
        return $this->id_kategorii;
    }

    /**
     * @param integer $wersja
     * @return self
     */
    public function ustaw_wersje($wersja) {
        $this->wersja = (int) $wersja;
        return $this;
    }

    /**
     * @return integer
     */
    public function pobierz_wersje() {
        return $this->wersja;
    }

}
