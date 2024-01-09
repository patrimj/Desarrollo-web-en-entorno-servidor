<?php

require_once (__DIR__.'Civilizacion.php');
require_once (__DIR__.'Aldeanos.php');

class Bizantinos extends Aldeanos {
    
    public function __construct($nombre) {
        parent::__construct($nombre, 250, new Civilizacion("Bizantinos", "Constantino",120));
    }

   
    public function getNombre()
    {
        return "Bizantino";
    }
}