<?php
namespace App\Models;

class Persona 
{
    public $dni;
    public $nombre;
    public $tfno;
    public $edad;

    function __construct($dni, $nombre, $tfno, $edad) {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->tfno = $tfno;
        $this->edad = $edad;
    }
}
