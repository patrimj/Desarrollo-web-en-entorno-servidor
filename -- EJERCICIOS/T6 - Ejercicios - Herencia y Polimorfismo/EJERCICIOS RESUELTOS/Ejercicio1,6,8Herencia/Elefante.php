<?php
require_once('Animal.php');
require_once('Perro.php');
require_once('Gato.php');
require_once('Elefante.php');

class Elefante extends Animal {
    public $tipo='Elefante';
    public function __construct($nombre, $raza, $peso, $color) {
        parent::__construct($nombre, $raza, $peso, $color);
    }
    
    public function comer() {
    }
    
    public function dormir() {
       
    }
    
    public function hacerRuido() {
    }
}