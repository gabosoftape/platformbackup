<?php
include '../config/conexion.php';
if(isset($_GET['user_name']) AND isset($_GET['access_token'])){
	$user = $_GET['user_name']; 
	$password = $_GET['access_token'];
	$result = $mysqli->query("SELECT id FROM empresas WHERE user = '".$user."' ");
	$row = mysqli_fetch_array($result);
	if($row['id'] != NULL){
		session_start();
		$_SESSION['nickname']=$row['id'];
		$mysqli->query("UPDATE empresas SET password = '".$password."' WHERE id = '".$row['id']."' ");
		echo '<script>window.location="../home.php"</script>';
	}
	else{
		$mysqli->query("INSERT INTO empresas(user, password) VALUES('".$user."', '".$password."') ");
		$result = $mysqli->query("SELECT id FROM empresas WHERE user = '".$user."' ");
		$row = mysqli_fetch_array($result);
		session_start();
		$_SESSION['nickname']=$row['id'];
		echo '<script>window.location="../home.php"</script>'; 
	}
}
else{
	echo '<script>alert("Acceso no permitido! Intenta de Nuevo!");</script>	';
	echo '<script>window.location="../index.php"</script>';
}
?>