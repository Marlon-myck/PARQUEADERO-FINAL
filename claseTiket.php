<?php
class Ticket {
    private $vehiculo;
    private $cliente;
    private $horaIngreso;
    private $horaSalida;
  
    public function __construct(Vehiculo $vehiculo, Cliente $cliente, $horaIngreso, $horaSalida) {
      $this->vehiculo = $vehiculo;
      $this->cliente = $cliente;
      $this->horaIngreso = $horaIngreso;
      $this->horaSalida = $horaSalida;
    }
  
    public function registrarSalida($horaSalida) {
      $this->horaSalida = $horaSalida;
    }
  
    public function calcularValorAPagar(): float {
      $tiempoEstacionado = (strtotime($this->horaSalida) - strtotime($this->horaIngreso)) / 3600; 
      $valorAPagar = ceil($tiempoEstacionado) * 2; // $2 USD por hora o fracción
      return $valorAPagar;
    }
  
    public function getVehiculo(): Vehiculo {
      return $this->vehiculo;
    }
  
    public function getCliente(): Cliente {
      return $this->cliente;
    }
  
    public function getHoraIngreso(): string {
      return $this->horaIngreso;
    }
  
    public function getHoraSalida(): ?string {
      return $this->horaSalida;
    }
  }