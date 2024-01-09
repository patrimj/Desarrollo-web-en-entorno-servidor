<?php
require_once('Animal.php');
require_once('Perro.php');
require_once('Gato.php');
require_once('Elefante.php');

class Gato extends Animal {
    public $tipo='Gato';
    public function comer() {

    }
    
    public function dormir() {
    }
    
    public function hacerRuido() {
    }
    
    public function hacerCaso() {
        $probabilidad = rand(1, 100);
        return $probabilidad <= 5;
    }
    
    public function toserBolaPelo() {
    }
}
