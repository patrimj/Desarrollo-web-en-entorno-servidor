<?php 

class Factoria {
    static $nombres= ['Javi', 'Manuel','Patricia','Laura', 'Juan','Jaime','Alejandro','Óscar','Inés','Alejandro','Marina'];

    static function generaPersonaje(){
        $p = new Personaje(self::$nombres[rand(0,count(self::$nombres)-1)], rand(1, 2000));
        return $p;
    }

    static function generaVariosPersonajes($cuantos = 4){
        $v = [];
        for ($i=0; $i < $cuantos; $i++) { 
            $v[] = self::generaPersonaje();
        }
        return $v;
    }
}