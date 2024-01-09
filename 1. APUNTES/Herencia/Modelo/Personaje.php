<?php 
class Personaje {
    protected $nombre;
    protected $edad;
    static $AULA=206;

	public function __construct($nombre, $edad) {
		$this->nombre = $nombre;
		$this->edad = $edad;
	}

	public function getNombre() {
		return $this->nombre;
	}

	public function setNombre($value) {
		$this->nombre = $value;
	}

	public function getEdad() {
		return $this->edad;
	}

	public function setEdad($value) {
		$this->edad = $value;
	}

    function __toString()
    {
        return 'Nombre: '.$this->nombre.' Edad: '.$this->edad.' aula: '.self::$AULA;
    }

    static function metodoEstatico(){
        return 'Soy un método estático';
    }

    // function pasear(){
    //     return $this->nombre.' paseando';
    // }

    // function pasear($h){
    //     return $this->nombre.' paseando '.$h.' horas';
    // }

    function pelear(){
        return $this->nombre.' peleando el personaje.';
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

}
