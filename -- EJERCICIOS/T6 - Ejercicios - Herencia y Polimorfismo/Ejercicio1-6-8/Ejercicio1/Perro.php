<?php
require_once 'Animal.php';
class Perro extends Animal {

    public function hacerRuido() {
        echo "{$this->nombre} ladra";
    }

    public function hacerCaso() {//// El 90% de las veces 
        return rand(1, 100) <= 90;
    }

    public function sacarPaseo() {
        echo "{$this->nombre} está paseando";
    }
}