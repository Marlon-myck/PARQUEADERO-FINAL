<?php
require_once("claseVehiculo.php");

class Carro extends Vehiculo {
    public function tipo(): string {
      return "Carro";
    }
  }