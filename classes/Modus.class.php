<?php
require_once "./repositories/User.repo.php";
require_once "./repositories/Service.repo.php";
require_once "./repositories/Priority.repo.php";
// require_once "../repositories/Auftrag.repo.php";
class Modus
{
    private $id;
    private $name;
    private $kuerzel;
    private $description;

    public function getID()
    {
        return $this->id;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getKuerzel()
    {
        return $this->kuerzel;
    }

    public function toArray(){
        return array(
            "id" => $this->id,
            "name" => $this->name,
            "kuerzel" => $this->kuerzel,
            "description" => $this->description
        );
    }
}
