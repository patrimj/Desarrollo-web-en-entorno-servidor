<?php
// los métodos comer, dormir y hacerRuido. deben ser obligatorios para cualquier nuevo animal doméstico que se añada nuevo. 
interface AInterface { // LOS METODOS OBLIGATORIOS
    public function comer();
    public function dormir();
    public function hacerRuido();
}