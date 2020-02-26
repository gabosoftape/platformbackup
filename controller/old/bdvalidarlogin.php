<?php
include '../config/conexion.php';
if(isset($_POST['username']) && isset($_POST['password'])){
	$_POST['username'] = mysqli_real_escape_string($mysqli, $_POST['username']);
	$_POST['password'] = mysqli_real_escape_string($mysqli, $_POST['password']);
	$result = $mysqli->query("SELECT id, pwdemail FROM sys_user WHERE username = '".$_POST['username']."' ");
	$row = mysqli_fetch_array($result);
	if($row['pwdemail'] == NULL){
		echo '<script>window.location="../setaccess.php?us='.base64_encode($_POST['username']).'"</script>';
	}
	else{
		$result = $mysqli->query("SELECT id, pwdemail FROM sys_user WHERE username = '".$_POST['username']."' AND password = '".$_POST['password']."' ");
		$row = mysqli_fetch_array($result);
		
		
		if($row	!= NULL){
			session_start();
			$_SESSION['nickname'] = $row['id'];
			echo '<script>window.location="../home.php"</script>';
		}
		else{
			echo '<script>alert("Acceso no permitido! Intenta de Nuevo!");</script>';
			echo '<script>window.location="../index.php"</script>';
		}
	}
}
?>