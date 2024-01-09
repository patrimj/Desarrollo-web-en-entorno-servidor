<?php

class Partida {// clase Partida para gestionar las partidas de buscamina
  public $id;  // id de la partida
  public $id_usuario;// id del usuario
  public $tablero;// tablero de la partida
  public $tableroVisible;// tablero visible de la partida
  public $minas;// minas de la partida
  public $estado;// estado de la partida  
  public $fecha_creacion;// fecha de creacion de la partida 
  public $fecha_modificacion;// fecha de modificacion de la partida 
  public $jugadas;// jugadas de la partida
  public $ganada;// partidas ganadas

  public function __construct($id_usuario, $tamano_tablero, $num_minas) { //constructor de la clase partida
    $this->id_usuario = $id_usuario; 
    $this->tablero = array();// tablero formado por un array donde se guardaran las casillas
    $this->tablero_visible = array(); // tablero visible formado por un array donde se guardaran las casillas
    $this->minas = array();// minas formado por un array donde se guardaran las casillas con minas
    $this->estado = 'abierta';// estado de la partida abierto por defecto
    $this->fecha_creacion = date('Y-m-d H:i:s'); // fecha de creacion de la partida
    $this->fecha_modificacion = date('Y-m-d H:i:s');// fecha de modificacion de la partida
  }
public function getGanada(){// funcion para obtener las partidas ganadas 
  return $this->ganada;}

  public function getId() {// funcion para obtener el id de la partida
    return $this->id;
  }
  public function getIdUsuario() {// funcion para obtener el id del usuario
    return $this->id_usuario;
  }
  public function getTableroVisible() {// funcion para obtener el tablero visible de la partida
    return $this->tableroVisible;
  }
  public function getMinas() {// funcion para obtener las minas de la partida
    return $this->minas;
  }
  public function getEstado() {// funcion para obtener el estado de la partida
    return $this->estado;
  }
  public function getFechaCreacion() {// funcion para obtener la fecha de creacion de la partida
    return $this->fecha_creacion;
  }
  public function getFechaModificacion() {// funcion para obtener la fecha de modificacion de la partida
    return $this->fecha_modificacion;
  }
  public function setTablero($tablero){// funcion para establecer el tablero de la partida
    return $this->tablero = $tablero;
  }
  public function setTableroVisible($tableroVisible){ // funcion para establecer el tablero visible de la partida
    return $this->tableroVisible = $tableroVisible;
  }
  public function setEstado($estado){// funcion para establecer el estado de la partida
    return $this->estado = $estado;
  }


// Inicializar el tablero y el tablero visible como un único array
  for ($i = 0; $i < $tamano_tablero * $tamano_tablero; $i++) {// bucle para recorrer el tablero
    $this->tablero[$i] = 0;// tablero inicializado a 0
    $this->tablero_visible[$i] = '-';// tablero visible inicializado a -
  }
// colocamos las minas en el tablero
  $minas_colocadas = 0; // minas colocadas inicializadas a 0
    while ($minas_colocadas < $num_minas) { //mientras las minas colocadas sean menores que el numero de minas
      $posicion = rand(0, $tamano_tablero * $tamano_tablero - 1); // posicion aleatoria entre 0 y el tamaño del tablero
      if ($this->tablero[$posicion] != '*') {// si la posicion del tablero es diferente a -1, es decir que no tiene una mina todavia
        $this->tablero[$posicion] = '*';// la posicion del tablero sera -1 para indicar que hay una mina  en esa posicion
        $this->minas[] = $posicion; // se añade la posicion al array de minas
        $minas_colocadas++;// se incrementa el numero de minas colocadas
      }
    }

// Inicializar las jugadas
  $this->jugadas = array(); // jugadas inicializadas a array para guardar las jugadas 
  $this->ganada = false; // partida ganada inicializada a false, es decir que no se ha ganado la partida
  
