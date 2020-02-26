<?php 
session_start();
// Borra todas las variables de sesión 
$_SESSION = array(); 
// Borra la cookie que almacena la sesión 
if(isset($_COOKIE[session_name()])) { 
	setcookie($_GET['nickname'], '', time() - 4, '/'); 
}
session_name();
$nickname = $_GET['nickname'];
session_destroy(); 
header('location: index.php'); 
?>