<?php

/**
 * Service Klasse
 * 
 * Diese Klasse representiert das Model von der Datenbanktabelle `kxi_services`.
 */
class Service
{

    private $id;
    private $kuerzel;
    private $title;
    private $price;
    private $image;
    private $description;

    /**
     * Übergibt die ID des Service.
     * 
     * @return mixed id
     */
    public function getID()
    {
        return $this->id;
    }
    /**
     * Übergibt den Kürzel des Service.
     * 
     * @return string kürzel
     */
    public function getKuerzel()
    {
        return $this->kuerzel;
    }
    /**
     * Übergibt den Titel des Service.
     * 
     * @return string titel
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Übergibt den Preis des Service.
     * 
     * @return float preis
     */
    public function getPrice()
    {
        return $this->price;
    }
    /**
     * Übergibt das Bild des Service.
     * 
     * @return string url
     */
    public function getImage()
    {
        return $this->image;
    }
    /**
     * Übergibt die Beschreibung des Service.
     * 
     * @return mixed id
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Übergibt das HTML des Service.
     * 
     * @return string HTML-Badge
     */
    public function __toString(){
        return "<span class='badge badge-primary'>{$this->getTitle()}</span>";
    }
}
