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
            $aleatorio = rand(1,2);
            if ($aleatorio==1){
                $v[] = self::generaPersonaje();
            }
            else {
                $v[] = self::generaElfo();
            }
            
        }
        return $v;
    }

    static function generaElfo(){
        return new Elfo(self::$nombres[rand(0,count(self::$nombres)-1)], rand(1, 2000),true,rand(10,50));
    }
}