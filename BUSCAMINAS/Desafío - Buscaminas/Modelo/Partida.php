<?php

class Partida {
    public $id_partida;
    public $id_jugador;
    public $tablero_oculto;
    public $tablero_visible;
    public $estado;// estado de la partida  (Acabada Ganada, Acabada Perdida, Jugando)

    public $jugadas;// jugadas de la partida
    public $ganada;// partidas ganadas
    public $minas;

    public function __construct($id_partida, $id_jugador, $tablero_oculto, $tablero_visible, $estado) {
        $this->id_partida = $id_partida;
        $this->id_jugador = $id_jugador;    
        $this->tablero_oculto = $tablero_oculto;
        $this->tablero_visible = $tablero_visible;
        $this->estado = 'Jugando';
    }
    
/*------------------- FUNCIONAMIENTO JUEGO -------------------*/    

    public function inicializarTablero ($tamano_tablero,$num_minas){
            
        for ($i = 0; $i < $tamano_tablero; $i++) {// bucle para recorrer el tablero
            $this-> tablero_oculto[$i] = 0; //el tablero oculto sin minas 
            $this-> tablero_visible[$i] = '-'; // el tablero visible con guiones
        }

        // colocamos las minas en el tablero OCULTO
        $minas_colocadas = 0; // minas colocadas inicializadas a 0
            while ($minas_colocadas < $num_minas) {
            $posicion = rand(0, $tamano_tablero - 1); // posicion aleatoria entre 0 y el tamaño del tablero
                if ($this->tablero_oculto[$posicion] != '*') {// si la posicion del tablero es diferente a *, es decir que no tiene una mina todavia
                    $this->tablero_oculto[$posicion] = '*';// la posicion del tablero sera * para indicar que hay una mina  en esa posicion
                    $this->minas[] = $posicion;
                    $minas_colocadas++;// se incrementa el numero de minas colocadas
                }
            }
        return $this;
    }
    
    public function inicializarTableroEstandar() { //nuestro tablero estandar tendrá un tamaño de 10 y 4 minas
        $tamano_tablero = Constantes::tamano_tablero_estandar;
        $num_minas = Constantes::num_minas_estandar;
            
        for ($i = 0; $i < $tamano_tablero; $i++) {
            $this->tablero_oculto[$i] = 0;
            $this->tablero_visible[$i] = '-';
        }
                
        $minas_colocadas = 0;
        while ($minas_colocadas < $num_minas) {
            $posicion = rand(0, $tamano_tablero - 1);
            if ($this->tablero_oculto[$posicion] != '*') {
                $this->tablero_oculto[$posicion] = '*';
                $this->minas[] = $posicion;
                $minas_colocadas++;
            }
        }
        return $this;
    }
          
    public function inicializarJugadas() {
        $this->jugadas = array(); // guardar las jugadas
        $this->ganada = false; // partida ganada inicializada a false, es decir que no se ha ganado la partida
    }    
      
    public function jugar($posicion) { 

        if (isset($this->jugadas[$posicion])) { // Comprobar si la casilla ya ha sido jugada 
            return 'Casilla ya jugada';
        }

        // Comprobar si la casilla es una mina
        if ($this->tablero_oculto[$posicion] == '*') { // si la posicion del tablero Oculto es igual a *
            $this->tablero_visible[$posicion] = '*'; // la posicion del tablero visible sera *  
            $this->ganada = false;
            $this->estado = 'Acabada Perdida';
        } else if ( $minas_adyacentes = $this->calcularMinasAdyacentes($posicion)){ // Marcar la casilla como jugada y comprobar si se ha ganado la partida
            $this->jugadas[$posicion] = $minas_adyacentes; // se guarda la posicion de la jugada y el numero de minas adyacentes
                if (count($this->jugadas) == count($this->tablero_visible) - count($this->minas)) { // si el numero de jugadas es igual al tamaño del tablero menos el numero de minas
                    $this->ganada = true;
                    $this->estado = 'Acabada Ganada';
                }
        }else{
            $this->tablero_visible[$posicion] = $this->tablero_oculto[$posicion];
        }
    }

    private function calcularMinasAdyacentes($posicion) {
        $minas_adyacentes = 0;
        $tamano_tablero = count($this->tablero_visible);
        $columna = $posicion;
    
            for ($i = max(0, $columna - 1); $i <= min($tamano_tablero - 1, $columna + 1); $i++) {
                if ($this->tablero_visible[$i] == '*') {
                    $minas_adyacentes++;
                }
            }
    
            return $minas_adyacentes;

    }
    
    public function rendirse() {  
        foreach ($this->minas as $mina) {// para cada mina
            $this->jugadas[$mina] = 'M';// se guarda la posicion de la jugada con una M para indicar que hay una mina
        }
        $this->ganada = false;
        $this->estado = 'Acabada Perdida';
    }
      
    public function getTablero() { // devuelve el tablero con las jugadas realizadas
    $tablero_jugado = array();
    for ($i = 0; $i < count($this->tablero_oculto); $i++) {
        if (isset($this->jugadas[$i])) {
            $tablero_jugado[] = $this->jugadas[$i];
        } else {
            if ($this->tablero_oculto[$i] == '*') {
                $tablero_jugado[] = '*';
            } else {
                $minas_adyacentes = $this->calcularMinasAdyacentes($i);
                $tablero_jugado[] = $minas_adyacentes;
            }
        }
    }
    return $tablero_jugado;
    }

/*------------------- get y set -------------------*/    
    
    public function getId_partida() {
        return $this->id_partida;
    }
    public function setId_partida($id_partida) {
        $this->id_partida = $id_partida;
    }

    public function getId_jugador() {
        return $this->id_jugador;
    }

    public function setId_jugador($id_jugador) {
        $this->id_jugador = $id_jugador;
    }

    public function getTablero_oculto() {
        return $this->tablero_oculto;
    }

    public function setTablero_oculto($tablero_oculto) {
        $this->tablero_oculto = $tablero_oculto;
    }

    public function getTablero_visible() {
        return $this->tablero_visible;
    }

    public function setTablero_visible($tablero_visible) {
        $this->tablero_visible = $tablero_visible;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getJugadas() {
        return $this->jugadas;
    }

    public function setJugadas($jugadas) {
        $this->jugadas = $jugadas;
    }

    public function getGanada() {
        return $this->ganada;
    }

    public function setGanada($ganada) {
        $this->ganada = $ganada;
    }

    public function __toString() {
        return 'ID Partida: ' . $this->id_partida . ', ID Jugador: ' . $this->id_jugador . ', Tablero Oculto: ' . $this->tablero_oculto . ', Tablero Visible: ' . $this->tablero_visible . ', Estado: ' . $this->estado;
    }

}
