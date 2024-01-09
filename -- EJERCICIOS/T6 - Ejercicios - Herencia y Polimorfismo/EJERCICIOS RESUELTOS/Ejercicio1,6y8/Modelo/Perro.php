<?php

class Perro extends Animal {
    public function hacerRuido() {
        return $this->nombre . 'Dice ¡Guau!';    
    }

    public function hacerCaso() {
        $devolver = false;
        $rndm = rand(1,10);
        if ($rndm >= 1 && $rndm <= 9) {
            $devolver = true;
        }
        return $devolver;
    }

    public function sacarPaseo() {
        echo $this->nombre . ' ha sido sacado de paseo.';
    }
}