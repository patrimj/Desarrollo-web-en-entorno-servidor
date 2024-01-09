<?php

class Usuario { //clase usuario para crear usuarios y administradores con sus respectivos atributos
    public $id; // id del usuario
    public $nombre; // nombre del usuario
    public $email; // email del usuario
    public $password; // password encriptado
    public $rol; // rol para saber si es usuario o administrador
    public $activo; // activo para saber si el usuario esta activo o no

    public function __construct($id, $nombre, $email, $password, $rol, $activo) { //constructor de la clase usuario
      $this->id = $id; 
      $this->nombre = $nombre;
      $this->email = $email;
      $this->password = $password;
      $this->rol = $rol;
      $this->activo = $activo;
    }

    public function getId() ///GETTER de id
    {
        return $this->id;
    }

    public function getNombre()///GETTER de nombre
    {
        return $this->nombre;
    }

    public function getEmail()///GETTER de email
    {
        return $this->email;
    }

    public function getPassword()///GETTER de password
    {
        return $this->password;
    }

    public function getRol()///GETTER de rol
    {
        return $this->rol;
    }

    public function getActivo()///GETTER de activo
    {
        return $this->activo;
    }
    
    function activar() { //funcion para activar el usuario
        $this->activo = true;
    }
    function desactivar() {//funcion para desactivar el usuario
        $this->activo = false;
    }
  }