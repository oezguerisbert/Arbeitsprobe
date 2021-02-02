<?php
class Cart
{
    private $id;
    private $userid;
    private $cartid;
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
        return CartItemRepository::findByCart(intval($this->id));
    }
}