<?php
class Priority
{

    private $id;
    private $kuerzel;
    private $title;
    private $days;

    public function getID()
    {
        return $this->id;
    }
    public function getKuerzel()
    {
        return $this->kuerzel;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getDays()
    {
        return $this->days;
    }
    public function __toString(){
        return "<span class='badge badge-secondary ml-2'>{$this->getTitle()}</span>";
    }
}
