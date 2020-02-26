<meta charset="utf-8">
<?php 
require_once '../config/conexion.php';
$resultcontratista = $mysqli->query("SELECT id FROM contratista WHERE nit = '".$_POST['nit']."' AND userid = '".$_POST['userid']."' ");
$rowcontratista=mysqli_fetch_array($resultcontratista);
if($rowcontratista['id'] == NULL){
	$mysqli->query("INSERT INTO contratista(userid, empresa, nit, nombres, correo, telfijo, celular, direccion, ciudad) VALUES ('".$_POST['userid']."', '".$_POST['empresa']."', '".$_POST['nit']."', '".$_POST['contacto']."', '".$_POST['email']."', '".$_POST['telfijo']."', '".$_POST['celular']."', '".$_POST['direccion']."', '".$_POST['ciudadcontratista']."')");
	echo 'Información actualizada';
}
else{
	$mysqli->query("UPDATE contratista SET 				
							empresa='".$_POST['empresa']."',
							nit='".$_POST['nit']."',
							nombres='".$_POST['contacto']."',
							correo='".$_POST['email']."',
							telfijo='".$_POST['telfijo']."',
							celular='".$_POST['celular']."',
							direccion='".$_POST['direccion']."',
							ciudad='".$_POST['ciudadcontratista']."'
							WHERE id = '".$rowcontratista['id']."'
						");
	echo '<h4 style="background-color:#1D2C65">Información actualizada! cierre la ventana y continue el proceso</h4>';
}
?>