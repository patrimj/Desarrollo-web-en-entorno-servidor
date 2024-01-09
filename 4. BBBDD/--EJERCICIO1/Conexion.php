<?php

class Conexion {
    private static $conexion;

    public static function conectar() {
    
        self::$conexion = new mysqli(Constantes::BBDD_HOST, Constantes::BBDD_USER, Constantes::BBDD_CON, Constantes::BBDD_NAME);
        if (self::$conexion->connect_error) {
            die("Conexión fallida: " . self::$conexion->connect_error);
        }
    }
    //try cach si todo correcto return 0 y si mal returno 1 // luego en el index si devuelve 0 bien si devuelve 1 error en la conex si devuelve 2 error en insertar

    public static function desconectar() {
        if (self::$conexion) {
            self::$conexion->close();
        }
    }

    public static function obtenerTodas() {
        self::conectar();
        $query = "SELECT * FROM personas";
        $resultados = self::$conexion->query($query);

        $personas = array(); //se utilizará para almacenar personas de la bbdd

        if ($resultados->num_rows > 0) {
            while ($fila = $resultados->fetch_assoc()) { //fetch_assoc es un método que se utiliza en PHP para obtener una fila de resultados como un array asociativo
                $persona = new Persona($fila['DNI'], $fila['Nombre'], $fila['Clave'], $fila['Tfno']);
                $personas[] = $persona;
            }
        }

        self::desconectar();
        return $personas;
    }

    public static function obtenerPorDNI($dni) {
        self::conectar();
        $query = "SELECT * FROM personas WHERE DNI = ?";
        $stmt = self::$conexion->prepare($query);

        if ($stmt) { //Se verifica si la preparación de la sentencia fue correcta
            $stmt->bind_param("s", $dni); //"s": Cadena -->  bind_param para vincular el valor de $dni al parámetro de la consulta preparada
            $stmt->execute();
            $resultados = $stmt->get_result();

            if ($resultados->num_rows > 0) {
                $fila = $resultados->fetch_assoc();//Se extrae la primera fila
                $persona = new Persona($fila['DNI'], $fila['Nombre'], $fila['Clave'], $fila['Tfno']);
                $stmt->close();
                self::desconectar();
                return json_encode (['persona' => $persona]);
            } else {
                echo 'Persona no encontrada<br>';
                return json_encode(['error' => 'Persona no encontrada']);
            }
        }

        $stmt->close();
        self::desconectar();
        return null;
    }

    public static function insertar($persona) {
        self::conectar();
        $query = "INSERT INTO personas (DNI, Nombre, Clave, Tfno) VALUES (?, ?, ?, ?)";
        $stmt = self::$conexion->prepare($query);

        if ($stmt) {
            $dni = $persona->getDNI();
            $nombre = $persona->getNombre();
            $clave = $persona->getClave();
            $tfno = $persona->getTfno();

            //"s": Cadena (string)."i": Entero (integer).
            $stmt->bind_param("ssis", $dni, $nombre, $clave, $tfno);

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

    public static function borrar($dni) {
        self::conectar();
        $query = "DELETE FROM personas WHERE DNI = ?";
        $stmt = self::$conexion->prepare($query);
    
        if ($stmt) {
            $stmt->bind_param("s", $dni); // Enlaza el parámetro DNI en la consulta
            if ($stmt->execute()) {
                $stmt->close();
                self::desconectar();
                return true; 
            } else {
                $stmt->close();
                self::desconectar();
                return false; 
            }
        } else {
            $stmt->close();
            self::desconectar();
            return false;
        }
    }

    public static function modificar($dni, $nombre, $clave, $tfno) {
        self::conectar();
        $query = "UPDATE personas SET Nombre=?, Clave=?, Tfno=? WHERE DNI=?";
        $stmt = self::$conexion->prepare($query);

        if ($stmt) {
    
            $stmt->bind_param("siss", $nombre, $clave, $tfno, $dni);

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
}        

