<?php
class Factoria {

    public static function crearConjunto($cantidadElementos) {
        $conjunto = new Conjunto();//creea conjunto de la clase conjunto
        $elem = [];

        for ($i = 0; $i < $cantidadElementos; $i++) {
            $elem[] = chr(rand(65, 90)); //  en el código ASCII, a tiene un código de 65 y z tiene un código de 90
        }
        /// de la clase conjunto el atributo elementos --> class Conjunto ..public $elementos = array();
        $conjunto->elementos = $elem; //// asigna el array de la variable local $elem al atributo $elementos del objeto $conjunto
        return $conjunto;
    }
}
/*
 chr(...)-->  La función chr toma un número entero (un código ASCII) como argumento y devuelve el carácter correspondiente. 
 rand(65, 90) -->  La función rand genera un número entero aleatorio en el rango entre 65 y 90 --> Estos números corresponden a los códigos ASCII de las letras mayúsculas desde 'A' hasta 'Z'. 
 */