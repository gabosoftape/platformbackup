<meta charset="utf-8">
<?php 
require_once '../config/conexion.php';
$resultunidad = $mysqli->query("SELECT id FROM unidad WHERE userid = '".$_POST['userid']."' AND placaunit = '".$_POST['placaunit']."' ");
$rowunidad=mysqli_fetch_array($resultunidad);
if($rowunidad['id'] == NULL){
	$mysqli->query("INSERT INTO unidad(userid, placa, placaunit, modelo, marca, clase, numerointerno, tarjetadeoperacion, tecnomecanica, soat) VALUES ('".$_POST['userid']."', '".$_POST['placa']."', '".$_POST['placaunit']."', '".$_POST['modelo']."', '".$_POST['marca']."', '".$_POST['clase']."', '".$_POST['numerointerno']."', '".$_POST['tarjetadeoperacion']."', '".$_POST['tecnomecanica']."', '".$_POST['soat']."')");
	echo 'Información actualizada';
}
else{
	$mysqli->query("UPDATE unidad SET 			
							placa='".$_POST['placa']."',
							placaunit='".$_POST['placaunit']."',
							modelo='".$_POST['modelo']."',
							marca='".$_POST['marca']."',
							clase='".$_POST['clase']."',
							numerointerno='".$_POST['numerointerno']."',
							tarjetadeoperacion='".$_POST['tarjetadeoperacion']."',
							tecnomecanica='".$_POST['tecnomecanica']."',
							soat='".$_POST['soat']."'
							WHERE placaunit = '".$_POST['placaunit']."'
						");
	echo 'Información actualizada';
}
?>