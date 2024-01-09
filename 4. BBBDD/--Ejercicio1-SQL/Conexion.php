<?php
require 'Modelo/Persona.php';
class Conexion
{
    static $conexion;

    private static function conectar()
    {   $cod = 0;
        try {
            self::$conexion = mysqli_connect(Constantes::$host, Constantes::$user, Constantes::$psswd, Constantes::$bdName);
        }catch(Exception $e){
            $cod = 1;
        }
        return $cod;
    }

    private static function desconectar()
    {
        mysqli_close(self::$conexion);
    }

    public static function seleccionarPersona($email,$pas)
    {
        if (self::conectar()==0){
            $consulta = "SELECT * FROM personas WHERE email = ? AND pass = ?";
            $stmt = mysqli_prepare(self::$conexion, $consulta);
            mysqli_stmt_bind_param($stmt, "ss", $email,$pass);
            mysqli_stmt_execute($stmt);
            $correcto = [];
            $correcto_query = mysqli_stmt_get_result($stmt);
            if ($fila = mysqli_fetch_array($correcto_query)) {
                $p = new Persona($fila["DNI"], $fila["Nombre"], $fila["Clave"], $fila["Tfno"]);
                $correcto[] = $p;
                self::desconectar();
                return ($fila['id']);
            }
            else {
                self::desconectar();
                return 0;
            }
        }
        else {
            return -1; //conexión falla.
        }
        
    }

    public static function seleccionarTodasPersonas()
    {
        self::conectar();
        if (!self::$conexion) {
            die();
        } else {
            $consulta = "SELECT * FROM personas";
            $stmt = mysqli_prepare(self::$conexion, $consulta);
            mysqli_stmt_execute($stmt);
            $correcto = [];
            $correcto_query = mysqli_stmt_get_result($stmt);
            while ($fila = mysqli_fetch_array($correcto_query)) {
                $p = new Persona($fila["DNI"], $fila["Nombre"], $fila["Clave"], $fila["Tfno"]);
                $correcto[] = $p;
            }
            mysqli_free_result($correcto_query);
        }
        self::desconectar();
        return $correcto;
    }

    public static function insertarPersona($persona)
    {
        self::conectar();
        $correcto = false;
        if (!self::$conexion) {
            die();
        } else {
            $query = "INSERT INTO personas(DNI, Nombre, Clave, Tfno) VALUES (?,?,?,?)";
            $stmt = mysqli_prepare(self::$conexion, $query);
            $dni = $persona->getDni();
            $name = $persona->getNombre();
            $clave = $persona->getClave();
            $tfno = $persona->getTfno();;

            mysqli_stmt_bind_param($stmt, "ssis", $dni, $name, $clave, $tfno);
            try {
                if (mysqli_stmt_execute($stmt)) {
                    $correcto = true;
                }
            } catch (Exception $e) {
                $correcto = false;
            }
            self::desconectar();
        }
        return $correcto;
    }

    public static function borrarPersona($dniPersona)
    {
        self::conectar();
        $correcto = false;
        if (!self::$conexion) {
            die();
        } else {
            $query = "DELETE FROM personas WHERE DNI = '$dniPersona'";
            try {

                $correcto = mysqli_query(self::$conexion, $query);
            } catch (Exception $e) {
                $correcto = false;
            }
            self::desconectar();
        }
        return $correcto;
    }



    public static function modificarPersona($dniCambiar, $data)
    {
        $correcto = false;
        self::conectar();
        if (!self::$conexion) {
            die();
        } else {
            $query = 'UPDATE personas SET Nombre = ?, Clave = ?, Tfno=  ? where DNI = ?';
            $stmt = mysqli_prepare(self::$conexion, $query);
            mysqli_stmt_bind_param($stmt, "siss", $data['Nombre'], $data['Clave'], $data['Tfno'], $dniCambiar);
            try {
                mysqli_stmt_execute($stmt);
                $correcto = true;
            } catch (Exception $e) {
                $correcto = false;
            }
        }
        self::desconectar();
        return $correcto;
    }
}
