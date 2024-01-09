<?php

class Factoria {
    
    /**
     * generarConjunto
     *
     * @param  mixed $nombre
     * @param  mixed $cuantos
     * @return void
     */
    static function generarConjunto($nombre="", $cuantos = 4){
        $c = new Conjunto($nombre);
        for ($i=0; $i < $cuantos - 1; $i++) { 
            $c->addValor(rand(1,9));
        }
        return $c;
    }
}