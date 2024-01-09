<?php

// Definir la clase GestorRanking para gestionar el ranking de jugadores
class Ranking {
  private $usuarios;

  public function __construct($usuarios) {
    $this->usuarios = $usuarios;
  }

  public function getRanking() {
    // Ordenar los usuarios por número de partidas ganadas
    usort($this->usuarios, function($a, $b) {
      return count($b->getPartidasGanadas()) - count($a->getPartidasGanadas());
    });

    // Devolver la lista de usuarios ordenada
    $lista_usuarios = array();
    foreach ($this->usuarios as $usuario) {
      $lista_usuarios[] = $usuario->getNombre();
    }
    return $lista_usuarios;
  }
}