  function jugar($posicion) { // funcion para jugar pasandole la posicion
    
    if (isset($this->jugadas[$posicion])) { // Comprobar si la casilla ya ha sido jugada [isset — Determina si una variable está definida y no es NULL]
      return 'Casilla ya jugada';
    }
  
  // Comprobar si la casilla es una mina
    if ($this->tablero[$posicion] == '*') { // si la posicion del tablero es igual a -1
      $this->ganada = false;// la partida se considera perdida
        return 'Mina encontrada';// se devuelve mina encontrada
    }
  
  // Calcular el número de minas adyacentes
    $minas_adyacentes = 0; // minas adyacentes inicializadas a 0
    $tamano_tablero = count($this->tablero); // tamaño del tablero
    $columna = $posicion;// columna igual a la posicion
    for ($i = max(0, $columna - 1); $i <= min($tamano_tablero - 1, $columna + 1); $i++) { //si la columna es mayor que 0 y menor que el tamaño del tablero menos 1, se incrementa la columna
      if ($this->tablero[$i] == '*') { // si la posicion del tablero es igual a -1
        $minas_adyacentes++;// se incrementa el numero de minas adyacentes, es decir, se ha encontrado una mina adyacente
      }
    }
  // Marcar la casilla como jugada y comprobar si se ha ganado la partida
    $this->jugadas[$posicion] = $minas_adyacentes; // se guarda la posicion de la jugada y el numero de minas adyacentes
      if (count($this->jugadas) == count($this->tablero) - count($this->minas)) { // si el numero de jugadas es igual al tamaño del tablero menos el numero de minas
        $this->ganada = true;// la partida se considera ganada
        return 'Partida ganada';// se devuelve partida ganada
      }
  // Devolver el número de minas adyacentes
      return $minas_adyacentes;
    }

    public function rendirse() { // funcion para rendirse
      foreach ($this->minas as $mina) {// para cada mina
        $this->jugadas[$mina] = 'M';// se guarda la posicion de la jugada con una M para indicar que hay una mina
      }
      $this->ganada = false;
      $this->estado = 'perdida';
    }
  
    public function getTablero() {
      // Devolver el tablero con las jugadas realizadas
      $tablero_jugado = array(); // tablero jugado inicializado a array
      for ($i = 0; $i < count($this->tablero); $i++) { // para cada posicion del tablero 
        if (isset($this->jugadas[$i])) {// si la posicion del tablero ha sido jugada
          $tablero_jugado[] = $this->jugadas[$i]; // se guarda la posicion de la jugada
        } else {
          $tablero_jugado[] = $this->tablero_visible[$i];// se guarda la posicion del tablero visible
        }
      }
      return $tablero_jugado; // se devuelve el tablero jugado
    }

  public function abrirCasilla($posicion) { // funcion para abrir una casilla pasandole la posicion
    if (isset($this->jugadas[$posicion])) {// si la posicion de la jugada esta definida
      return false;// se devuelve false
    }
    if ($this->tablero[$posicion] == '*') {// si la posicion del tablero es igual a * es decir, si hay una mina
      $this->jugadas[$posicion] = 'M';// se guarda la posicion de la jugada con una M para indicar que hay una mina
      $this->ganada = false; // la partida se considera perdida
      $this->estado = 'perdida'; //
      return true;//
    }
    $minas_adyacentes = 0; // minas adyacentes inicializadas a 0
    $tamano_tablero = count($this->tablero);//// tamaño del tablero
    $columna = $posicion;// columna igual a la posicion
    for ($i = max(0, $columna - 1); $i <= min($tamano_tablero - 1, $columna + 1); $i++) {//si la columna es mayor que 0 y menor que el tamaño del tablero menos 1, se incrementa la columna
      if ($this->tablero[$i] == '*') {// si la posicion del tablero es igual a -1
        $minas_adyacentes++;// se incrementa el numero de minas adyacentes, es decir, se ha encontrado una mina adyacente
      }
    }
    $this->jugadas[$posicion] = $minas_adyacentes;//// se guarda la posicion de la jugada y el numero de minas adyacentes
    if (count($this->jugadas) == count($this->tablero) - count($this->minas)) {// si el numero de jugadas es igual al tamaño del tablero menos el numero de minas
      $this->ganada = true;// la partida se considera ganada
      $this->estado = 'ganada';
    }
    return false;
  }

  public function marcarCasilla($posicion) { // funcion para marcar una casilla pasandole la posicion
    if (isset($this->jugadas[$posicion])) { //// si la posicion de la jugada esta definida
      return false;
    }
    $this->jugadas[$posicion] = 'M'; // se guarda la posicion de la jugada con una M para indicar que hay una mina
    if ($this->tablero[$posicion] == '*') {// si la posicion del tablero es igual a -1
      return true;
    }
    return false;
  }
}

function guardar(){ // funcion para guardar la partida en la base de datos

}


