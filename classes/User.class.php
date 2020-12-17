<?php
/**
 * User Klasse
 * 
 * Diese Klasse representiert das Model von der Datenbanktabelle `users`.
 */
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
    
    /**
     * Übergibt die ID des Users.
     * 
     * @return mixed id
     */
    public function getID()
    {
        return $this->id;
    }

    /**
     * Übergibt den Nutzernamen des Users
     * 
     * @return string username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Übergibt den Vornamen des Users
     * 
     * @return string vorname
     */
    public function getVorname()
    {
        return $this->vorname;
    }

    /**
     * Übergibt den Nachname des Users
     * 
     * @return string nachname
     */
    public function getNachname()
    {
        return $this->nachname;
    }

    /**
     * Übergibt die E-Mail des Users
     * 
     * @return string email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Übergibt die Telefonnummer des Users
     * 
     * @return string telefonnummer
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Übergibt den Usertypen des Users
     * 
     * Usertypen sind zu finden unter `User::getUsettypes()`
     * 
     * @return string usertype
     */
    public function getUsertype()
    {
        return $this->usertype;
    }

    /**
     * Übergibt das Erstelldatum des Users
     * 
     * @return string datum
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Übergibt die Usertypen (alle)
     * 
     * @return array usertypen
     */
    public static function getUsertypes()
    {
        return array("user", "admin", "moderator");
    }
    
    /**
     * Übergibt die Superviser-Usertypen.
     * 
     * @return array superviser-usertypen.
     */
    public static function getSupervisedUsertypes()
    {
        return array("admin", "moderator");
    }
}
