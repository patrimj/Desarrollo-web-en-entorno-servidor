<?php

require_once 'Controlador.php';
require_once '/Controlador/ControladorAdmin.php';
require_once '/Controlador/ControladorJugador.php';
require_once '/Auxiliar/Constantes.php';
require_once '/Auxiliar/Factoria.php';
require_once '/Auxiliar/Conexion.php';
require_once '/Modelo/Partida.php';
require_once '/Modelo/Jugador.php';

/*----------------------------------------------*/
header('Content-Type:application/json');
$requestMethod = $_SERVER['REQUEST_METHOD'];
$paths = $_SERVER['REQUEST_URI'];
$datosRecibidos = file_get_contents("php://input");
$argus = explode('/', $paths);
unset($paths[0]);
$datos = json_decode($datosRecibidos, true);
/*----------------------------------------------*/

/*--------------------------------------------------------- GET ---------------------------------------------------------*/ 


if ($requestMethod === 'GET') {
    if (isset($argus[1]) && $argus[1] === 'login') { // ../login/email/pssw -->  Si los datos se pasan de otra manera, no funcionaria
        $datos[0] = Controlador::login(
            $datos['email'],
            $datos['pssw']
        );
    } 

    if (Controlador::es_admin($datos[0]) == true) { // si es admin
        if (isset($argus[1]) && $argus[1] === 'listar') { // ../listar
            $datos[1] =  ControladorAdmin::listarJugadores();  
        }
        else if (isset($argus[1]) && $argus[1] === 'buscar') { // ../buscar/id
            $datos[1] = ControladorAdmin::buscarJugador($argus[2]); 
        }else{
            $cod = 400;
            $mes = 'error, siga las instrucciones correctamente.';
            header(Constantes::$headerMssg.$cod.' '.$mes);
            echo json_encode(['Codigo' => $cod, 'Mensaje' => $mes]);
        }
    }else{ // si es jugador
        $datos[0] = Controlador::login(
            $datos['email'],
            $datos['pssw']
        );
        if ($datos[0] == null) { //si no existe el jugador
            $cod = 400;
            $mes = 'error, no existe el jugador, siga las instrucciones correctamente';
            header(Constantes::$headerMssg.$cod.' '.$mes);
            echo json_encode(['Codigo' => $cod, 'Mensaje' => $mes]);
        } else {
            if(isset($argus[1]) && $argus[1] === 'ranking'){ // ../ranking
                $datos[0] = ControladorJugador::ranking();
            }    
            if(isset($argus[1]) && $argus[1] === 'partidas'){ // ../partidas
                $datos[0] = ControladorJugador::listarPartidas();
            }
            if(isset($argus[1]) && $argus[1] === 'buscar'){ // ../buscar/id
                $datos[0] = ControladorJugador::buscarPartida($argus[2]);
            }
        
            if (isset($argus[1]) && $argus[1] === 'jugar') { // ../jugar/tamaño/minas o // ../jugar/ --> estandar
                $datos[0] = Controlador::login( // comoprobamos que existe el jugador
                    $datos['email'],
                    $datos['pssw']
                );

                $partidaCreada = new Partida(12,12,12,12,12);
                if ($datos[0] == null) { //si no existe el jugador
                    $cod = 400;
                    $mes = 'error, no existe el jugador, siga las instrucciones correctamente';
                    header(Constantes::$headerMssg.$cod.' '.$mes);
                    echo json_encode(['Codigo' => $cod, 'Mensaje' => $mes]);

                }else{ // si existe el jugador
                    if (isset($argus[2]) && isset($argus[3])) {//se pasan tamaño y minas
                        $fila = intval($argus[2]);//tamaño
                        $minas = intval($argus[3]);

                        if ($minas >= $fila) { // no puede haber mas minas que casillas
                            $cod = 400;
                            $mes = 'error, no puede haber más minas que casillas, siga las instrucciones correctamente';
                            header(Constantes::$headerMssg.$cod.' '.$mes);
                            echo json_encode(['Codigo' => $cod, 'Mensaje' => $mes]);
                        }else{
                            $partidaCreada->inicializarTablero($argus[2], $argus[3]);
                            $tableroOculto_cadena = Controlador::convertirArray($partidaCreada->getTablero_oculto());//tableros de array a string para poder actualizarlos en la base de datos
                            $tableroVisible_cadena = Controlador::convertirArray($partidaCreada->getTablero_visible());
                            $partida = ControladorJugador::crearPartida(Factoria::partidaNueva($datos[0]->getId_jugador(), $tableroOculto_str, $tableroVisible_str, $partida->getEstado()));
                        }
                    }else{
                        $partidaCreada->inicializarTableroEstandar();
                        $tableroOculto_cadena = Controlador::convertirArray($partidaCreada->getTablero_oculto());
                        $tableroVisible_cadena = Controlador::convertirArray($partidaCreada->getTablero_visible());
                        $partida = ControladorJugador::crearPartida(Factoria::partidaNueva($datos[0]->getId_jugador(), $tableroOculto_str, $tableroVisible_str, $partida->getEstado()));
                        }     
                } 
            }
        }    
    }
}    

