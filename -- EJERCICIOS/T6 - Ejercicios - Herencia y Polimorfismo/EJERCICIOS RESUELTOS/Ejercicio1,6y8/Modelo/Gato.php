<?php
class Gato extends Animal {
    public function __construct($nombre, $raza, $peso, $color) {
        parent::__construct($nombre,$raza,$peso,$color);
	}

    public function hacerRuido() {
        return $this->nombre . 'Dice ¡Miau!';    
    }

    public function hacerCaso() {
        $devolver = false;
        $rndm = rand(1,10);
        if ($rndm >= 1 && $rndm <= 5) {
            $devolver = true;
        }
        return $devolver;
    }

    public function toserBolaPelo() {
        return $this->nombre . ' ha tosido una bola de pelo';
    }

}