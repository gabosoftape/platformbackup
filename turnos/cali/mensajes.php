<?php 
include '../../config/conexion.php';
$mysqli->query("DELETE FROM mensajes_cali WHERE UNIT_ID = '".$_GET['UNIT_ID']."' ");
$mysqli->query("ALTER TABLE mensajes_cali DROP id");
$mysqli->query("ALTER TABLE mensajes_cali AUTO_INCREMENT = 1");
$mysqli->query("ALTER TABLE mensajes_cali ADD id int NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST");

if($_GET['SPEED'] <=81){
	$_GET['SPEED'] = 0;
}

$mysqli->query("INSERT INTO mensajes_cali(UNIT, ZONE, POS_TIME, SPEED, LOCATION, CURR_TIME, UNIT_ID) VALUES('".$_GET['UNIT']."', '".$_GET['ZONE']."', '".$_GET['POS_TIME']."', '".$_GET['SPEED']."', '".$_GET['LOCATION']."', '".$_GET['CURR_TIME']."', '".$_GET['UNIT_ID']."')");
?>