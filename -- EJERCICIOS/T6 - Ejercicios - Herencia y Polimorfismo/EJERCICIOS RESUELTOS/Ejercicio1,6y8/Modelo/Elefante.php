<?php
class Elefante extends Animal{
    public function hacerRuido() {
        return $this->nombre . 'Dice ¡Ruido de elefante?!';    
    }
}