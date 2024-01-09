<?php
class Partida {

    private $id;
    private $tamanio;
    private $minas;
    private $tableroOculto; // Tablero con las minas
    private $tableroVisible; // Tablero visible para el jugador
    private $progreso;
    private $finalizada;
    private $resultadoFinal;

    public function __construct($tamanio, $minas) {
        $this->tamanio = $tamanio;
        $this->minas = $minas;
        $this->tableroOculto = array(); // Inicializar el tablero oculto
        $this->tableroVisible = array(); // Inicializar el tablero visible
        $this->progreso = 0;
        $this->finalizada = false;
        $this->resultadoFinal = 0;

        // Inicializar el tablero y colocar las minas
        $this->inicializarTablero();
        $this->colocarMinas();
    }

    private function inicializarTablero() {
        // Inicializar ambos tableros con casillas vacías
        for ($i = 0; $i < $this->tamanio; $i++) {
            $this->tableroOculto[$i] = array_fill(0, $this->tamanio, 0);
            $this->tableroVisible[$i] = array_fill(0, $this->tamanio, '-');
        }
    }

    private function colocarMinas() {
        $minasColocadas = 0;

        while ($minasColocadas < $this->minas) {
            $casilla = rand(0, $this->tamanio - 1);

            if ($this->tableroOculto[$casilla] !== '*') {
                $this->tableroOculto[$casilla] = '*';
                $minasColocadas++;
            }
        }
    }

    public function procesarMovimiento($casilla) {
        if ($this->tableroVisible[$casilla] !== '-' || $this->finalizada) {
            return;
        }

        if ($this->tableroOculto[$casilla] === '*') {
            $this->finalizarPartida(false);
            return;
        }

        $pista = $this->calcularPista($casilla);

        $this->tableroVisible[$casilla] = $pista;
        $this->progreso++;

        if ($this->progreso === $this->tamanio - $this->minas) {
            $this->finalizarPartida(true);
        }

        if ($pista === 0) {
            $this->revelarCasillasAdyacentes($casilla);
        }
    }

    private function calcularPista($casilla) {
        $pista = 0;

        // Verificar casilla izquierda
        if ($casilla > 0 && $this->tableroOculto[$casilla - 1] === '*') {
            $pista++;
        }

        // Verificar casilla derecha
        if ($casilla < $this->tamanio - 1 && $this->tableroOculto[$casilla + 1] === '*') {
            $pista++;
        }

        return $pista;
    }

    private function revelarCasillasAdyacentes($casilla) {
        // Verificar casilla izquierda
        if ($casilla > 0) {
            $this->procesarMovimiento($casilla - 1);
        }

        // Verificar casilla derecha
        if ($casilla < $this->tamanio - 1) {
            $this->procesarMovimiento($casilla + 1);
        }
    }

    private function finalizarPartida($ganada) {
        $this->finalizada = true;
        $this->resultadoFinal = $ganada ? 1 : -1;
    }

    public function getProgreso() {
        return $this->progreso;
    }

    public function getResultadoFinal() {
        return $this->resultadoFinal;
    }
}