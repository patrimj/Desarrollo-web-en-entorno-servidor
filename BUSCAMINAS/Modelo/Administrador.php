<?php
class Administrador{
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
    
    function __construct($id, $nombre, $apellidos, $email, $password, $rol) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->password = $password;
        $this->rol = $rol;
    }
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }
    
    function getApellidos() {
        return $this->apellidos;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }
    
    function getRol() {
        return $this->rol;
    }

    function setId($id) {
        $this->id = $id;
    }
    
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    
    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    function setEmail($email) {
        $this->email = $email;
    }
    
    function setPassword($password) {
        $this->password = $password;
    }
    
    function setRol($rol) {
        $this->rol = $rol;
    }
    
    function __toString() {
        return "Id: " . $this->id . " Nombre: " . $this->nombre . " Apellidos: " . $this->apellidos . " Email: " . $this->email . " Password: " . $this->password . " Rol: " . $this->rol;
    }   

    




/*---------------------------------------------------------------------------------------------------------------------
El administrador gestionará: altas, bajas, modificaciones, activaciones y accesos de los usuarios. 
El administrador será otro jugador que podrá seleccionar como quiere acceder a la aplicación. 
Si accede como administrador podrá :  listar los usuarios, buscar un usuario concreto, registrar, modificar y eliminar usuarios . 
También estará habilitado para cambiar la contraseña  de un usuario concreto. 
Si entra como jugador será un jugador más.

----------------------------------------------------------------------------------------------------------------------------*/
}