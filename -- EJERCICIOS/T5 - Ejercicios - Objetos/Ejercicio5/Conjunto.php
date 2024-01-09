<?php

class Conjunto { 
    public $elementos = array(); // aqui almacenamos las letras

    public function agregarElemento($elemento) { // de uno en uno
        $this->elementos[] = $elemento;
            //$conjuntoA = new Conjunto();
            //$elemento = 'P'; 
            //$conjuntoA->agregarElemento($elemento);
    }
    /* si queremos meter varios
    public function agregarElemento($elemento) { // de uno en uno
        foreach ($elementos as $elemento) {
        $this->elementos[] = $elemento;
        }
            //$conjuntoA = new Conjunto();
            //$elemento = ['P','M']; 
            //$conjuntoA->agregarElemento($elemento);
    {
    */

    public function borrarElemento($elemento) { /// los elementos que no son iguales a $elemento se guardan
        $this->elementos = array_diff($this->elementos, [$elemento]);// se pone entre [] para crear un array directamemte
    }// array_diff --> sirve para calcular diferencias entre arrays

    public function obtenerElementos() {
        return $this->elementos;
    }

    public function interseccion($elementosA, $elementosB) {
        $interseccion = new Conjunto();
        $interseccion->elementos = array_intersect($elementosA, $elementosB);
        
        return $interseccion;
    }

    public function union($elementosA, $elementosB) {
        $union = new Conjunto();
        $union->elementos = array_merge($elementosA, $elementosB);
        
        return $union;
    }

    ///array_intersect --> calcula llo comun entre dos arrays devolviendo un array nuevo
    //array_merge --> calcula la suma entre dos arrays, incluyendo en un nuevo array los dos
}
