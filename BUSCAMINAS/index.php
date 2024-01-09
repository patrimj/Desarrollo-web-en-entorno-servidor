<?php

// TODO: Implementar el código del buscaminas en PHP

// Definir las constantes de la aplicación
define('TAMANO_TABLERO', 10);
define('NUM_MINAS', 15);



// Ejemplo de uso de las clases
$gestor_usuarios = new GestorUsuarios();
$gestor_partidas = new GestorPartidas();
$gestor_ranking = new GestorRanking(array());

// Registrar un usuario
$gestor_usuarios->registrarUsuario('usuario1', 'password1');

// Iniciar sesión como usuario
$usuario = $gestor_usuarios->login('usuario1', 'password1');

// Crear una partida
$gestor_partidas->crearPartida($usuario);

// Jugar una casilla
$gestor_partidas->jugar($usuario, 0, 0);

// Rendirse
$gestor_partidas->rendirse($usuario);

// Obtener el ranking de jugadores
$gestor_ranking->getRanking();
