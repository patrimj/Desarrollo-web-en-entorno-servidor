<?php 
class PartidasGanadas {//

    public $id;// id de la partida ganada
    public $id_usuario;// id del usuario    
    public $cantidad;// cantidad de partidas ganadas
    public function __construct($id_usuario) {// constructor de la clase PartidasGanadas
        $this->id_usuario = $id_usuario;// id del usuario
        $this->cantidad = 0;// cantidad de partidas ganadas inicializada a 0
    }
    public function getId() {// funcion para obtener el id de la partida ganada
        return $this->id;
    }
    public function getIdUsuario() {// funcion para obtener el id del usuario
        return $this->id_usuario;
    }
    public function getCantidad() {// funcion para obtener la cantidad de partidas ganadas
        return $this->cantidad;
    }
    public function incrementar() {// funcion para incrementar la cantidad de partidas ganadas
        $this->cantidad++;
    }
    public function guardar() {// funcion para guardar la cantidad de partidas ganadas

    }


}