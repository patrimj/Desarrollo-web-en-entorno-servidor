<?php
class Persona {
    private $dni;
    private $nombre;
    private $clave;
    private $tfno;

    public function __construct($dni, $nombre, $clave, $tfno) {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->tfno = $tfno;
    }

    public function getDNI() {
        return $this->dni;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getClave() {
        return $this->clave;
    }

    public function getTfno() {
        return $this->tfno;
    }

}