<?php
require_once "./repositories/User.repo.php";
require_once "./repositories/Auftrag.repo.php";

/**
 * Kommentar Klasse
 * 
 * Diese Klasse representiert das Model von der Datenbanktabelle `kxi_auftrag_kommentare`.
 */
class Kommentar
{
    private $id;
    private $userid;
    private $auftragid;
    private $content;
    private $addedAt;

    /**
     * Übergibt die ID des Kommentars
     * 
     * @return mixed id
     */
    public function getID()
    {
        return $this->id;
    }

    /**
     * Übergibt den User des Kommentars
     * 
     * @return User user
     */
    public function getUser()
    {
        return UserRepository::find($this->userid);
    }

    /**
     * Übergibt den Auftrag des Kommentars
     * 
     * @return Auftrag auftrag
     */
    public function getAuftrag()
    {
        return AuftragRepository::find($this->auftragid);
    }

    /**
     * Übergibt den Inhalt des Kommentars
     * 
     * @return string inhalt
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Übergibt das Datum des hinzufügens
     * 
     * @return string datum
     */
    public function getAddedAt()
    {
        return $this->addedAt;
    }

    /**
     * Übergibt das HTML des Commentars
     * 
     * @return string HTML
     */
    public function __toString()
    {
        return "<div class='p-3 text-dark rounded mb-3' style='background-color:#ced5dc;'>
                    <span>{$this->getContent()}</span>
                    <br />
                    <br />
                    <span><small>" . strftime('%d. %b %Y , %H:%M', strtotime($this->getAddedAt())) . " - <strong>@{$this->getUser()->getUsername()}</strong></small></span>
                </div>";
    }
}