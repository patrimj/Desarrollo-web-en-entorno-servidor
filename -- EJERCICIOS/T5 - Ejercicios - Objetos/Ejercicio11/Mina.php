<?php

class Mina {

    public $tipo; 
    public $itemsOro; 
    public $itemsPiedra;

    public function __construct($tipo, $items) {
        $this->tipo = $tipo;
        $this->itemsOro =500;
        $this->itemsPiedra = 500;
    }

    public function extraerItem() {
        if ($this->tipo === 'ORO' && $this->itemsOro > 0) {
            $this->itemsOro--;
            return 'ORO';
        } elseif ($this->tipo === 'PIEDRA' && $this->itemsPiedra > 0) {
            $this->itemsPiedra--;
            return 'PIEDRA';
        } else {
            return 'AGOTADA';
        }
    }

    /**
     * Get the value of tipo
     */ 
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Get the value of itemsOro
     */ 
    public function getItemsOro()
    {
        return $this->itemsOro;
    }

    /**
     * Get the value of itemsPiedra
     */ 
    public function getItemsPiedra()
    {
        return $this->itemsPiedra;
    }
}