<?php 
class Controlador {

    static function getTodas(){
        $arrayPersonas = Conexion::SeleccionarTodasPersonas();
        $cod = 201;
        $mes = "TODO OK";
        header(Constantes::$headerMssg . $cod . ' ' . $mes);
        $respuesta = [
            'Cod:' => $cod,
            'Mensaje:' => $mes,
            'Personas' => $arrayPersonas
        ];
        echo json_encode($respuesta);
    }

    static function login($u,$c){
        $idU = Conexion::seleccionarPersona($u,$c);
        switch($idU){
            case -1: $cod=404;$ms="Servidor caido";
                     header(Constantes::$headerMssg . $cod . ' ' . $ms);
                     echo json_encode(['cod'=> $cod, 'mes'=>$ms]);
                     break;
            case 0: $cod=204;$ms="Login incorrecto";
                    header(Constantes::$headerMssg . $cod . ' ' . $ms);
                    echo json_encode(['cod'=> $cod, 'mes'=>$ms]);
                    break;
            default: $cod=200;$ms="Datos de la partida";
                    //Comprobación de partidas.
                    $datosPartida = Conexion::getPartida($idU);
                    if ($datosPartida['cod']==0){//Partida en marcha
                        $ms = 'Tienes un partida en marcha';
                        header(Constantes::$headerMssg . $cod . ' ' . $ms);
                        echo json_encode(['cod'=> $cod, 'mes'=>$ms, 'bus' => $datosPartida['buscaminas']]);
                    }
                    if ($datosPartida['cod']==1){//Partida acabada y ganaste
                        $ms = 'No tienes un partida en marcha';
                        header(Constantes::$headerMssg . $cod . ' ' . $ms);
                        echo json_encode(['cod'=> $cod, 'mes'=>$ms, 'bus' => $datosPartida['buscaminas']]);
                    }
                    if ($datosPartida['cod']==-1){//Partida acabada y perdiste
                        //$datosPartida['buscaminas'];
                    }
                    break;
        }
    }

    static function generaPartida($cant, $min, $email, $pass){
        $bus = Factoria::generaBuscaminas($cant, $min);
        $idU = Conexion::seleccionarPersona($email,$pass);
        //...
        Conexion::insertarPartida($idU, $bus);
    }

    static function getPersona($dni){
        $persona = Conexion::seleccionarPersona($dni);
            $cod = 201;
            $mes = "TODO OK";
            header(Constantes::$headerMssg . $cod . ' ' . $mes);
            $respuesta = [
                'Cod:' => $cod,
                'Mensaje:' => $mes,
                'Persona' => $persona
            ];
            echo json_encode($respuesta);
    }

    static function insertarPersona($p){
        if (Conexion::insertarPersona($p)) {
            $inserccion = true;
            $cod = 201;
            $mes = "TODO OK";
            header(Constantes::$headerMssg . $cod . ' ' . $mes);
            $respuesta = [
                'Cod:' => $cod,
                'Mensaje:' => $mes,
                'Inserccion' => $inserccion
            ];
            echo json_encode($respuesta);
    }
        else {
            $inserccion = false;
            $cod = 201;
            $mes = "TODO OK";
            header(Constantes::$headerMssg . $cod . ' ' . $mes);
            $respuesta = [
                'Cod:' => $cod,
                'Mensaje:' => $mes,
                'Inserccion' => $inserccion
            ];
            echo json_encode($respuesta);
        }
    }
}