/*--------------------------------------------------------- POST ---------------------------------------------------------*/ 
if ($requestMethod === 'POST') {
    if (isset($argus[1]) && $argus[1] === 'login') { // ../login/email/pssw 
        $datos[0] = Controlador::login(
            $datos['email'],
            $datos['pssw']
        );
    } 

    if (Controlador::es_admin($datos[0]) == true) { // si es admin
        if (isset($argus[1]) && $argus[1] === 'registrar') { // ../registrar
            $datos[1] = ControladorAdmin::registrarUsu(Factoria::jugadorNuevo ($datos['id_jugador'], $datos['nombre'], $datos['email'], $datos['pssw'], $datos['partidas_jugadas'], $datos['partidas_ganadas'], $datos['administrador'])); //introducimos los datos en la base de datos en orden
        }else{
            $cod = 400;
            $mes = 'error, siga las instrucciones correctamente.';
            header(Constantes::$headerMssg.$cod.' '.$mes);
            echo json_encode(['Codigo' => $cod, 'Mensaje' => $mes]);
        }
    }else{ // si es jugador
        $datos[0] = Controlador::login(
            $datos['email'],
            $datos['pssw']
        );
        if ($datos[0] == null) { //si no existe el jugador
            $cod = 400;
            $mes = 'error, no existe el jugador, siga las instrucciones correctamente';
            header(Constantes::$headerMssg.$cod.' '.$mes);
            echo json_encode(['Codigo' => $cod, 'Mensaje' => $mes]);
        } else {            
            if (isset($argus[1]) && $argus[1] === 'jugar') { // ../jugar/id_partida
                if (isset($argus[2])) {
                    /** @var object $partidaEncontrada */
                    $partidaEncontrada = ControladorJugador::buscarPartida($argus[2]);
                    $partidaActiva = Factoria::partidaNueva($partidaEncontrada->getId_partida(), $partidaEncontrada->getId_jugador(), $partidaEncontrada->getTablero_oculto(), $partidaEncontrada->getTablero_visible(), $partidaEncontrada->getEstado());
                    
                    if ($partida == null) {///si no existe la partida
                        $cod = 400;
                        $mes = 'error, no existe la partida, siga las instrucciones correctamente';
                        header(Constantes::$headerMssg.$cod.' '.$mes);
                        echo json_encode(['Codigo' => $cod, 'Mensaje' => $mes]);

                    }else{//si existe la partida

                        if ($partidaEncontrada -> getEstado() == 'Jugando') {//si la partida esta en juego
                        //cambiamos los tableros
                            $tableroOculto_array = Controlador::convertirCadena($partidaActiva->getTablero_oculto());
                            $tableroVisible_array = Controlador::convertirCadena($partidaActiva->getTablero_visible());

                            $partidaActiva->setTablero_oculto($tableroOculto_array);
                            $partidaActiva->setTablero_visible($tableroVisible_array);

                        }else{
                            $cod = 400;
                            $mes = 'error, la partida ya ha terminado, siga las instrucciones correctamente';
                            header(Constantes::$headerMssg.$cod.' '.$mes);
                            echo json_encode(['Codigo' => $cod, 'Mensaje' => $mes]);
                        }
                    }    
                    if (isset($datos['Posicion'])) {
                                                            
                        $tableroVisible_array = $partidaActiva->jugar($datos['Posicion']);
                        $tableroVisible_cadena = Controlador::convertirArray($tableroVisible_array);//tableros de array a string para poder actualizarlos en la base de datos
                                                         
                        if (Controlador::partidaEstado($partidaActiva) == true) { // Si la partida ha terminado
                            //incrementamos las partidas jugadas
                            Controlador::incrementarPartidasJugadas($datos[0]->getPartidasJugadas()+1, $partidaActiva->getEstado());
                        }
                    }else{
                        $cod = 400;
                        $mes = 'error, siga las instrucciones correctamente';
                        header(Constantes::$headerMssg.$cod.' '.$mes);
                        echo json_encode(['Codigo' => $cod, 'Mensaje' => $mes]);
                    }
                }else{
                    $cod = 400;
                    $mes = 'partida no encontrada';
                    header(Constantes::$headerMssg.$cod.' '.$mes);
                    echo json_encode(['Codigo' => $cod, 'Mensaje' => $mes]);
                }
                    
            }else{
                $cod = 400;
                $mes = 'error, siga las instrucciones correctamente.';
                header(Constantes::$headerMssg.$cod.' '.$mes);
                echo json_encode(['Codigo' => $cod, 'Mensaje' => $mes]);
            }
        }    
    }
}  

