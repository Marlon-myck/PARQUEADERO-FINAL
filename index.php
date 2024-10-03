<?php
require_once("claseCarro.php");
require_once("claseVehiculo.php");
require_once("claseCliente.php");
require_once("claseTiket.php");
require_once("claseParqueadero.php");

$cli = readline("Nombre: ");
$id = readline("Identificacion: ");
$ss = readline("Ingrese placa: ");
$sa = readline("Ingrese marca: ");
$ssa = readline("Ingrese color: ");
$parqueadero = new Parqueadero(4, 10);
$carro = new Carro($ss, $sa, $ssa);
$cliente = new Cliente($cli, $id);
$vehiculo = $parqueadero->ingresarVehiculo($carro, $cliente, 4, 2) . "\n";
echo $vehiculo;
sleep(3);
echo $parqueadero->retirarVehiculo("sasa") . "\n";
