<?php 
$mysqli = new mysqli('localhost', 'gabosoft', 'gabosoft1234!', 'gpscontrol_ws');
mysqli_set_charset($mysqli,'utf8');
if ($mysqli->connect_errno) {
	echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$mysqli->query("DELETE FORM mensajes WHERE UNIT = '".$_GET['UNIT'].".' ");	
$mysqli->query("DELETE FROM mensajes WHERE UNIT_ID = '".$_GET['UNIT_ID']."' "); 
$mysqli->query("ALTER TABLE mensajes DROP id");
$mysqli->query("ALTER TABLE mensajes AUTO_INCREMENT = 1");
$mysqli->query("ALTER TABLE mensajes ADD id int NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST"); 
?>