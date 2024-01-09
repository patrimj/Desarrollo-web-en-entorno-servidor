<?php

class Persona{
    public $dni;
    public $nombre;
    public $clave;
    public $tfno;

	public function __construct($dni, $nombre, $clave, $tfno) {

		$this->dni = $dni;
		$this->nombre = $nombre;
		$this->clave = $clave;
		$this->tfno = $tfno;
	}

	public function getDni() {
		return $this->dni;
	}

	public function setDni($value) {
		$this->dni = $value;
	}

	public function getNombre() {
		return $this->nombre;
	}

	public function setNombre($value) {
		$this->nombre = $value;
	}

	public function getClave() {
		return $this->clave;
	}

	public function setClave($value) {
		$this->clave = $value;
	}

	public function getTfno() {
		return $this->tfno;
	}

	public function setTfno($value) {
		$this->tfno = $value;
	}
}