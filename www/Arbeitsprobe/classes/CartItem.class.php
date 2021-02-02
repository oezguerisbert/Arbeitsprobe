<?php

/**
 * WarenkorbItem Klasse
 *
 * Diese Klasse representiert das Model von der Datenbanktabelle `kxi_cart_items`.
 */
class CartItem
{
    private $id;
    private $name;
    private $birthdate;
    private $height;
    private $cartid;
    private $serviceid;

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
     * Übergibt den Warenkorb des Auftrags
     *
     * @return Cart cart
     */
    public function getCart(): Cart
    {
        return CartRepository::find($this->cartid);
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
