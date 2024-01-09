<?php


// Clase para manejar la base de datos
class Database {
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $database = 'mi_app';
  
    private $connection;
  
    public function __construct() {
      $this->connection = mysqli_connect($this->host, $this->user, $this->password, $this->database);
      if (!$this->connection) {
        die('Error de conexión: ' . mysqli_connect_error());
      }
    }
  
    public function query($sql) {
      return mysqli_query($this->connection, $sql);
    }
  
    public function escape($value) {
      return mysqli_real_escape_string($this->connection, $value);
    }
  
    public function lastInsertId() {
      return mysqli_insert_id($this->connection);
    }
  }
  
  // Clase para manejar los usuarios
  class User {
    private $db;
  
    public function __construct() {
      $this->db = new Database();
    }
  
    public function register($name, $email, $password) {
      $name = $this->db->escape($name);
      $email = $this->db->escape($email);
      $password = password_hash($password, PASSWORD_DEFAULT);
      $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', 'jugador')";
      $result = $this->db->query($sql);
      if ($result) {
        return $this->db->lastInsertId();
      } else {
        return false;
      }
    }
  
    public function login($email, $password) {
      $email = $this->db->escape($email);
      $sql = "SELECT * FROM users WHERE email = '$email'";
      $result = $this->db->query($sql);
      $user = mysqli_fetch_assoc($result);
      if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];
        return true;
      } else {
        return false;
      }
    }
  
    public function logout() {
      session_destroy();
    }
  
    public function getUserById($id) {
      $id = $this->db->escape($id);
      $sql = "SELECT * FROM users WHERE id = '$id'";
      $result = $this->db->query($sql);
      return mysqli_fetch_assoc($result);
    }
  
    public function updateUser($id, $name, $email, $password) {
      $id = $this->db->escape($id);
      $name = $this->db->escape($name);
      $email = $this->db->escape($email);
      if ($password) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET name = '$name', email = '$email', password = '$password' WHERE id = '$id'";
      } else {
        $sql = "UPDATE users SET name = '$name', email = '$email' WHERE id = '$id'";
      }
      return $this->db->query($sql);
    }
  
    public function deleteUser($id) {
      $id = $this->db->escape($id);
      $sql = "DELETE FROM users WHERE id = '$id'";
      return $this->db->query($sql);
    }
  
    public function getUsers() {
      $sql = "SELECT * FROM users";
      $result = $this->db->query($sql);
      $users = array();
      while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
      }
      return $users;
    }
  }
  
  // Ejemplo de uso
  $user = new User();
  
  // Registro de usuario
  $user_id = $user->register('Juan', 'juan@example.com', 'password');
  
  // Inicio de sesión
  $user->login('juan@example.com', 'password');
  
  // Obtener información del usuario
  $user_info = $user->getUserById($user_id);
  
  // Actualizar información del usuario
  $user->updateUser($user_id, 'Juan Pérez', 'juan.perez@example.com', 'new_password');
  
  // Eliminar usuario
  $user->deleteUser($user_id);
  
  // Obtener lista de usuarios (solo para administradores)
  if ($_SESSION['user_role'] == 'administrador') {
    $users = $user->getUsers();
  }

  /*

Funcionalidad de gestión de usuarios: Debe haber un sistema de gestión de usuarios accesible solo por los administradores. Para esto, se necesitarán métodos para crear, actualizar, eliminar y listar usuarios. Además, se necesitarán atributos para almacenar la información de los usuarios, como su nombre, email, contraseña, rol y estado de activación.

Funcionalidad de gestión de partidas: Debe haber métodos para crear, actualizar, eliminar y listar partidas. Además, se necesitarán atributos para almacenar la información de las partidas, como el tablero, el número de minas, el estado de la partida y la fecha de creación y modificación.
Funcionalidad de juego: Debe haber métodos para abrir casillas y marcar casillas en una partida. Además, se necesitarán métodos para guardar el estado de la partida y para generar el tablero de juego.
Funcionalidad de historial: Debe haber métodos para guardar el historial de las partidas jugadas, incluyendo el estado del tablero y la acción realizada por el usuario.
Funcionalidad de contabilización de partidas ganadas: Debe haber métodos para contabilizar la cantidad de partidas ganadas por cada usuario.


<?php
// Definir la clase GestorPartidas para gestionar las partidas de buscamina
class GestorPartidas {
    private $partidas;
  
    public function __construct() {
      $this->partidas = array();
    }
  
    public function crearPartida($usuario, $tamano = TAMANO_TABLERO, $num_minas = NUM_MINAS) {
      // Comprobar si el usuario ya tiene una partida abierta
      if (isset($this->partidas[$usuario->getNombre()])) {
        return 'Ya tienes una partida abierta';
      }
  
      // Crear la partida y guardarla
      $partida = new Partida($tamano, $num_minas);
      $this->partidas[$usuario->getNombre()] = $partida;
      return 'Partida creada correctamente';
    }
  
    public function jugar($usuario, $fila, $columna) {
      // Comprobar si el usuario tiene una partida abierta
      if (!isset($this->partidas[$usuario->getNombre()])) {
        return 'No tienes partida abierta';
      }
  
      // Jugar la casilla y devolver el resultado
      $partida = $this->partidas[$usuario->getNombre()];
      $resultado = $partida->jugar($fila, $columna);
      if ($partida->getGanada()) {
        unset($this->partidas[$usuario->getNombre()]);
      }
      return $resultado;
    }
  
    public function rendirse($usuario) {
      // Comprobar si el usuario tiene una partida abierta
      if (!isset($this->partidas[$usuario->getNombre()])) {
        return 'No tienes partida abierta';
      }
  
      // Rendirse y devolver el estado de la partida
      $partida = $this->partidas[$usuario->getNombre()];
      $partida->rendirse();
      unset($this->partidas[$usuario->getNombre()]);
      return 'Partida perdida';
    }
  
    public function getTablero($usuario) {
      // Comprobar si el usuario tiene una partida abierta
      if (!isset($this->partidas[$usuario->getNombre()])) {
        return 'No tienes partida abierta';
      }
  
      // Devolver el tablero de la partida
      $partida = $this->partidas[$usuario->getNombre()];
      return $partida->getTablero();
    }
  }
*/