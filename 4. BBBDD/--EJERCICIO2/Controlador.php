<?php
class Controlador {
    public static function nuevaPartida($tamanio, $minas) {
        $partida = FactoriaPartida::crearPartida($tamanio, $minas);

        $partidaId = Conexion::crearPartida($partida);

        $respuesta = array(
            'partidaId' => $partidaId,
            'mensaje' => 'Partida creada exitosamente.'
        );

        echo json_encode($respuesta);
    }

    public static function obtenerProgreso($partidaId) {
        $progreso = Conexion::obtenerProgresoPartida($partidaId);

        if ($progreso !== null) {
            echo json_encode($progreso);
        } else {
            $error = array('mensaje' => 'Partida no encontrada.');
            echo json_encode($error);
        }
    }

    public static function realizarMovimiento($partidaId, $indice) {
        // Utilizar Conexion::obtenerProgresoPartida para obtener la partida existente por su ID
        $partida = Conexion::obtenerProgresoPartida($partidaId);
    
        if ($partida !== null) {
            $partida->procesarMovimiento($indice);
            $exito = Conexion::actualizarPartida($partidaId, $partida->getProgreso());
    
            if ($exito) {
                $respuesta = array(
                    'progreso' => $partida->getProgreso(),
                    'mensaje' => 'Movimiento realizado exitosamente.'
                );
    
                echo json_encode($respuesta);
            } else {
                $error = array('mensaje' => 'Error al actualizar la partida.');
                echo json_encode($error);
            }
        } else {
            $error = array('mensaje' => 'Partida no encontrada.');
            echo json_encode($error);
        }
    }
    
    

    public static function finalizarPartida($partidaId, $resultado) {
        // Operar con la partida utilizando su ID sin crear una nueva instancia
        $exito = Conexion::actualizarPartida($partidaId, $resultado);
    
        if ($exito) {
            $respuesta = array(
                'resultado' => $resultado,
                'mensaje' => 'Partida finalizada exitosamente.'
            );
    
            echo json_encode($respuesta);
        } else {
            $error = array('mensaje' => 'Error al finalizar la partida.');
            echo json_encode($error);
        }
    }
}

