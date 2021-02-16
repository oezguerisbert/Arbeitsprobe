<?php
class Cart
{
    private $id;
    private $userid;
    private $createdDate;
    private $isActive;

    /**
     * Übergibt die ID des Warenkorbs
     *
     * @return int id
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
    public function getUser()
    {
        return UserRepository::find(intval($this->userid));
    }

    /**
     * Übergibt die Items des Warenkorbs
     *
     * @return CartItem[] cartItems
     */
    public function getItems()
    {
        return CartItemRepository::findByCart($this->id);
    }

    /**
     * Fügt neue Warenkorb-Items hinzu
     *
     * @return resultat
     */
    public function addItem($item)
    {
        return CartItemRepository::create(array_merge(array(":cartid" => $this->getID()), $item));
    }

    /**
     * Löscht ein Warenkorb-Item
     *
     * @return resultat
     */
    public function removeItem(int $itemid)
    {
        return CartItemRepository::delete($itemid);
    }

    /**
     * Updated ein Warenkorb-Item
     *
     * @return resultat
     */
    public function updateItem(int $itemid, array $values)
    {
        return CartItemRepository::update($itemid, $values);
    }

    /**
     * Setzt einen Auftrag in die Datenbank ein
     *
     * @return resultat
     */
    public function submit(int $prioid, $date)
    {
        $task = AuftragRepository::create(array(":prioid" => $prioid, ":cartid" => $this->getID(), ":requestdate" => $date));
        if ($task) {
            CartRepository::deactivate($this->getID());
        } else {
            echo Errors::unkown("what");
        }
    }

}
