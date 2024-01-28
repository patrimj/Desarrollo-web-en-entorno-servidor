<?php

namespace App\Models;

class Coche {
    public $matricula;
    public $marca;
    public $modelo;
    public $precio_dia;

	public function __construct($matricula, $marca, $modelo, $precio_dia) {
		$this->matricula = $matricula;
		$this->marca = $marca;
		$this->modelo = $modelo;
		$this->precio_dia = $precio_dia;
	}

	public function getMatricula() {
		return $this->matricula;
	}

	public function setMatricula($value) {
		$this->matricula = $value;
	}

	public function getMarca() {
		return $this->marca;
	}

	public function setMarca($value) {
		$this->marca = $value;
	}

	public function getModelo() {
		return $this->modelo;
	}

	public function setModelo($value) {
		$this->modelo = $value;
	}

	public function getPrecio_dia() {
		return $this->precio_dia;
	}

	public function setPrecio_dia($value) {
		$this->precio_dia = $value;
	}
}