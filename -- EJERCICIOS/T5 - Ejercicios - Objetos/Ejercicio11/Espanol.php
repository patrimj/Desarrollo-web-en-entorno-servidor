<?php

require_once (__DIR__.'Civilizacion.php');
require_once (__DIR__.'Aldeanos.php');

class Espanol extends Aldeanos {
    
    public function __construct($nombre) {
        parent::__construct($nombre, 200, new Civilizacion("Españoles", "Isabel I",120));
    }

    
    public function getNombre()
    {
        return "Español";
    }
}