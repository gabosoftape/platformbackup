<?php 
include '../config/conexion.php';
$mysqli->query("UPDATE sys_user SET password = '".$_POST['password']."', pwdemail = 1 WHERE username = '".base64_decode($_POST['us'])."'");

$result = $mysqli->query("SELECT id FROM sys_user WHERE username = '".base64_decode($_POST['us'])."' ");
$row = mysqli_fetch_array($result);

session_start();
$_SESSION['nickname'] = $row['id'];
echo '<script>window.location="../home.php"</script>';
?>