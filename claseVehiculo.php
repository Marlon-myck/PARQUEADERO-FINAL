<?php
abstract class Vehiculo {
    protected $placa;
    protected $marca;
    protected $color;
  
    public function __construct($placa, $marca, $color) {
      $this->placa = $placa;
      $this->marca = $marca;
      $this->color = $color;
    }
    abstract public function tipo(): string;
  
    public function getPlaca(): string {
      return $this->placa;
    }
  
    public function getMarca(): string {
      return $this->marca;
    }
  
    public function getColor(): string {
      return $this->color;
    }
  }