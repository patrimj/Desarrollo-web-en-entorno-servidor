<?php
require_once 'Animal.php';
class Gato extends Animal {

    public function hacerRuido() {
        echo "{$this->nombre} maulla";
    }

    public function hacerCaso() {//5%
        return rand(1, 100) <= 5;
    }

    public function toserBolaPelo() {
        echo "{$this->nombre} tose bola de pelo";
    }
}