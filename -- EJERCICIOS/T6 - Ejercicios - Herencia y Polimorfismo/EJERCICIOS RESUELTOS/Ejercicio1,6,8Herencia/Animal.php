<?php
require_once('Animal.php');
require_once('Perro.php');
require_once('Gato.php');
require_once('Elefante.php');


abstract class Animal {
    public $nombre;
    public $raza;
    public $peso;
    public $color;
    
    public function __construct($nombre, $raza, $peso, $color) {
        $this->nombre = $nombre;
        $this->raza = $raza;
        $this->peso = $peso;
        $this->color = $color;
    }
    
    public function vacunar() {
    }
    
    public abstract function comer();
    
    public abstract function dormir();
    
    public abstract function hacerRuido();
    
    public function hacerCaso() {
    }
    
    public function getNombre() {
    }
}



