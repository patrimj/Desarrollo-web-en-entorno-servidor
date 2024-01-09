<?php
// Definir la clase GestorUsuarios para gestionar los usuarios de la aplicación
class GestorUsuarios {
    private $usuarios;
  
    public function __construct() {
      $this->usuarios = array();
    }
  
    public function registrarUsuario($nombre, $password) {
      // Comprobar si el usuario ya existe
      if (isset($this->usuarios[$nombre])) {
        return 'Usuario ya registrado';
      }
  
      // Registrar el usuario
      $this->usuarios[$nombre] = new Usuario($nombre, $password);
      return 'Usuario registrado correctamente';
    }
  
    public function modificarPassword($nombre, $password) {
      // Comprobar si el usuario existe
      if (!isset($this->usuarios[$nombre])) {
        return 'Usuario no registrado';
      }
  
      // Modificar la contraseña del usuario
      $this->usuarios[$nombre]->password = $password;
      return 'Contraseña modificada correctamente';
    }
  
    public function eliminarUsuario($nombre) {
      // Comprobar si el usuario existe
      if (!isset($this->usuarios[$nombre])) {
        return 'Usuario no registrado';
      }
  
      // Eliminar el usuario
      unset($this->usuarios[$nombre]);
      return 'Usuario eliminado correctamente';
    }
  
    public function listarUsuarios() {
      // Devolver la lista de usuarios
      $lista_usuarios = array();
      foreach ($this->usuarios as $usuario) {
        $lista_usuarios[] = $usuario->getNombre();
      }
      return $lista_usuarios;
    }
  
    public function buscarUsuario($nombre) {
      // Comprobar si el usuario existe
      if (!isset($this->usuarios[$nombre])) {
        return 'Usuario no registrado';
      }
  
      // Devolver el usuario
      return $this->usuarios[$nombre];
    }
  
    public function login($nombre, $password) {
      // Comprobar si el usuario existe y la contraseña es correcta
      if (!isset($this->usuarios[$nombre]) || $this->usuarios[$nombre]->getPassword() != $password) {
        return false;
      }
  
      // Devolver el usuario
      return $this->usuarios[$nombre];
    }
  }