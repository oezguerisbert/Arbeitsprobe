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
        $finishButton = $this->isFinished() ? "<button href='#' class='btn btn-primary' disabled>Erledigt</button>" : "<button onclick=\"location.href='./auftrag.php?id={$this->getID()}&m=f'\" class='btn btn-primary'>Erledigt</button>";
        $comments = $this->getComments();
        $kommentare = "";
        if (sizeof($comments) > 0) {
            foreach ($comments as $key => $comment) {
                $kommentare .= $comment;
            }

        } else {
            $kommentare = "<div class='mt-2 mb-2 col-md-12 p-4 vw-100 border bg-light rounded' style='border-color:#bfc0c0;'>
                <div class='p-2 text-center' style='color:#7f7f7f;'>Keine Kommentare. <a href='#' data-target='#commentModal' data-toggle='modal'>Hinzufügen?</a></div>
            </div>";
        }
        return "<div class='card vw-100'>
        <div class='card-body'>
          <h5 class='card-title d-flex'>{$this->getService()->getTitle()}<div class='ml-auto mr-auto'></div><span>Priorität:</span>{$this->getPriority()}</h5>
          <h6 class='card-subtitle mb-2 text-muted d-flex'>Anfrage von: @{$this->getUser()->getUsername()}</h6>
          <p class='card-text'>{$this->getService()->getDescription()}</p>
          {$kommentare}
          <div class='d-flex w-100 '>
            <div class='ml-auto'></div>
            " .
            ($this->isNew() ?
            "<a href='auftrag.php?id={$this->getID()}&m=c' class='fa fa-ban ml-2 text-danger text-decoration-none'></a>
                <a href='auftrag.php?id={$this->getID()}&m=e' class='fa fa-check ml-2 text-success text-decoration-none'></a>"
            :
            "<a href='auftrag.php?id={$this->getID()}&v={$v}' class='fa {$this->getVisibleIcon()} ml-auto text-secondary text-decoration-none'></a>" .
            ($this->isDeclined() ?
                "<div class='fa fa-ban ml-2 text-danger text-decoration-none'></div>"
                :
                "<div class='fa fa-check ml-2 text-success text-decoration-none'></div>"
            )
        ) . "
          </div>
          <div class='d-flex w-100 mt-4'>
            <div class='ml-auto'></div>
            {$replyButton}{$finishButton}
          </div>
        </div>
      </div>";
    }
    /**
     * Übergibt ob den Auftrag als Reihe für die Auflistung der Aufträge
     * 
     * @return string HTML-TableRow
     */
    public function toRow()
    {
        return "
            <tr style=\"cursor: pointer;\" onclick=\"location.href= './auftrag.php?id={$this->getID()}'\";>
                <th scope=\"row\">" . $this->getID() . "</th>
                <td>{$this->getUser()->getUsername()}</td>
                <td>{$this->getService()->getTitle()}</td>
                <td>{$this->getPriority()->getKuerzel()}</td>
            </tr>";
    }
}
