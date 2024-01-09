Vamos a realizar una aplicación WEB que permita gestionar partidas de buscamina. 

La aplicación guardará las partidas activas y el histórico de las partidas jugadas (hayan sido ganadas o perdidas); también se contabilizará la cantidad de partidas ganadas. 
Asimismo la aplicación permitirá un sistema de gestión de usuarios accesible solo por los administradores.
Nuestra aplicación tendrá los siguientes roles: administrador y jugador.

El administrador gestionará: altas, bajas, modificaciones, activaciones y accesos de los usuarios. 
El administrador será otro jugador que podrá seleccionar como quiere acceder a la aplicación. Si accede como administrador podrá : listar los usuarios, buscar un usuario concreto, registrar, modificar y eliminar usuarios. 
También estará habilitado para cambiar la contraseña de un usuario concreto.
Si entra como jugador será un jugador más.

//!!!!AQUI ME QUEDÉ

Para implementar la funcionalidad descrita en el enunciado, se pueden seguir los siguientes pasos:

Crear una tabla en la base de datos para almacenar los usuarios, con campos como id, nombre, email, password, rol y activo.
Implementar un formulario de registro de usuarios, que permita a los usuarios crear una cuenta con su nombre, email y contraseña.
Implementar un sistema de autenticación de usuarios, que permita a los usuarios iniciar sesión con su email y contraseña.
Implementar una página de perfil de usuario, que muestre la información del usuario y permita al usuario actualizar su información.
Implementar una página de administración de usuarios, que solo sea accesible por los usuarios con rol de administrador. Esta página debe permitir al administrador ver la lista de usuarios registrados, buscar un usuario concreto, registrar, modificar y eliminar usuarios, y cambiar la contraseña de un usuario concreto.
Implementar un sistema de control de acceso, que impida que los usuarios sin rol de administrador accedan a la página de administración de usuarios.
Implementar un sistema de activación de usuarios, que permita al administrador activar o desactivar la cuenta de un usuario.

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
    $sql = "INSERT INTO users (name, email, password, rol, activo) VALUES ('$name', '$email', '$password', 'jugador', 1)";
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
    if ($user && password_verify($password, $user['password']) && $user['activo']) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_name'] = $user['name'];
      $_SESSION['user_role'] = $user['rol'];
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

  public function searchUser($query) {
    $query = $this->db->escape($query);
    $sql = "SELECT * FROM users WHERE name LIKE '%$query%' OR email LIKE '%$query%'";
    $result = $this->db->query($sql);
    $users = array();
    while ($row = mysqli_fetch_assoc($result)) {
      $users[] = $row;
    }
    return $users;
  }

  public function changePassword($id, $password) {
    $id = $this->db->escape($id);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET password = '$password' WHERE id = '$id'";
    return $this->db->query($sql);
  }

  public function activateUser($id) {
    $id = $this->db->escape($id);
    $sql = "UPDATE users SET activo = 1 WHERE id = '$id'";
    return $this->db->query($sql);
  }

  public function deactivateUser($id) {
    $id = $this->db->escape($id);
    $sql = "UPDATE users SET activo = 0 WHERE id = '$id'";
    return $this->db->query($sql);
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

// Buscar usuarios (solo para administradores)
if ($_SESSION['user_role'] == 'administrador') {
  $users = $user->searchUser('Juan');
}

// Cambiar contraseña de usuario (solo para administradores)
if ($_SESSION['user_role'] == 'administrador') {
  $user->changePassword($user_id, 'new_password');
}

// Activar/desactivar usuario (solo para administradores)
if ($_SESSION['user_role'] == 'administrador') {
  $user->activateUser($user_id);
  $user->deactivateUser($user_id);
}

El jugador podrá crear partidas personalizadas o estándar. 
Si en la url se especifica tamaño de tablero y minas se creará un buscaminas con esas características. 
En caso contrario se creará un buscaminas con un tamaño y número de minas predefinidos (esta cantidad deberá estar parametrizada en la clase de constantes de la aplicación). 
El jugador jugará indicando (POST + json) qué casilla quiere destapar, el cliente le informará de lo que pueda ocurrir: no tienes partida creada, no tienes partida abierta, partida abierta y has destapado una casilla no mina, partida abierta y has destapado una mina... 
En caso de que no haya partida abierta se informa de ello. En caso de partida abierta se informa al cliente de ello y se le enviarán los tableros en json para que el cliente haga lo que estime oportuno con ellos.
El jugador podrá solicitar rendirse, (verbo y forma de proporcionar información al servidor depende del programador). Se cerrará esa partida y se informará al cliente de cómo estaban los tableros y de que se ha cerrado esa partida que se considera perdida.
El jugador también podrá solicitar un cambio de contraseña, para ello debe proporcionar su email al servidor (piensa el verbo y el modo más correcto de hacer esto).
Finalmente el jugador podrá solicitar el ranking de jugadores. Se le devolverá una lista de usuarios ordenada de mayor a menor de más ganadas a menos. De igual manera el verbo y la forma de solicitar el ranking depende del programador.

Respecto a la programación, se valorará:
- La elección correcta de los verbos.
- Paso por el lugar indicado y en el formato adecuado de los datos desde el
cliente al servidor.
- Protección de las rutas, de modo que solo el usuario que sea administrador
pueda administrar y un usuario jugador pueda jugar. No se admiten invitados
en nuestra aplicación; solo registrados correctamente.
- Se le enviará al cliente en el formato adecuado la información correspondiente
en cada solicitud de servicio, teniendo en cueta: códigos coherentes y estándar; y la información que sea necesaria, en el formato adecuado, para que el cliente pueda montar la interfaz del juego con todos los datos necesarios.
- Diseño y acceso a la base de datos de forma correcta.
- Estructuración del código: Controladores, Factorías, Rutas (index.php), Conexión, Modelos....
- Se debe usar la librería MySQLi orientada a objetos.
- La clase Constantes se debe poner en .gitignore.
- La base de datos exportada no debería estar en el repositorio pero, por esta
vez, no pasaría nada si la subimos al repositorio.

ARCHIVOS
- index.php
- enunciado.php
- .gitignore
- README.md
- buscamina_db.sql
AUXILIAR
- Factoria.php
- Controlador.php
- Conexion.php
MODELO (aqui iran las clases necesarias)
- Constantes.php
- Usuario.php
- Partida.php
- Tablero.php
- Casilla.php
- Ranking.php
- Buscaminas.php
- Jugador.php
- Administrador.php
- PartidaPersonalizada.php
- PartidaEstandar.php
- PartidaActiva.php

