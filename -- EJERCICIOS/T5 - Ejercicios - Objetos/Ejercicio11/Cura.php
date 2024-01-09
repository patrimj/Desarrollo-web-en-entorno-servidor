<?php

require_once (__DIR__.'Civilizacion.php');
require_once (__DIR__.'Aldeanos.php');

class Cura extends Aldeanos {

    public function __construct($nombre) {
        parent::__construct($nombre, 250, new Civilizacion("Bizantinos", "Constantino", 250,0));
    }

    public function atacar($aldeano) {
        if (count($aldeano) > 0) { // Verificar si hay aldeanos para atacar
            $aldeanoAleatorio = $aldeano[array_rand($aldeano)]; // Elegir un aldeano al azar 


            if ($aldeano->getCivilizacion() !== 'Bizantinos') { // Verificar si el aldeano es de una civilización diferente a bizantino
                $aldeanoAleatorio->aBizantino(); // Realizar el ataque
            }    
         }
    }
}    