<?php

class Jugador {
    public $id_jugador; //id del jugador
    public $nombre;//nombre del jugador
    public $email;//email del jugador
    public $pssw; //password para el login
    public $partidas_jugadas;//partidas jugadas por el jugador
    public $partidas_ganadas;//partidas ganadas por el jugador
    public $administrador;//si el jugador es administrador o no
    
    public function __construct($id_jugador, $nombre, $email, $pssw, $partidas_jugadas, $partidas_ganadas, $administrador) {
        $this->id_jugador = $id_jugador;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->pssw = $pssw;
        $this->partidas_jugadas = $partidas_jugadas;
        $this->partidas_ganadas = $partidas_ganadas;
        $this->administrador = $administrador;
    }
    
    public function getId_jugador() {
        return $this->id_jugador;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getEmail() {
        return $this->email;
    }
    
    public function getPartidas_jugadas() {
        return $this->partidas_jugadas;
    }

    public function getPartidas_ganadas() {
        return $this->partidas_ganadas;
    }

    public function getAdministrador() {
        return $this->administrador;
    }

    public function setId_jugador($id_jugadorValue) {
        $this->id_jugador = $id_jugadorValue;
    }

    public function setNombre($nombreValue) {
        $this->nombre = $nombreValue;
    }

    public function setEmail($emailValue) {
        $this->email = $emailValue;
    }
    
    public function setPartidas_jugadas($partidas_jugadasValue) {
        $this->partidas_jugadas = $partidas_jugadasValue;
    }

    public function setPartidas_ganadas($partidas_ganadasValue) {
        $this->partidas_ganadas = $partidas_ganadasValue;
    }

    public function setAdministrador($administradorValue) {
        $this->administrador = $administradorValue;
    }
    public function getPssw()
    {
        return $this->pssw;
    }

    public function setPssw($pssw)
    {
        $this->pssw = $pssw;
    }
    
    public function __toString() //esta funcion devuelve un string con los datos de la clase
    {
        return 'ID: ' .$this->id_jugador . " " .'Nombre: '. $this->nombre . " " . 'Email: '.$this->email . " " . 'Partidas Jugadas: '.$this->partidas_jugadas . " " . 'Partidas Ganadas:' .$this->partidas_ganadas . " " . 'es administrador'.$this->administrador;
    }



}