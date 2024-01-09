<?php
require_once('Animal.php');
require_once('Perro.php');
require_once('Gato.php');
require_once('Elefante.php');

class Perro extends Animal {
    public $tipo='Perro';
    public function comer() {
    }
    
    public function dormir() {
    }
    
    public function hacerRuido() {
    }
    
    public function hacerCaso() {
        $probabilidad = rand(1, 100);
        return $probabilidad <= 90;
    }
    
    public function sacarPaseo() {
    }
}
