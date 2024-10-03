<?php
class Parqueadero {
    private $pisos = [];
    private $tickets = [];
  
    public function __construct($numeroPisos, $espaciosPorPiso) {
      for ($i = 1; $i <= $numeroPisos; $i++) {
        $this->pisos[$i] = array_fill(1, $espaciosPorPiso, null);
      }
    }
  
    public function ingresarVehiculo(Vehiculo $vehiculo, Cliente $cliente, $piso, $espacio) {
      if (isset($this->pisos[$piso][$espacio])) {
        $this->pisos[$piso][$espacio] = $vehiculo;
        $ticket = new Ticket($vehiculo, $cliente, date("Y-m-d H:i:s"), date("Y-m-d H:i:s"));
        $this->tickets[$vehiculo->getPlaca()] = $ticket;
        return "Vehículo ingresado con éxito. Piso: $piso, Espacio: $espacio. Ticket: " . $vehiculo->getPlaca();
      } else {
        return "El espacio seleccionado no está disponible.";
      }
    }
  
    public function retirarVehiculo($placa) {
      $ticket = $this->tickets[$placa] ?? null;
      if ($ticket) {
        foreach ($this->pisos as $piso => $espacios) {
          $espacio = array_search($ticket->getVehiculo(), $espacios);
          if ($espacio !== false) {
            $this->pisos[$piso][$espacio] = null;
            $ticket->registrarSalida(date("Y-m-d H :i:s"));
            $valorAPagar = $ticket->calcularValorAPagar();
            return "Vehículo retirado con éxito. Piso: $piso, Espacio: $espacio. Valor a pagar: $valorAPagar USD.";
          }
        }
      } else {
        return "El vehículo no se encuentra en el parqueadero.";
      }
    }
  }
  

  