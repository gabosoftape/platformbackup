<?php
include 'config/conexion.php';
$sesion=$_POST['user'];
$empresa=$_POST['empresa'];
$contrato=$_POST['contrato'];
$ruta=$_POST['ruta'];
$detalle_ruta=$_POST['detalle_ruta'];

echo $empresa;
echo $contrato;
echo $ruta;
echo $detalle_ruta;

$mysqli->query("INSERT INTO rutas(idempresa, contrato, ruta, detalle_ruta) VALUES ('$empresa' , '$contrato', '$ruta', '$detalle_ruta') ");

echo $mysqli->query;
$comilla="'";
header('Location:/fuec/crearfuec.php?userid='.$empresa.'');
?>
