<?php
//esto es una clase
class Personaje{
    public $nombre; // ponerlo en publico 
    public $edad;
    public $v;
    static $AULA = 206;

    /* 
    function __construct($n, $e ) /// en php solo hay 1 constructor, me la juego a uno solo
    {
        self ::$CONT++;//como se accede a una variable estatica desde un metodo
       $this -> nombre = $n;
       $this -> edad = $e;
    }*/

    public function __construct($nombre, $edad) {
		$this->nombre = $nombre;
		$this->edad = $edad;
        $this->v = ['1A' => 1, '2B' => 2];
	}

    //como se genera el constructor y el getter y setter --> seleccionamos atributos y generate all

    /**
     * Get the value of nombre
     */ 
    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($value){ // metemos valor
        $this->nombre = $value;
        
    }

    /**
     * Get the value of edad
     */ 
    public function getEdad(){
        return $this->edad;
    }

    /**
     * Set the value of edad
     *
     * @return  self
     */ 
    public function setEdad($value){
        $this->edad = $value;
    }

function __toString(){
    return 'Nombre: '.$this-> nombre .' Edad: '.$this-> edad. 'aula: '.self::$AULA;
}

static function metodoEstatico(){
    return 'soy un metodo estatico';
}
// function pasear(){
    //     return $this->nombre.' paseando';
    // }

    // function pasear($h){
    //     return $this->nombre.' paseando '.$h.' horas';
    // }

    function pelear(){
        return $this->nombre.' peleando.';
    }

    function __call($name, $arguments)
    {
        if ($name == 'pasear'){
            if (count($arguments)>0){
                return $this->nombre.' paseando '.$arguments[0].' horas';
            }
            else {
                return $this->nombre.' paseando';
            }
        }
    }

};

?>