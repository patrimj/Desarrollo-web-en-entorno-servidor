 <?php

require 'Conexion.php';
require 'Controlador.php';
require 'Constantes.php';
require 'Partida.php';

header("Content-Type:application/json");
$method = $_SERVER["REQUEST_METHOD"];
$paths =  $_SERVER['REQUEST_URI'];
$datosRecibidos = file_get_contents("php://input");

$argus = explode('/', $paths);
unset($argus[0]);

// GET y POST
    if ($method === 'GET') {
        if (isset($_GET['tamanio']) && isset($_GET['minas'])) {// crea una partida con un tamaño y unas minas
            $tamanio = $_GET['tamanio'];
            $minas = $_GET['minas'];
            $controlador->generaPartida($cant, $min, $email, $pass);
        } else {
            $progresoPartida = $partida->getProgreso(); 

        if ($progresoPartida !== false) {
            
            echo json_encode(['progreso' => $progresoPartida]); // devolvemos el progreso
        } else {
            echo json_encode(['error' => 'No se ha encontrado progreso']);
            }
        }

    }elseif ($method === 'POST') {
        if (isset($_POST['email']) && isset($_POST['contrasena']) && isset($_POST['posicion'])) {
            // Solicita el inicio de sesión y jugar
            $email = $_POST['email'];
            $contrasena = $_POST['contrasena'];
            $posicion = $_POST['posicion'];
            
            $loginExito = $controlador->login($email, $contrasena); // se inicia sesión
            
            if ($loginExito) {
                $partida->tablero();// se crea el tablero con las minas 
                $partida->movimiento($casilla);// si se inicio correctamente se emìeza a jugar
            } else {
                echo json_encode(['error' => 'Inicio de sesión fallido']);
            }
    }    
}





