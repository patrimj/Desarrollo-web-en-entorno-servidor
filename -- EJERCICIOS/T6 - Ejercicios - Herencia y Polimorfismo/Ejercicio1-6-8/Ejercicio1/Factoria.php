<?php

class Factoria {
    static function generarAnimal (){
        $p = new Animal(self::$nombres[rand(0,count(self::$nombres)-1)], rand(1, 2000));
        return $p;
    }
    static function generaVariosPersonajes($cuantos = 4){
        $v = [];
        
        for ($i=0; $i < $cuantos; $i++) { 
            $aleatorio = rand(1,2);
            if ($aleatorio==1){
                $v[] = self::generarAnimal();
            }
            else {
                $v[] = self::generarAnimal();
            }
            
        }
        return $v;
    }

}