<?php


/**
 * Auftrag Klasse
 * 
 * Diese Klasse representiert das Model von der Datenbanktabelle `kxi_auftraege`.
 */
class Auftrag
{
    private $id;
    private $userid;
    private $prioid;
    private $serviceid;
    private $request_date;
    private $moderatorid;
    private $visible;
    private $modeid;

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
     * Übergibt den Moderator des Auftrags
     * 
     * @return User user
     */
    public function getModerator()
    {
        return $this->moderatorid !== null ? UserRepository::find($this->moderatorid) : null;
    }

    /**
     * Übergibt die Priorität des Auftrags
     * 
     * @return Priority prioriät
     */
    public function getPriority(): Priority
    {
        return PriorityRepository::find($this->prioid);
    }

    /**
     * Übergibt den Service des Auftrags
     * 
     * @return Service service
     */
    public function getService(): Service
    {
        return ServiceRepository::find($this->serviceid);
    }

    /**
     * Übergibt das Datum des Auftrags
     * 
     * @return string datum
     */
    public function getRequestedDate(): string
    {
        return date("d.m.y - G:i", strtotime($this->request_date));
    }

    /**
     * Übergibt den Modus des Auftrags
     * 
     * @return Modus modus
     */
    public function getMode()
    {
        return ModusRepository::find($this->modeid);
    }
    /**
     * Übergibt den Modues des Auftrags via Kürzel
     * 
     * @return Modus modus
     */
    public function getModeAsKuerzel()
    {
        return ModusRepository::find($this->modeid)->getKuerzel();
    }

    /**
     * Übergibt ob der Auftrag neu erstellt wurde
     * 
     * @return boolean ist neu
     */
    public function isNew()
    {
        return ModusRepository::find($this->modeid)->getKuerzel() === "n";
    }

    /**
     * Übergibt ob der Auftrag abgelehnt wurde
     * 
     * @return boolean ist abgelehnt
     */
    public function isDeclined()
    {
        return ModusRepository::find($this->modeid)->getKuerzel() === "c";
    }

    /**
     * Übergibt ob der Auftrag verstellt ist
     * 
     * @return boolean ist versteckt
     */
    public function isHidden()
    {
        return !$this->isVisible();
    }

    /**
     * Übergibt ob der Auftrag akzeptiert wurde
     * 
     * @return boolean ist akzeptiert
     */
    public function isAccepted()
    {
        return ModusRepository::find($this->modeid)->getKuerzel() === "a";
    }

    /**
     * Übergibt die Kommentare des Auftrags
     * 
     * @return Kommentar[] kommentare-array
     */
    public function getComments()
    {
        $comments = KommentarRepository::findAllByID($this->getID());

        return $comments;
    }

    /**
     * Übergibt ob der Auftrag erledigt ist
     * 
     * @return boolean ist erledigt
     */
    public function isFinished()
    {
        return ModusRepository::find($this->modeid)->getKuerzel() === "f";
    }

    /**
     * Übergibt den Sichbarkeits-Icon für Font Awesome
     * 
     * @return string icon-class
     */
    public function getVisibleIcon()
    {
        return "fa-eye" . ($this->isVisible() ? "-slash" : "");
    }

    /**
     * Übergibt ob der Auftrag sichtbar ist
     * 
     * @return boolean ist sichtbar
     */
    public function isVisible()
    {
        return $this->visible;
    }
    /**
     * Übergibt den Auftrrag als fertiges HTML Konstrukt
     * 
     * @return string HTML-Konstrukt
     */
    public function __toString()
    {
        $v = $this->isVisible() ? 0 : 1;
        $replyButton = "<a href='#' data-target='#commentModal' data-toggle='modal' class='btn btn-secondary mr-2'>Kommentieren</a>";
        $denyButton = "<a href='auftrag.php?id={$this->getID()}&m=c' class='btn btn-danger mr-2'>Ablehnen</a>";
        $editButton = "<a href='#' data-target='#editModal' data-toggle='modal' class='btn btn-secondary mr-2'>Editieren</a>";
        $claimButton = $this->getModerator() === null ? "<a href='auftrag.php?id={$this->getID()}&claim' class='btn btn-secondary mr-2'>Claim</a>" : ($this->getModerator()->getID() !== $_SESSION['userid'] ? "<a href='' class='btn btn-secondary mr-2 disabled'>Claim</a>" : "");
        $showOptional = !$this->isFinished() && !$this->isDeclined() ? $editButton.$replyButton : "";
        $finishButton = $this->isFinished() || $this->isDeclined() ? "<button href='./' class='btn btn-primary' disabled>Erledigt</button>" : "<a href=\"./auftrag.php?id={$this->getID()}&m=f\" class='btn btn-primary'>Erledigt</a>";
        $allowCommentHref = (!$this->isFinished() && !$this->isDeclined()) ? "<a href='#' data-target='#commentModal' data-toggle='modal'>Hinzufügen?</a>" : "";
        $comments = $this->getComments();
        $kommentare = "";
        $showDeny = !$this->isDeclined() ? $denyButton : '';
        if (sizeof($comments) > 0) {
            foreach ($comments as $key => $comment) {
                $kommentare .= $comment;
            }

        } else {
            $kommentare = "<div class='mt-2 mb-2 col-md-12 p-4 border rounded' style='background:rgba(0,0,0,0.1);border-color:rgba(0,0,0,0.1) !important;'>
                <div class='p-2 text-center' style='color:rgba(0,0,0,0.5);'>Keine Kommentare. {$allowCommentHref}</div>
            </div>";
        }
        return "<div class='card vw-100 text-dark' style='background:{$this->getPriority()->getColor()};'>
        <div class='card-body'>
        <h5 class='card-title d-flex' style='font-size:1rem;'><span class='fa fa-clock mr-1 mt-1' style='font-size:0.8rem;'></span>{$this->getRequestedDate()} Uhr<div class='ml-auto mr-auto'></div></h5>
          <h5 class='card-title d-flex'>{$this->getService()->getTitle()}<div class='ml-auto mr-auto'></div><span style='font-size:1rem;'>@{$this->getUser()->getUsername()}</span></h5>
          <h6 class='card-subtitle mb-2 text-muted d-flex text-dark'>{$this->getService()->getDescription()}</h6>
          <p class='card-text'></p>
          {$kommentare}
          <div class='d-flex w-100 '>
            <div class='ml-auto'></div>
          </div>
          <div class='d-flex w-100 mt-4'>
            <div class='ml-auto'></div>
            {$claimButton}{$showOptional}{$showDeny}{$finishButton}
          </div>
        </div>
      </div>";
    }
    /**
     * Übergibt ob den Auftrag als Reihe für die Auflistung der Aufträge
     * 
     * @return string HTML-TableRow
     */
    public function toRow(bool $withModerator = true)
    {
        return "
            <tr style=\"cursor: pointer;background:{$this->getPriority()->getColor()}\" onclick=\"location.href= './auftrag.php?id={$this->getID()}'\";>
                <th scope=\"row\">" . $this->getID() . "</th>
                <td>{$this->getUser()->getUsername()}</td>
                <td>{$this->getService()->getTitle()}</td>
                <td>{$this->getPriority()->getKuerzel()} - {$this->getPriority()->getDays()} Tage</td>
                ".($withModerator ? "<td>".($this->getModerator() != null ? "@".$this->getModerator()->getUsername(): "<span style='color:gray;font-style:italic;'>not claimed</span>")."</td>" : "")."
            </tr>";
    }
}
