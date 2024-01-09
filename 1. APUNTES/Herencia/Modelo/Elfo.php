<?php 
require_once 'Personaje.php';

class Elfo extends Personaje  {
    protected $arquero;
    private $flechas;

   

	public function __construct($nombre, $edad, $arquero, $flechas) {
        parent::__construct($nombre,$edad);
		$this->arquero = $arquero;
		$this->flechas = $flechas;
	}

	public function getArquero() {
		return $this->arquero;
	}

	public function setArquero($value) {
		$this->arquero = $value;
	}

	public function getFlechas() {
		return $this->flechas;
	}

	public function setFlechas($value) {
		$this->flechas = $value;
	}

    public function __toString()
    {
        return parent::__toString().' arquero: '.$this->arquero.' flechas: '.$this->flechas;
    }

    public function lanzarFlechas(){
        return $this->flechas--;
    }

    function pelear(){
        return parent::pelear().' '.$this->nombre.' peleando el elfo.';
    }

    
}