<?php 
require_once('classVehiculo.php');
require_once('classCliente.php');
require_once('classParqueadero.php');

$parqueadero = new Parqueadero();

while (true) {
    $accion = readline("¿Desea agregar o retirar un vehículo?\n(agregar)\n(retirar)\n(salir)\nsu opción es:");
    if (strtolower($accion) == "salir") {
        break;
    }

    if (strtolower($accion) == "agregar") {
        $placa = readline("Ingrese la placa del vehículo: ");
        $marca = readline("Ingrese la marca del vehículo: ");
        $color = readline("Ingrese el color del vehículo: ");
        $nombreCliente = readline("Ingrese el nombre del cliente: ");
        $documentoCliente = readline("Ingrese el documento del cliente: ");

        $vehiculo = new Vehiculo($placa, $marca, $color);
        $cliente = new Cliente($nombreCliente, $documentoCliente);

        if ($parqueadero->agregarVehiculo($vehiculo, $cliente, time())) {
            echo "Vehículo agregado exitosamente.\n";
            guardarDatosEnXML($parqueadero);
        } else {
            echo "No hay espacios disponibles.\n";
        }
    } elseif (strtolower($accion) == "retirar") {
        $placa = readline("Ingrese la placa del vehículo a retirar: ");
        try {
            $valorAPagar = $parqueadero->retirarVehiculo($placa);
            echo "Vehículo retirado exitosamente. Valor a Pagar: $$valorAPagar\n";
            guardarDatosEnXML($parqueadero);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . "\n";
        }
    } else {
        echo "Acción no reconocida. Por favor elija agregar o retirar.\n";
    }

    try {
        $espacio = $parqueadero->buscarVehiculo($placa);
        echo "Información del Vehículo:\n";
        echo "Placa: " . $espacio->getVehiculo()->getPlaca() . "\n";
        echo "Marca: " . $espacio->getVehiculo()->getMarca() . "\n";
        echo "Color: " . $espacio->getVehiculo()->getColor() . "\n";
        echo "Nombre Cliente: " . $espacio->getCliente()->getNombre() . "\n";
        echo "Documento Cliente: " . $espacio->getCliente()->getDocumento() . "\n";
        echo "Hora de Ingreso: " . date('Y-m-d H:i:s', $espacio->getHoraIngreso()) . "\n";
        echo "Hora de Salida: " . ($espacio->getHoraSalida() ? date('Y-m-d H:i:s', $espacio->getHoraSalida()) : 'N/A') . "\n";
        echo "Valor a Pagar: $" . ($espacio->getHoraSalida() ? $espacio->calcularValorAPagar() : 'N/A') . "\n";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "\n";
    }

    echo "Estado de los Espacios:\n";
    $espacios = $parqueadero->mostrarEspacios();
    echo "Tabla de Espacios:\n";
    foreach ($espacios as $piso => $espaciosEnPiso) {
        foreach ($espaciosEnPiso as $espacioEnPiso => $estado) {
            echo "Piso: $piso, Espacio: $espacioEnPiso, Estado: $estado\n";
        }
    }
}


function guardarDatosEnXML($parqueadero) {
    $xml = new SimpleXMLElement('<parqueadero/>');
    foreach ($parqueadero->mostrarEspacios() as $piso => $espaciosEnPiso) {
        $pisoNode = $xml->addChild('piso', $piso);
        foreach ($espaciosEnPiso as $espacioEnPiso => $estado) {
            $espacioNode = $pisoNode->addChild('espacio', $espacioEnPiso);
            $espacioNode->addChild('estado', $estado);
        }
    }
    $xml->asXML('datos_parqueadero.xml');
}

