<?php
class Parque {
//solo cabe un animal doméstico por sector.
    public posicion = []
    public $animales = [];

    

    //Cada 10 segundos aparece un animal nuevo que se sitúa en una posición libre del parque; si no hubiera el animal se va.
    function aparecer(){

    }
    //Cada 2 segundos los animales del parque hacen algunas de las acciones habituales: comer, dormir o hacerRuido; al azar.
    function hacerAccion(){
        if ($this->posicion !== null) {
            
            
        }
    }
    //Cada 15 segundos un animal cambia de posición a otra adyacente. Si no hay hueco libre no se mueve.
    function cambia(){
        
    }
    //Cada 20 segundos alguno de los animales abandona el parque con una probabilidad del 50%.
    function abandonar(){
        
    }
    

}