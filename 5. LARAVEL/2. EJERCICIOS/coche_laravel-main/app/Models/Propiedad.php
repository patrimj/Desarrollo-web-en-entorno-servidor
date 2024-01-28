<?php
namespace App\Models;

class Propiedad 
{
    private $id;
    public $DNI;
    public $Matricula;
    public $dias_alquilado;
    public $entregado;

	public function __construct($id, $DNI, $Matricula, $dias_alquilado, $entregado) {

		$this->id = $id;
		$this->DNI = $DNI;
		$this->Matricula = $Matricula;
		$this->dias_alquilado = $dias_alquilado;
		$this->entregado = $entregado;
	}
}