/*--------------------------------------------------------- PUT ---------------------------------------------------------*/ 

if ($requestMethod === 'PUT') {
    if (isset($argus[1]) && $argus[1] === 'login') { // ../login/email/pssw 
        $datos[0] = Controlador::login(
            $datos['email'],
            $datos['pssw']
        );
    }
    if (Controlador::es_admin($datos[0]) == true) { // si es admin
        if (isset($argus[1]) && $argus[1] === 'modificar') { // ../modificar
            $datos[1] = ControladorAdmin::modificarJugador($datos['id_jugador'], $datos['nombre'], $datos['email'], $datos['pssw'], $datos['partidas_jugadas'], $datos['partidas_ganadas'], $datos['administrador']);
        }else{
            $cod = 400;
            $mes = 'error, siga las instrucciones correctamente.';
            header(Constantes::$headerMssg.$cod.' '.$mes);
            echo json_encode(['Codigo' => $cod, 'Mensaje' => $mes]);
        }
    }else{
        $cod = 400;
        $mes = 'error, no eres admiistrador.';
        header(Constantes::$headerMssg.$cod.' '.$mes);
        echo json_encode(['Codigo' => $cod, 'Mensaje' => $mes]);
    }   
}         

/*--------------------------------------------------------- DELETE ---------------------------------------------------------*/ 

if ($requestMethod === 'DELETE') {
    if (isset($argus[1]) && $argus[1] === 'login') { // ../login/email/pssw 
        $datos[0] = Controlador::login(
            $datos['email'],
            $datos['pssw']
        );
    } 
    if (Controlador::es_admin($datos[0]) == true) { // si es admin
        if (isset($argus[1]) && $argus[1] === 'borrar') { // ../borrar/id
                $datos[1] = ControladorAdmin::eliminarJugador($argus[2]);
        }else{
            $cod = 400;
            $mes = 'error, siga las instrucciones correctamente.';
            header(Constantes::$headerMssg.$cod.' '.$mes);
            echo json_encode(['Codigo' => $cod, 'Mensaje' => $mes]);
        }
    }else{
        $cod = 400;
        $mes = 'error, no eres admiistrador.';
        header(Constantes::$headerMssg.$cod.' '.$mes);
        echo json_encode(['Codigo' => $cod, 'Mensaje' => $mes]);
    } 
}
