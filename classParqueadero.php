<?php
class Parqueadero {
    public $espacios;
    public $totalPisos = 4;
    public $espaciosPorPiso = 10;

    public function __construct() {
        $this->espacios = array_fill(0, $this->totalPisos * $this->espaciosPorPiso, null);
    }

    public function agregarVehiculo($vehiculo, $cliente, $horaIngreso) {
        foreach ($this->espacios as $indice => $espacio) {
            if ($espacio === null) {
                $this->espacios[$indice] = new Espacio($vehiculo, $cliente, $horaIngreso);
                return;
            }else{
                return "No hay espacios disponibles";
            }
        }

    }

    public function retirarVehiculo($placa) {
        foreach ($this->espacios as $indice => $espacio) {
            if ($espacio !== null && $espacio->getVehiculo()->getPlaca() === $placa) {
                $espacio->setHoraSalida(time());
                $valorAPagar = $espacio->calcularValorAPagar(); 
                $this->espacios[$indice] = null;
                return $valorAPagar;
            }else{
                return "Vehículo no encontrado";
            }
        }

    }

    public function buscarVehiculo($placa) {
        foreach ($this->espacios as $espacio) {
            if ($espacio !== null && $espacio->getVehiculo()->getPlaca() === $placa) {
                return $espacio;
            }else{
                return "Vehículo no encontrado";
            }
        }

    }

    public function mostrarEspacios() {
        $resultados = [];

        foreach ($this->espacios as $indice => $espacio) {
            $piso = intdiv($indice, $this->espaciosPorPiso) + 1;
            $espacioEnPiso = ($indice % $this->espaciosPorPiso) + 1;
            
            if ($espacio === null) {
                $resultados[$piso][$espacioEnPiso] = "Desocupado";
            } else {
                $resultados[$piso][$espacioEnPiso] = sprintf(
                    "Placa: %s, Marca: %s, Color: %s",
                    $espacio->getVehiculo()->getPlaca(),
                    $espacio->getVehiculo()->getMarca(),
                    $espacio->getVehiculo()->getColor()
                );
            }
        }

        return $resultados;
    }
}
