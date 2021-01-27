<?php


/**
 * Modus Klasse
 * 
 * Diese Klasse representiert das Model von der Datenbanktabelle `kxi_auftrag_modus`.
 */
class Modus
{
    private $id;
    private $name;
    private $kuerzel;
    private $description;

    /**
     * Übergibt die ID des Modus
     * 
     * @return mixed id
     */
    public function getID()
    {
        return $this->id;
    }
    /**
     * Übergibt die Beschreibung des Modus
     * 
     * @return string beschreibung
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Übergibt den Namen des Modus
     * 
     * @return string name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Übergibt den Kürzel des Modus
     * 
     * @return string kürzel
     */
    public function getKuerzel()
    {
        return $this->kuerzel;
    }
/**
     * Übergibt das Object als Array
     * 
     * @return mixed array
     */
    public function toArray(){
        return array(
            "id" => $this->id,
            "name" => $this->name,
            "kuerzel" => $this->kuerzel,
            "description" => $this->description
        );
    }
}
