<?php
require_once "./repositories/User.repo.php";
require_once "./repositories/Auftrag.repo.php";
class Kommentar
{
    private $id;
    private $userid;
    private $auftragid;
    private $content;
    private $addedAt;

    public function getID()
    {
        return $this->id;
    }
    public function getUser()
    {
        return UserRepository::find($this->userid);
    }
    public function getAuftrag()
    {
        return AuftragRepository::find($this->auftragid);
    }
    public function getContent()
    {
        return $this->content;
    }
    public function getAddedAt()
    {
        return $this->addedAt;
    }

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
