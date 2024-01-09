<?php
class Partida {
    public $id;
    public $tamanio;
    public $minas;
    public $tableroOculto; // Tablero con las minas
    public $tableroJugador; // Tablero visible para el jugador
    public $progreso;
    public $finalizada; // esta la partida finalizada??? 
    public $resultadoFinal;

    public function __construct($tamanio, $minas) {
        $this->tamanio = $tamanio;
        $this->minas = $minas;
        $this->tableroOculto = array();
        $this->tableroJugador = array(); 
        $this->progreso = 0;
        $this->finalizada = false;
        $this->resultadoFinal = 0;
    }
    

    function tablero (){ // aqui inicializaremos los tableros --> array_fill(int $start_index, int $num, mixed $value)
        $minasColocadas= 0;
        for ($i = 0; $i < $this->tamanio; $i++) {
            $this->tableroOculto[$i] = array_fill(0, $this->tamanio, 'v'); // v de casilla visible
            $this->tableroJugador[$i] = array_fill(0,$this->tamanio, 't'); // t de casilla tapada
        
            //insertaremos las minas
        while ($minasColocadas < $this->minas){// mientras que las minas colocadas sean menos que las que han pedido que coloquemos
            $casilla = rand(0, $this->tamanio -1 ); //rand(int $min, int $max) en una casilla aleatoria colocaremos la mina y asi hasta que coloquemos todas las minas pedidas
    
            if ($this->tableroOculto[$casilla] !== 'M') { // comprobar que no haya mina en esa casilla aleatoria
                $this-> tableroOculto[$casilla] = 'M';/// si no hay mina la colocamos
                $minasColocadas++;
                }
            }
        }
    }
    
    
    function movimiento ($casilla){
        $minasAdyacentes = 0;
        $casillasRestantes = 0;

        if ($this->finalizada) {// Verificar si la partida ya está finalizada
            return $this->fin(); // La partida ha terminado
        }
            
        if ($this->tableroJugador[$casilla] !== 't') {// ver si la casilla ya esta destapada
            return $this->resultadoFinal = 0; //Sigue jugando (0) porque ya esta destapada
        }else {
            $this->tableroJugador[$casilla] = $this->tableroOculto[$casilla]; // destapamos y actualizamos
        }

        if ($this->tableroOculto[$casilla] === 'M') { // si ecuentra una mina se termina
            $this->finalizada = true;
            $this->resultadoFinal = -1; // Pierde (-1)
        } else {
            $minasAdyacentes = $this->contarMinasAdyacentes($casilla); // mirar minas alrededor y actualizar la casilla a 0,1,2
            $this->tableroJugador[$casilla] = $minasAdyacentes;
            
            if ($casillasRestantes=== 0) {// si estan destapadas y no se ha tocado ninguna mina se gana
                $this->finalizada = true;
                $this->resultadoFinal = 1; // Gana (1)
            }
        }

        return $this->resultadoFinal;

        //contar minas adyacentes
        for ($i = max(0, $casilla - 1); $i <= min($this->tamanio - 1, $casilla + 1); $i++) {// se mira a la izq,centro y derecha sin que se salga del tablero i max que el tablero
            if ($this->tableroOculto[$i] === 'M') {
                $minasAdyacentes++;
            }
        }
        return $minasAdyacentes;

        //calcular las casillas tapadas
        foreach ($this->tableroJugador as $casilla) {
            if ($casilla === 't') {
                $casillasRestantes++;
            }
        }
        return $casillasRestantes;

    }


    private function fin() {
        $this->finalizada = true;
    }
    
    public function getProgreso() {
        return $this->progreso;
    }

    public function getResultadoFinal() {
        return $this->resultadoFinal;
    }
} 
