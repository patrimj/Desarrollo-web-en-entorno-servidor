<?php
class Serpiente{
    public $anillas = [];
    public $viva = true;
    public $color = ['r','v','a'];
    public $aniosVividos = 0;

    public function __construct(){

    }

    /**
     * @return mixed
     */
    public function getAnillas()
    {
        return $this->anillas;
    }

    /**
     * @param mixed $anillas
     */
    public function setAnillas($anillas)
    {
        $this->anillas = $anillas;
    }
    public function getVida(){
        return $this->viva;
    }
    public function setVida($viva){
        $this->viva = $viva;
    }

    public function nacer($color){
      $this->anillas = $color;
    }
    public function aniadeAnilla(){
        array_push($this->anillas, $this->color[rand(0,count($this->color)-1)]);
    }
    public function quitarAnilla(){
        if (sizeof($this->anillas) > 0){
            array_pop($this->anillas);
        }else{
            $this->morir();
        }
    }
    public function mudar(){
        array_shift($this->anillas);
    }
    public function getAniosVividos(){
        return sizeof($this->anillas);
    }
    public function pasarAnio(){
        $this->aniadeAnilla();
    }
    public function morir(){
        $this->anillas = [];
        $this->viva = false;
    }
}