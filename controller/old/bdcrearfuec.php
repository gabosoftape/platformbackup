<?php
require_once '../config/conexion.php';
$resultnumerocontrato = $mysqli->query("SELECT contract FROM fuec_doc WHERE contract = (SELECT MAX(contract) FROM fuec_doc)" );
$rownumerocontrato=mysqli_fetch_array($resultnumerocontrato);
$numcontrato = $rownumerocontrato['contract'] + 1;
$bs_unit_id='';
$drivers='';
for($i=0;$i<=100000;$i++){
	if(isset($_POST['vehiculo'.$i])){
		$bs_unit_id=$bs_unit_id.','.$i;
	}
	if(isset($_POST['conductor'.$i])){
		$drivers=$drivers.','.$i;
	}
}
$mysqli->query("DROP TRIGGER IF EXISTS fuec_doc_BEFORE_UPDATE");
$mysqli->query("DROP TRIGGER IF EXISTS fuec_doc_BEFORE_INSERT");
$mysqli->query("INSERT INTO fuec_doc(datecreate, created_by, bs_unit_id, contract,object_contract, route,route_desc,type_cvn, start, end, drivers, bs_responsible_id, consecutive_fuec) VALUES('".date('Y-m-d H:i:s')."', '".$_POST['companyid']."', '".trim($bs_unit_id,',')."', '".$numcontrato."', '".$_POST['objet_contract']."', '".$_POST['route']."', '".$_POST['route_desc']."', '".$_POST['type_cvn']."', '".$_POST['start']."', '".$_POST['end']."', '".trim($drivers,',')."', '".$_POST['contratistaid']."', ".date('YmdHis').$numcontrato.") ");
echo '<script>alert("Registro almacenado!"); window.location="../consultarfuec.php?idf='.base64_encode($numcontrato).'";</script>';
?>