<?php
class Espacio {
    public $vehiculo;
    public $cliente;
    public $horaIngreso;
    public $horaSalida;

    public function __construct($vehiculo, $cliente, $horaIngreso) {
        $this->vehiculo = $vehiculo;
        $this->cliente = $cliente;
        $this->horaIngreso = $horaIngreso;
        $this->horaSalida = null;
    }

    public function getVehiculo() {
        return $this->vehiculo;
    }

    public function getCliente() {
        return $this->cliente;
    }

    public function getHoraIngreso() {
        return $this->horaIngreso;
    }

    public function getHoraSalida() {
        return $this->horaSalida;
    }

    public function setHoraSalida($horaSalida) {
        $this->horaSalida = $horaSalida;
    }

    public function calcularValorAPagar() {
        $horaIngreso = $this->horaIngreso;
        $horaSalida = $this->horaSalida ?: time();
        $horas = ceil(($horaSalida - $horaIngreso) / 3600);
        return $horas * 2; 
    }
}

