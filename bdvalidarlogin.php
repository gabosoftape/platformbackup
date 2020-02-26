<?php 
include 'config/conexion.php';
$resultaccount = $mysqli->query("SELECT id FROM empresas WHERE user = '".$_GET['user_name']."' ");
$rowaccount = mysqli_fetch_array($resultaccount);
session_start();
if($rowaccount['id'] != NULL){
	$_SESSION['nickname'] = $rowaccount['id'];
	$mysqli->query("UPDATE empresas SET password = '".$_GET['access_token']."' WHERE user = '".$_GET['user_name']."' ");
	header("Location: http://50.116.2.74/fuec/home.php?user_name=".$_GET['user_name']."");
}else{
	if($_GET['user_name'] != NULL AND $_GET['access_token'] != NULL){
		$mysqli->query("INSERT INTO empresas(user, password) VALUES ('".$_GET['user_name']."', '".$_GET['access_token']."')");
		$resultaccount = $mysqli->query("SELECT id FROM empresas WHERE user = '".$_GET['user_name']."' ");
		$rowaccount = mysqli_fetch_array($resultaccount);
		$_SESSION['nickname'] = $rowaccount['id'];
		header("Location: http://50.116.2.74/fuec/home.php?user_name=".$_GET['user_name']."");
	}
	else{
		echo '<script>alert("Acceso no autorizado2); window.location="http://50.116.2.74/fuec/"</script>';
	}
}
?>