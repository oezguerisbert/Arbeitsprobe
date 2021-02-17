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
    private $color;
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
     * Übergibt die Farbe der Priorität
     * 
     * @return string color
     */
    public function getColor()
    {
        return $this->color;
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
}
