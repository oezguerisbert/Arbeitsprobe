<?php

/**
 * WarenkorbItem Klasse
 *
 * Diese Klasse representiert das Model von der Datenbanktabelle `kxi_cart_items`.
 */
class CartItem
{
    private $id;
    private $firstname;
    private $lastname;
    private $birthdate;
    private $height;
    private $serviceid;
    private $cartid;
    private $gender;

    /**
     * Übergibt die ID des Warenkorb-Items
     *
     * @return mixed id
     */
    public function getID()
    {
        return $this->id;
    }

    /**
     * Übergibt den Vornamen des Nutzers
     *
     * @return mixed firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Übergibt den Nachnamen des Nutzers
     *
     * @return mixed lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Übergibt den Geburtstag des Nutzers
     *
     * @return mixed birthdate
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Übergibt die Höhe des Nutzers
     *
     * @return mixed height
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Übergibt den Service des Warenkorb-Items
     *
     * @return mixed service
     */
    public function getService()
    {
        return ServiceRepository::find($this->serviceid);
    }
    /**
     * Übergibt das Geschlecht des Nutzers
     *
     * @return mixed gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Übergibt den Warenkorb des Warenkorb-Items
     *
     * @return Cart cart
     */
    public function getCart(): Cart
    {
        return CartRepository::find($this->cartid);
    }

    /**
     * Übergibt den Auftrag als fertiges HTML Konstrukt
     *
     * @return string HTML-Konstrukt
     */
    public function __toString()
    {

    }
}
