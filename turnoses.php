<?php 
include '../config/conexion.php';
$mysqli->query("INSERT INTO mensajes(UNIT, ZONE, POS_TIME, SPEED, LOCATION, CURR_TIME, UNIT_ID) VALUES('".$_GET['UNIT']."', '".$_GET['ZONE']."', '".$_GET['POS_TIME']."', '".$_GET['SPEED']."', '".$_GET['LOCATION']."', '".$_GET['CURR_TIME']."', '".$_GET['UNIT_ID']."')");			
?>