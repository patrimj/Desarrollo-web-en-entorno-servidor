<?php
class Conexion {
    private static $conexion;

    public static function conectar() {
        self::$conexion = new mysqli(
            Constantes::BBDD_HOST,
            Constantes::BBDD_USER,
            Constantes::BBDD_CON,
            Constantes::BBDD_NAME
        );

        if (self::$conexion->connect_error) {
            die("Conexión fallida: " . self::$conexion->connect_error);
        }
    }

    public static function desconectar() {
        if (self::$conexion) {
            self::$conexion->close();
        }
    }

    
    public static function crearPartida($partida) {
        self::conectar();

        $tamanio = $partida->getTamanio();
        $minas = $partida->getMinas();

        // Insertar una nueva partida en la base de datos
        $query = "INSERT INTO partida (tamanio, minas) VALUES (?, ?)";
        $stmt = self::$conexion->prepare($query);
        $stmt->bind_param("ii", $tamanio, $minas);

        if ($stmt->execute()) {
            $partidaId = $stmt->insert_id;
            $stmt->close();
            return $partidaId;
        } else {
            $stmt->close();
            return null;
        }
    }

    public static function obtenerProgresoPartida($partidaId) {
        self::conectar();

        // Obtener el progreso de la partida desde la base de datos
        $query = "SELECT * FROM partida WHERE id = ?";
        $stmt = self::$conexion->prepare($query);
        $stmt->bind_param("i", $partidaId);

        if ($stmt->execute()) {
            $resultados = $stmt->get_result();
            $partida = $resultados->fetch_assoc();
            $stmt->close();
            return $partida;
        } else {
            $stmt->close();
            return null;
        }
    }

    public static function actualizarPartida($partida) {
        self::conectar();

        $partidaId = $partida->getId();
        $progreso = $partida->getProgreso();

        // Actualizar el progreso de la partida en la base de datos
        $query = "UPDATE partida SET progreso = ? WHERE id = ?";
        $stmt = self::$conexion->prepare($query);
        $stmt->bind_param("ii", $progreso, $partidaId);
        
        if ($stmt->execute()) {
            $stmt->close();
            self::desconectar();
            return true;
        } else {
            $stmt->close();
            self::desconectar();
            return false;
        }
    }
}

