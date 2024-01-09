<?php
class Factoria {
    public static function crearSerpiente() {
        return new Serpiente();
    }

    public static function crearNido() {
        return new Nido();
    }
}
