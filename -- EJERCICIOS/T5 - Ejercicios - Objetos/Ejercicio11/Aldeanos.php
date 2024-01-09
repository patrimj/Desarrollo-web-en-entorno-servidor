<?php

require_once (__DIR__.'Civilizacion.php');

class Aldeanos {

    public $nombre;
    public $salud;
    public $civilizacion;
    public $convertidoABizantino = false;

    public function __construct($nombre, $salud, $civilizacion) {
        $this->nombre = $nombre;
        $this->salud = $salud;
        $this->civilizacion = $civilizacion;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getSalud()
    {
        return $this->salud;
    }

    public function getCivilizacion()
    {
        return $this->civilizacion;
    }

    public function trabajar($mina) {
        $items = $mina->extraerItem();
        $this->civilizacion->agregarItem($items);
        
    }

    public function aBizantino(){ //para cambiar la civilización del aldeano a "Bizantinos" cuando sea convertido:
        $this->civilizacion = 'Bizantinos';
    }
}

