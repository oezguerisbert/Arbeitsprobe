<?php

/**
 * Priority Klasse
 * 
 * Diese Klasse representiert das Model von der Datenbanktabelle `kxi_priorities`.
 */
class Priority
{

    private $id;
    private $kuerzel;
    private $title;
    private $days;

    /**
     * Übergibt die ID der Priorität
     * 
     * @return mixed id
     */
    public function getID()
    {
        return $this->id;
    }
    /**
     * Übergibt den Kürzel der Priorität
     * 
     * @return string kürzel
     */
    public function getKuerzel()
    {
        return $this->kuerzel;
    }
    /**
     * Übergibt den Titel der Priorität
     * 
     * @return string titel
     */
    public function getTitle()
    {
        return $this->title;
    }
    /**
     * Übergibt die Tage der Priorität
     * 
     * @return int tage
     */
    public function getDays()
    {
        return $this->days;
    }
    /**
     * Übergibt das HTML-Badge der Prorität
     * 
     * @return string HTML-Badge
     */
    public function __toString(){
        return "<span class='badge badge-secondary ml-2'>{$this->getTitle()}</span>";
    }
}
