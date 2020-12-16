<?php
class Service
{

    private $id;
    private $kuerzel;
    private $title;
    private $price;
    private $image;
    private $description;

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

    public function getPrice()
    {
        return $this->price;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getDescription()
    {
        return $this->description;
    }
    public function __toString(){
        return "<span class='badge badge-primary'>{$this->getTitle()}</span>";
    }
}
