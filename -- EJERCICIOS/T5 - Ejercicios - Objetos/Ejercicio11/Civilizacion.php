<?php

class Civilizacion{
    public $nombre;
    public $rey;
    public $vida;
    public $almacen = [];

    public function __construct($nombre, $rey, $vida) {
        $this->nombre = $nombre;
        $this->rey = $rey;
        $this->vida = $vida;
        
    }


    public function getNombre()
    {
        return $this->nombre;
    }

    public function getRey()
    {
        return $this->rey;
    }

    public function getAlmacen()
    {
        return $this->almacen;
    }

    public function agregarItem($item) {
        $this->almacen[] = $item;
        
    }
    public function toArray() {
        return [
            "nombre" => $this->nombre,
            "rey" => $this->rey,
            "vida" => $this->vida
        ];
    }

 
}