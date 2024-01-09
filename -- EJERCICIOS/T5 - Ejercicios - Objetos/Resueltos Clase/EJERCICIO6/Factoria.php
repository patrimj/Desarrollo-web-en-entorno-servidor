<?php
class Factoria{
    static $color = ['r','v','a'];

    public static function crearSerpiente(){
        $serpiente = new Serpiente();
        $serpiente->nacer(self::$color[rand(0,this->$color.length-1)]);
        return $serpiente;
    }
    public static function crearVariasSerientes($cantidad){
        $serpientes = [];
        for($i=0;$i<$cantidad;$i++){
            $serpientes[] = self::crearSerpiente();
        }
        return $serpientes;
    }
    public static function crearNido($nSerpientes){
        $nido = new Nido();
        $nido->setSerpientes(self::crearVariasSerientes($nSerpientes));
        return $nido;
    }
}