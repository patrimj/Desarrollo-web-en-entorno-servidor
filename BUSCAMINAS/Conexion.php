<?php
class Conexion{
    public $conexion;

    public function login (){ //comprobar contraseña y email
        $sql = "SELECT * FROM usuarios WHERE email = '$this->email' AND password = '$this->password'";
        $resultado = $this->conexion->query($sql);
        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_object();
            return $usuario;
        } else {
            return null;
        }
    
        $this->conexion = new mysqli(Constantes::$host, Constantes::$user, Constantes::$psswd, Constantes::$bdName);
        if ($this->conexion->connect_errno) {
            return "Fallo al conectar a MySQL: (" . $this->conexion->connect_errno . ") " . $this->conexion->connect_error;
        } else {
            return "Conexión establecida";
        }
    }



    // FUNCIONES DEL ADMINISTRADOR
        //Si accede como administrador podrá :  listar los usuarios, buscar un usuario concreto, registrar, modificar y eliminar usuarios . 
    public function listarUsuarios(){
        $sql = "SELECT * FROM usuarios";
        $resultado = $this->conexion->query($sql);
        if ($resultado->num_rows > 0) {
            $usuarios = array();
            while ($usuario = $resultado->fetch_object()) {
                array_push($usuarios, $usuario);
            }
            return $usuarios;
        } else {
            return null;
        }
    } 
    public function buscarUsuarios($email, $password){
        $sql = "SELECT * FROM usuarios WHERE email = '$email' AND password = '$password'";
        $resultado = $this->conexion->query($sql);
        if ($resultado -> )

    }
    
    public function registrarUsuarios(){

    }
    public function modificarUsuarios(){
        
    }
    public function eliminarUsuarios(){
        
    }



    //El administrador gestionará: altas, bajas, modificaciones, activaciones y accesos de los usuarios. 
    public function gestionarAltas($nombre, $apellidos, $email, $password, $rol){
        $sql = "INSERT INTO usuarios (nombre, apellidos, email, password, rol) VALUES ('$nombre', '$apellidos', '$email', '$password', '$rol')";
        $resultado = $this->conexion->query($sql);
            if ($resultado) {
                return "Alta realizada correctamente";
            } else {
                return "Error al realizar el alta";
            }
    }

    public function gestionarBajas($id){
        $sql = "DELETE FROM usuarios WHERE id = '$id'";
        $resultado = $this->conexion->query($sql);
            if ($resultado) {
                return "Baja realizada correctamente";
            } else {
                return "Error al realizar la baja";
            }
    }

    public function gestionarModificaciones($id,$nombre, $apellidos, $email, $password, $rol){
        $sql = "UPDATE usuarios SET nombre = '$nombre', apellidos = '$apellidos', email = '$email', password = '$password', rol = '$rol' WHERE id = '$id'";
        $resultado = $this->conexion->query($sql);
            if ($resultado) {
                return "Modificación realizada correctamente";
            } else {
                return "Error al realizar la modificación";
            }
    }
    public function gestionarActivaciones(){
        $sql = "UPDATE usuarios SET activo = 1 WHERE id = '$this->id'";
        $resultado = $this->conexion->query($sql);
            if ($resultado) {
                return "Activación realizada correctamente";
            } else {
                return "Error al realizar la activación";
            }
    }

    public function gestionarAccesos(){
        $sql = "SELECT * FROM usuarios WHERE email = '$this->email' AND password = '$this->password'";
        $resultado = $this->conexion->query($sql);
            if ($resultado->num_rows > 0) {
                $usuario = $resultado->fetch_object();
                return $usuario;
            } else {
                return null;
            }
    }
}