<?php

namespace carriera\GratkaWebapiDom;

class GratkaWebapiDom {

/**
* @var SoapClient
*/
private $klient;
/**
* @var GratkaWebapiDaneDostepowe
*/
private $dane_dostepowe;
private $id_sesji;
const BLAD_NIEPOPRAWNE_ID_SESJI = 33;

public function __construct(GratkaWebapiDaneDostepowe $dane_dostepowe,
$wsdl = 'http://soap.webapi-beta.gratka.pl/dom.html?wsdl') {
$this->dane_dostepowe = $dane_dostepowe;
$this->klient = $this->utworz_klienta($wsdl);
}

protected function utworz_klienta($wsdl) {
return new \Zend\Soap\Client($wsdl, array(
'cache_wsdl' => WSDL_CACHE_DISK,
));
}

public function ustaw_id_sesji($id) {
$this->id_sesji = (string) $id;
}

public function pobierz_id_sesji() {
return $this->id_sesji;
}

/**
* Wysyła żądanie z zadbaniem o przekazanie o ID sesji, oraz w razie potrzeby loguje użytkownika
* @param string $metoda
* @param array $argumenty
* @return mixed
*/
protected function wywolaj_z_zadbaniem_o_zalogowanie($metoda, array $argumenty = array(), $numer_wywolania = 0) {
if (!$this->pobierz_id_sesji()) {
$this->zaloguj();
}
try {
$argumenty_kopia = $argumenty;
array_unshift($argumenty_kopia, $this->pobierz_id_sesji());
$wynik = call_user_func_array(array($this->klient, $metoda), $argumenty_kopia);
return $wynik;
} catch (SoapFault $fault) {
if ($numer_wywolania > 0 || $fault->getCode() != self::BLAD_NIEPOPRAWNE_ID_SESJI) {
throw $fault;
} else {
$this->zaloguj();
$this->wywolaj_z_zadbaniem_o_zalogowanie($metoda, $argumenty, ($numer_wywolania + 1));
}
}
}

/**
* Loguje użytkownika na podstawie wcześniejszych podanych danych dostępowych
* @return array
*/
public function zaloguj() {
$login = $this->dane_dostepowe->pobierz_login();
$haslo = $this->dane_dostepowe->pobierz_haslo();
$klucz_webapi = $this->dane_dostepowe->pobierz_klucz_webapi();
$id_kategoria = $this->dane_dostepowe->pobierz_id_kategorii();
$wersja_webapi = $this->dane_dostepowe->pobierz_wersje();

$wynik = $this->klient->zaloguj($login, $haslo, $klucz_webapi, $id_kategoria, $wersja_webapi);
$this->id_sesji = $wynik['sesja'];
return $wynik;
}

public function pobierz_pola($id_kategoria) {
$argumenty = func_get_args();
return $this->wywolaj_z_zadbaniem_o_zalogowanie(__FUNCTION__, $argumenty);
}

public function dodaj_zdjecie($id_kategoria, $id_ogloszenie, $url_zdjecia) {
$argumenty = func_get_args();
return $this->wywolaj_z_zadbaniem_o_zalogowanie(__FUNCTION__, $argumenty);
}

public function aktualizuj_ogloszenie($id_kategoria, array $ogloszenie) {
$argumenty = func_get_args();
return $this->wywolaj_z_zadbaniem_o_zalogowanie(__FUNCTION__, $argumenty);
}

public function dodaj_ogloszenie($id_kategoria, array $ogloszenie) {
$argumenty = func_get_args();
return $this->wywolaj_z_zadbaniem_o_zalogowanie(__FUNCTION__, $argumenty);
}

public function dodaj_zdjecie_base64($id_kategoria, $id_ogloszenie, $zdjecie_base64) {
$argumenty = func_get_args();
return $this->wywolaj_z_zadbaniem_o_zalogowanie(__FUNCTION__, $argumenty);
}

public function importuj_ogloszenia($id_kategoria, array $opcje) {
$argumenty = func_get_args();
return $this->wywolaj_z_zadbaniem_o_zalogowanie(__FUNCTION__, $argumenty);
}

public function pobierz_liste_id_ogloszen_usunietych($id_kategoria) {
$argumenty = func_get_args();
return $this->wywolaj_z_zadbaniem_o_zalogowanie(__FUNCTION__, $argumenty);
}

public function pobierz_ilosc_dostepnych_punktow() {
return $this->wywolaj_z_zadbaniem_o_zalogowanie(__FUNCTION__);
}

public function pobierz_kategorie($id_kategoria) {
$argumenty = func_get_args();
return $this->wywolaj_z_zadbaniem_o_zalogowanie(__FUNCTION__, $argumenty);
}

public function pobierz_liste_id_ogloszen($id_kategoria) {
$argumenty = func_get_args();
return $this->wywolaj_z_zadbaniem_o_zalogowanie(__FUNCTION__, $argumenty);
}

public function pobierz_liste_slownikow($id_kategoria) {
$argumenty = func_get_args();
return $this->wywolaj_z_zadbaniem_o_zalogowanie(__FUNCTION__, $argumenty);
}

public function pobierz_ogloszenie($id_kategoria, $id_ogloszenie) {
$argumenty = func_get_args();
return $this->wywolaj_z_zadbaniem_o_zalogowanie(__FUNCTION__, $argumenty);
}

public function pobierz_slownik($nazwa, $id_kategoria, $dane) {
$argumenty = func_get_args();
return $this->wywolaj_z_zadbaniem_o_zalogowanie(__FUNCTION__, $argumenty);
}

public function usun_ogloszenie($id_kategoria, $id_ogloszenie) {
$argumenty = func_get_args();
return $this->wywolaj_z_zadbaniem_o_zalogowanie(__FUNCTION__, $argumenty);
}

public function usun_zdjecie($id_kategoria, $id_ogloszenie, $nr_zdjecia) {
$argumenty = func_get_args();
return $this->wywolaj_z_zadbaniem_o_zalogowanie(__FUNCTION__, $argumenty);
}

public function wyroznij_ogloszenie($id_kategoria, $id_ogloszenie, $liczba_punktow) {
$argumenty = func_get_args();
return $this->wywolaj_z_zadbaniem_o_zalogowanie(__FUNCTION__, $argumenty);
}

public function aktualizuj_inwestycje(array $inwestycja) {
$argumenty = func_get_args();
return $this->wywolaj_z_zadbaniem_o_zalogowanie(__FUNCTION__, $argumenty);
}

public function aktualizuj_kontakt(array $dane_kontaktu) {
$argumenty = func_get_args();
return $this->wywolaj_z_zadbaniem_o_zalogowanie(__FUNCTION__, $argumenty);
}

public function dodaj_inwestycje(array $inwestycja) {
$argumenty = func_get_args();
return $this->wywolaj_z_zadbaniem_o_zalogowanie(__FUNCTION__, $argumenty);
}

public function dodaj_kontakt(array $dane_kontaktu) {
$argumenty = func_get_args();
return $this->wywolaj_z_zadbaniem_o_zalogowanie(__FUNCTION__, $argumenty);
}

public function dodaj_wideo($id_kategoria, $id_ogloszenie, $url_wideo) {
$argumenty = func_get_args();
return $this->wywolaj_z_zadbaniem_o_zalogowanie(__FUNCTION__, $argumenty);
}

public function pobierz_inwestycje($id) {
$argumenty = func_get_args();
return $this->wywolaj_z_zadbaniem_o_zalogowanie(__FUNCTION__, $argumenty);
}

public function pobierz_kontakt($id) {
$argumenty = func_get_args();
return $this->wywolaj_z_zadbaniem_o_zalogowanie(__FUNCTION__, $argumenty);
}

public function pobierz_liste_id_kontaktow() {
return $this->wywolaj_z_zadbaniem_o_zalogowanie(__FUNCTION__, $argumenty);
}

public function pobierz_liste_id_ogloszen_kontaktu($id_kategoria, $id_kontakt) {
$argumenty = func_get_args();
return $this->wywolaj_z_zadbaniem_o_zalogowanie(__FUNCTION__, $argumenty);
}

public function pobierz_liste_id_ogloszen_z_inwestycji($id_inwestycja) {
$argumenty = func_get_args();
return $this->wywolaj_z_zadbaniem_o_zalogowanie(__FUNCTION__, $argumenty);
}

public function pobierz_liste_wideo($id_kategoria, $id_ogloszenie) {
$argumenty = func_get_args();
return $this->wywolaj_z_zadbaniem_o_zalogowanie(__FUNCTION__, $argumenty);
}

public function usun_inwestycje($id) {
$argumenty = func_get_args();
return $this->wywolaj_z_zadbaniem_o_zalogowanie(__FUNCTION__, $argumenty);
}

public function usun_kontakt($id) {
$argumenty = func_get_args();
return $this->wywolaj_z_zadbaniem_o_zalogowanie(__FUNCTION__, $argumenty);
}

public function usun_wideo($id_kategoria, $id_ogloszenie, $id_wideo) {
$argumenty = func_get_args();
return $this->wywolaj_z_zadbaniem_o_zalogowanie(__FUNCTION__, $argumenty);
}

public function usun_zdjecie_id($id_kategoria, $id_ogloszenie, $id) {
$argumenty = func_get_args();
return $this->wywolaj_z_zadbaniem_o_zalogowanie(__FUNCTION__, $argumenty);
}

}
