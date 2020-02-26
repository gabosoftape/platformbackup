<?php 
$mysqli = new mysqli('localhost', 'root', 'Gpscontrol**3160', 'gpscontrol_ws');
mysqli_set_charset($mysqli,'utf8');
if ($mysqli->connect_errno) {
	echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$idborrar = $_GET['UNIT'];
$mysqli->query("DELETE FROM mensajes_cali WHERE UNIT = '$idborrar' ");
$mysqli->query("ALTER TABLE mensajes_cali DROP id");
$mysqli->query("ALTER TABLE mensajes_cali AUTO_INCREMENT = 1");
$mysqli->query("ALTER TABLE mensajes_cali ADD id int NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST"); 


header('Location:/fuec/turnos/cali/index.php');
?> 