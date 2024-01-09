<?php
/**
 * Clase que representa un conjunto de elementos.
 */
Class Conjunto {
    /**
     * @var string El nombre del conjunto.
     * @var array $conjs un array de varios conjuntos.
     */
    public $nombre;
    public $conjs = [];

    /**
     * Constructor de la clase Conjunto.
     * @param string $nombre el nombre del conjunto.
     */
    public function __construct($nombre) {
		$this->nombre = $nombre;
	}
	
	/**
	 * Obtiene los conjuntos
	 *
	 * @return void
	 */
	public function getConjs() {
		return $this->conjs;
	}

    public function addValor($value) {
        $this->conjs[] = $value;
    }

    public function union($c2) {
        $c3 = new Conjunto("RU");
        $c3->conjs = array_merge($this->conjs,$c2->conjs);
        return $c3;
    }

    function interseccion($v2) {
        // $elementosComunes = new Conjunto();
        // foreach ($this->conjs as $itemThis) {
        //     if (in_array($itemThis,$v2)) {
        //         $elementosComunes -> addValor($itemThis);
        //     }
        // }
        // return $elementosComunes;
        $c3 = new Conjunto("RI");
        $c3->conjs = array_intersect($this->conjs,$v2->conjs);
        return $c3;
        
    }

    function cardinalidad(){
        return count ($this->conjs);
    }
}