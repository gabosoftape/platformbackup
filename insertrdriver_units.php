<?php 
include 'config/conexion.php';
$mysqli->query("INSERT INTO drivers_units(empresaid, unitid, unitvalue) VALUES('".$_POST['empresaid']."', '".$_POST['unitid']."', '".$_POST['unitvalue']."'); ");
?>