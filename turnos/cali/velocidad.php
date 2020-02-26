<?php 
include '../../config/conexion.php';
$resultgeocerca = $mysqli->query("SELECT ZONE, SPEED FROM mensajes_cali WHERE UNIT = '".$rowturno['UNIT']."' ORDER BY id DESC LIMIT 1");
$rowgeocerca=mysqli_fetch_array($resultgeocerca);
if($rowgeocerca['ZONE'] != 'parking airport' AND intval($_GET['SPEED']) > 80){
	if(intval($rowgeocerca['SPEED']) > intval($_GET['SPEED'])){
		$mysqli->query("UPDATE mensajes_cali SET SPEED = '".$_GET['SPEED']."' WHERE UNIT_ID = '".$_GET['UNIT_ID']."' ");
	}
}
?>