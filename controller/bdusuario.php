<meta charset="utf-8">
<?php 
require_once '../config/conexion.php';
$mysqli->query("UPDATE empresas SET 				
							razonsocial='".$_POST['razonsocial']."',
							tipodocumento='".$_POST['tipodocumento']."',
							documento='".$_POST['documento']."',
							telefono='".$_POST['telefono']."',
							celular='".$_POST['celular']."',
							email='".$_POST['email']."',
							website='".$_POST['website']."',
							address='".$_POST['address']."',
							territorial_code='".$_POST['territorial_code']."',
							resolution_code='".$_POST['resolution_code']."',
							date_enabled='".$_POST['date_enabled']."'
							WHERE id = ".$_POST['id']." 
						");
echo 'Información actualizada';
?>