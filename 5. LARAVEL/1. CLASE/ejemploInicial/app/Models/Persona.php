<?php 
namespace App\Models;

class Persona {
    public $nombre;
    public $apellidos;

	public function __construct($nombre, $apellidos) {

		$this->nombre = $nombre;
		$this->apellidos = $apellidos;
	}
}