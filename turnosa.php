<HTML>
<HEAD>
</HEAD>
<BODY>
	<body onload="setInterval('location.reload()',10000)">
	<?php 
	include '../config/conexion.php';
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	
		
	$resultturno = $mysqli->query("SELECT UNIT, POS_TIME, UNIT_ID FROM mensajes WHERE CURR_TIME >= '".date('Y-m-d 00:00:00')."' " );
	while($rowturno=mysqli_fetch_array($resultturno)){
		echo $rowturno['UNIT'].' - '.$rowturno['POS_TIME'].'<br />';
	}
	?>
</BODY>
</HTML>