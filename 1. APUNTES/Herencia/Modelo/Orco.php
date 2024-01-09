<?php 

class Orco extends Elfo implements Metodos {

    private $cabreo;

    public function __construct($nombre, $edad, $arquero, $flechas,$ca)
    {
        parent::__construct($nombre, $edad, $arquero, $flechas);
        $this->cabreo = $ca;
        //$this->nombre = "SDFJLA";
    }

    function obligatorio()
    {
        
    }
}