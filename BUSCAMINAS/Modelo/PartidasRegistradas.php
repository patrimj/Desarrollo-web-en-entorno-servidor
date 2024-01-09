<?php

class PartidasRegistradas{
    public $id;
    public $id_partida;
    public $tablero;
    public $tablero_visible;
    public $accion;
    public $fecha;

    public function __construct($id_partida, $tablero, $tablero_visible, $accion) {
        $this->id_partida = $id_partida;
        $this->tablero = $tablero;
        $this->tablero_visible = $tablero_visible;
        $this->accion = $accion;
        $this->fecha = date('Y-m-d H:i:s');
    }

    public function getId() {
        return $this->id;
    }

    public function getIdPartida() {
        return $this->id_partida;
    }

    public function getTablero() {
        return $this->tablero;
    }

    public function getTableroVisible() {
        return $this->tablero_visible;
    }

    public function getAccion() {
        return $this->accion;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function guardar() {
        $sql = "INSERT INTO partidas_registradas (id_partida, tablero, tablero_visible, accion, fecha) VALUES ('$this->id_partida', '$this->tablero', '$this->tablero_visible', '$this->accion', '$this->fecha')";
        $result = $this->db->query($sql);
        if ($result) {
            $this->id = $this->db->insert_id;
        }
        return $result;
    }

    public function actualizar() {
        $sql = "UPDATE partidas_registradas SET id_partida = '$this->id_partida', tablero = '$this->tablero', tablero_visible = '$this->tablero_visible', accion = '$this->accion', fecha = '$this->fecha' WHERE id = '$this->id'";
        return $this->db->query($sql);
    }

    public function borrar() {
        $sql = "DELETE FROM partidas_registradas WHERE id = '$this->id'";
        return $this->db->query($sql);
    }

    public function getPartidasRegistradas() {
        $sql = "SELECT * FROM partidas_registradas";
        $result = $this->db->query($sql);
        $part
}