<meta charset="utf-8">
<?php 
require_once '../config/conexion.php';
$resultresponsable = $mysqli->query("SELECT id FROM responsable WHERE nit = '".$_POST['nit']."' AND userid = '".$_POST['userid']."' ");
$rowresponsable=mysqli_fetch_array($resultresponsable);
if($rowresponsable['id'] == NULL){
	$mysqli->query("INSERT INTO responsable(userid, empresa, nit, nombres, correo, telfijo, celular, direccion, ciudad) VALUES ('".$_POST['userid']."', '".$_POST['empresa']."', '".$_POST['nit']."', '".$_POST['contacto']."', '".$_POST['email']."', '".$_POST['telfijo']."', '".$_POST['celular']."', '".$_POST['direccion']."', '".$_POST['ciudadresponsable']."')");
	echo 'Información actualizada';
}
else{
	$mysqli->query("UPDATE responsable SET 				
							empresa='".$_POST['empresa']."',
							nit='".$_POST['nit']."',
							nombres='".$_POST['contacto']."',
							correo='".$_POST['email']."',
							telfijo='".$_POST['telfijo']."',
							celular='".$_POST['celular']."',
							direccion='".$_POST['direccion']."',
							ciudad='".$_POST['ciudadresponsable']."'
							WHERE id = '".$rowresponsable['id']."'
						");
	echo '<h4 style="background-color:#1D2C65">Información actualizada! cierre la ventana y continue el proceso</h4>';
}
?>