<?php

/**
 * Warenkorb Klasse
 *
 * Diese Klasse representiert das Model von der Datenbanktabelle `kxi_auftraege`.
 */
class CartItem
{
    private $id;
    private $userid;
    private $name;
    private $birthdate;
    private $height;
    private $auftragid;

    /**
     * Übergibt die ID des Auftrags
     *
     * @return mixed id
     */
    public function getID()
    {
        return $this->id;
    }

    /**
     * Übergibt den User des Auftrags
     *
     * @return User user
     */
    public function getUser(): User
    {
        return UserRepository::find($this->userid);
    }

    /**
     * Übergibt den Auftrrag als fertiges HTML Konstrukt
     *
     * @return string HTML-Konstrukt
     */
    public function __toString()
    {

    }
}
