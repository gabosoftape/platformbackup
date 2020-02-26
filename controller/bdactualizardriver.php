<meta charset="utf-8">
<?php 
require_once '../config/conexion.php';
$resultdriver = $mysqli->query("SELECT id FROM driver WHERE userid = '".$_POST['userid']."' AND id = '".$_POST['driverid']."' ");
$rowdriver=mysqli_fetch_array($resultdriver);
if($rowdriver['id'] == NULL){
	$mysqli->query("INSERT INTO driver(driverid, userid, nombres, tipodoc, documento, telefono, licencia, vegencialicencia) VALUES ('".$_POST['driverid']."', '".$_POST['userid']."', '".$_POST['name']."', '".$_POST['tipodoc']."', '".$_POST['documento']."', '".$_POST['phone']."', '".$_POST['licencia']."', '".$_POST['vigencia']."')");
	echo 'Información actualizada';
}
else{
	$mysqli->query("UPDATE driver SET 				
							nombres='".$_POST['name']."',
							tipodoc='".$_POST['tipodoc']."',
							documento='".$_POST['documento']."',
							telefono='".$_POST['phone']."',
							licencia='".$_POST['licencia']."',
							vegencialicencia='".$_POST['vigencia']."'
							WHERE driverid = '".$_POST['driverid']."'
						");
	echo 'Información actualizada';
}
?>