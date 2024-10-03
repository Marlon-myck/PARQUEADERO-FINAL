<?php
class Vehiculo {
    public $placa;
    public $marca;
    public $color;

    public function __construct($placa, $marca, $color) {
        $this->placa = $placa;
        $this->marca = $marca;
        $this->color = $color;
    }

    public function getPlaca() {
        return $this->placa;
    }

    public function getMarca() {
        return $this->marca;
    }

    public function getColor() {
        return $this->color;
    }
}

