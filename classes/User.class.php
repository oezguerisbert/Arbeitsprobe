<?php
class User
{
    private $id;
    private $username;
    private $vorname;
    private $nachname;
    private $email;
    private $phone;
    private $usertype = "user";
    private $createdAt;

    public function getID()
    {
        return $this->id;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getVorname()
    {
        return $this->vorname;
    }
    public function getNachname()
    {
        return $this->nachname;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPhone()
    {
        return $this->phone;
    }
    public function getUsertype()
    {
        return $this->usertype;
    }
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    public static function getUsertypes()
    {
        return array("user", "admin", "moderator");
    }
    public static function getSupervisedUsertypes()
    {
        return array("admin", "moderator");
    }
}
