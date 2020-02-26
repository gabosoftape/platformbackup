<?php
$mysqli = new mysqli('localhost', 'root', 'DoomArt4544!', 'gpscontrol_ws');
mysqli_set_charset($mysqli,'utf8');
if ($mysqli->connect_errno) {
	echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
?>