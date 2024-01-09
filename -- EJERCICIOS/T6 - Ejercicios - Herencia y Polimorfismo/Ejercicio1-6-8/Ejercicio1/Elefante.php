<?php
require_once 'Animal.php';
//Crea la clase Elefante que herede de la anterior y que incluya los métodos obligatorios (el elefante barrita). 
class Elefante extends Animal implements AInterface{
    public function hacerRuido() {
        echo "{$this->nombre} barrita";
    }
}