<meta charset="utf-8">
<?php 
require_once '../config/conexion.php';
$resultvehiculo = $mysqli->query("SELECT tarjetadeoperacion, tecnomecanica, soat FROM unidad WHERE id = '".$_POST['vehiculo']."'");
$rowvehiculo=mysqli_fetch_array($resultvehiculo);
$resultdriver = $mysqli->query("SELECT vegencialicencia FROM driver WHERE id = '".$_POST['conductor']."' ");
$rowdriver=mysqli_fetch_array($resultdriver);
$mysqli->query("INSERT INTO fuec(contratoid, userid, contratistaid, responsableid, objet_contract, route, route_desc, type_cvn, start, end, vehiculo, conductor, fecha, soat, tecnomecanica, tarjetadeoperacion, licencia) VALUES ('".$_POST['contratoid']."', '".$_POST['userid']."', '".$_POST['contratistaid']."', '".$_POST['responsableid']."', '".$_POST['objet_contract']."', '".$_POST['route']."', '".$_POST['route_desc']."', '".$_POST['type_cvn']."', '".$_POST['start']."', '".$_POST['end']."', '".$_POST['vehiculo']."', '".$_POST['conductor']."', '".date('Y-m-d')."', '".$rowvehiculo['soat']."', '".$rowvehiculo['tecnomecanica']."', '".$rowvehiculo['tarjetadeoperacion']."', '".$rowdriver['vegencialicencia']."')");
echo 'Información actualizada';
?>
<script>
	window.open('/fuec/drivers.php?userid=<?php echo $_POST['userid'];?>&cid=<?php echo $_POST['contratoid'];?>');
	// window.open('/fuec/mpdf/fuec.php?userid=<?php echo $_POST['userid'];?>');
</script>

