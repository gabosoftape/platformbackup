<?php 
include 'config/conexion.php'; 
// array(7) { ["n"]=> string(18) "Alexander libreros" ["id"]=> string(2) "10" ["ds"]=> string(11) "avantel 125" ["p"]=> string(13) "+573155263310" ["jp"]=> string(10) "2020/06/15" ["userid"]=> string(1) "3" ["contratoid"]=> string(1) "1" }
$resultfuec = $mysqli->query("SELECT conductor FROM fuec WHERE contratoid ='".$_POST['contratoid']."' ");
$rowfuec=mysqli_fetch_array($resultfuec); 
$conductor = '';
foreach($_POST AS $datos){
	$conductor = $conductor.', '.$datos;
}
$mysqli->query("UPDATE fuec SET conductor = '".trim($rowfuec['conductor'].$conductor, ',')."' WHERE contratoid =  '".$_POST['contratoid']."' ");
echo '<div class="col-12 text-center mt-3">Conductor agregado correctamente!</div>';
?>