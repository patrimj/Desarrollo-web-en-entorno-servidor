<?php
class Nido {
    private $serpientes = [];

    public function agregarSerpiente(Serpiente $serpiente) { // le metemos una serp de la clase
        $this->serpientes[] = $serpiente;
    }

    public function obtenerSerpientes() {
        return $this->serpientes;
    }

    public function eliminarSerpiente(Serpiente $serpiente) {
        foreach ($this->serpientes as $key => $s) { //representa 1 serpiente del nido 
            if ($s === $serpiente) {
                unset($this->serpientes[$key]);// guardamos el indice
                break;
            }
        }
    }

    public function mangostaAtaca() {
        $ataque = mt_rand(0, 4);
        if ($ataque > 0) { // si atca...
            for ($i = 0; $i < $ataque; $i++) { //bucle para atacat de 0-4
                if (!empty($this->serpientes)) { // verifica que no este vacio de serpientes
                    $serpiente = array_pop($this->serpientes); // extraemos la ULTIMA
                    $serpiente->envejecer(); 
                }
            }
        }
    }
    
    public function simularVida($duracion) {
        $segundos = 0;

        while ($segundos < $duracion) {
            foreach ($this->serpientes as $serpiente) {
                if (!$serpiente->estaMuerta()) {
                    $serpiente->envejecer();
                }
            }

            $this->mangostaAtaca();
            $segundos++;
        }
    }
}
