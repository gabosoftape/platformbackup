<?php
require_once '../config/conexion.php';
$redirection = '<script>alert("Usuario actualizado!"); window.location="../admin.php?id='.base64_encode($_POST['id']).'";</script>';

// UPDATE CONTRATISTA
if(isset($_POST['nameresponsable']) ){
	$resultresponsable = $mysqli->query("SELECT id FROM bs_responsable WHERE accountid = ".$_POST['contratistaid']." ");
	$rowresponsable=mysqli_fetch_array($resultresponsable);
	if($rowresponsable['id'] != NULL){
		$mysqli->query("UPDATE bs_responsable SET name = '".$_POST['nameresponsable']."', identification_type_responsable = '".$_POST['identification_type_responsable']."', identification_responsable = '".$_POST['identification_responsable']."' WHERE id = '".$_POST['contratistaid']."'");
	}
	if(isset($_POST['address'])){
		$resultresponsabledireccion = $mysqli->query("SELECT id, address FROM bs_address WHERE parent_id = '".$_POST['contratistaid']."' AND address = '".$_POST['address']."' ");
		$rowresponsabledireccion=mysqli_fetch_array($resultresponsabledireccion);
		if($rowresponsabledireccion['id'] != NULL){
			$mysqli->query("UPDATE bs_address SET address = '".$_POST['address']."' WHERE parent_id = '".$_POST['contratistaid']."' AND address = '".$_POST['address']."' ");
		}
		else{
			$mysqli->query("INSERT INTO bs_address(datecreated, parent_id, address, title, status) VALUES('".date('Y-m-d H:i:s')."' , '".$_POST['contratistaid']."', '".$_POST['address']."', '".$_POST['nameresponsable']."', 1)");
		}
	}
	if(isset($_POST['website'])){
		$mysqli->query("UPDATE bs_account SET website = '".$_POST['website']."' WHERE id = '".$_POST['contratistaid']."' ");
	}
	if(isset($_POST['phones'])){
		$resultresponsablebs_phone = $mysqli->query("SELECT id, phone FROM bs_phone WHERE parent_id = '".$_POST['contratistaid']."' AND phone = '".$_POST['phones']."' ");
		$rowresponsablebs_phone=mysqli_fetch_array($resultresponsablebs_phone);
		if($rowresponsablebs_phone['id'] != NULL){
			$mysqli->query("UPDATE bs_phone SET phone = '".$_POST['phones']."' WHERE parent_id = '".$_POST['contratistaid']."' AND phone = '".$_POST['phones']."' ");
		}
		else{
			$mysqli->query("INSERT INTO bs_phone(datecreated, parent_id, phone, status) VALUES('".date('Y-m-d H:i:s')."' , '".$_POST['contratistaid']."', '".$_POST['phones']."', 1)");
		}
	}
	if(isset($_POST['email'])){
		$resultresponsablebs_email = $mysqli->query("SELECT id, email FROM bs_email WHERE parent_id = '".$_POST['contratistaid']."' AND email = '".$_POST['email']."' ");
		$rowresponsablebs_email=mysqli_fetch_array($resultresponsablebs_email);
		if($rowresponsablebs_email['id'] != NULL){
			$mysqli->query("UPDATE bs_email SET email = '".$_POST['email']."' WHERE parent_id = '".$_POST['contratistaid']."' AND email = '".$_POST['email']."' ");
		}
		else{
			$mysqli->query("INSERT INTO bs_email(datecreated, parent_id, email, status) VALUES('".date('Y-m-d H:i:s')."' , '".$_POST['contratistaid']."', '".$_POST['email']."', 1)");
		}
	}
	echo $redirection;
}
// UPDATE STATUS
if(isset($_POST['activo']) AND isset($_POST['contratistaid'])){
	$mysqli->query("UPDATE bs_account SET status = '".$_POST['activo']."' WHERE id = '".$_POST['contratistaid']."'");
	echo $redirection;
}

// UPDATE CONDUCTOR
if(isset($_POST['name']) AND !isset($_POST['territorial_code']) AND !isset($_POST['motor'])){
	if(isset($_POST['datedriving'])){
		$mysqli->query("UPDATE bs_account SET name = '".$_POST['name']."', identification = '".$_POST['identification']."', datedriving = '".$_POST['datedriving']."' WHERE id = '".$_POST['contratistaid']."'");
	}
	else{
		$mysqli->query("UPDATE bs_account SET name = '".$_POST['name']."', identification = '".$_POST['identification']."' WHERE id = '".$_POST['contratistaid']."'");
	}
	echo $redirection;
}
if(isset($_POST['conductorid'])){
	$mysqli->query("UPDATE bs_account SET status = '".$_POST['activo']."' WHERE id = '".$_POST['conductorid']."'");
	echo $redirection;
}

//UPDATE PERFIL
if(isset($_POST['territorial_code'])){
	$resultperfil = $mysqli->query("SELECT id FROM bs_account WHERE name LIKE '%".$_POST['name']."%' ");
	$rowtipodoc=mysqli_fetch_array($resultperfil);
	if($rowtipodoc['id'] != NULL){
		$mysqli->query("UPDATE bs_account SET name = '".$_POST['name']."', identification = '".$_POST['identification']."', identification_type = '".$_POST['identification_type']."', website = '".$_POST['website']."', territorial_code = '".$_POST['territorial_code']."', resolution_code = '".$_POST['resolution_code']."', date_enabled = '".$_POST['date_enabled']."'  WHERE id = '".$rowtipodoc['id']."'");
	}
	else{
		$mysqli->query("INSERT INTO bs_account(name, identification_type, identification, website, territorial_code, resolution_code, date_enabled) VALUES('Company -".$_POST['name']."' , '".$_POST['identification_type']."' , '".$_POST['identification']."' , '".$_POST['website']."' , '".$_POST['territorial_code']."' , '".$_POST['resolution_code']."' , '".$_POST['date_enabled']."' )");
	}
	$resultphone = $mysqli->query("SELECT id FROM bs_phone WHERE parent_id = '".$_POST['id']."' ");
	$rowphone=mysqli_fetch_array($resultphone);
	if($rowphone['id'] != NULL){
		$mysqli->query("UPDATE bs_phone SET phone = '".$_POST['phones']."', status = 1  WHERE parent_id = '".$_POST['id']."'");
	}
	else{
		$mysqli->query("INSERT INTO bs_phone(datecreated, parent_id, phone, status) VALUES('".date('Y-m-d H:i:s')."' , '".$_POST['id']."' , '".$_POST['phones']."' , 1)");
	}
	$resultemail = $mysqli->query("SELECT id FROM bs_email WHERE parent_id = '".$_POST['id']."' ");
	$rowemail=mysqli_fetch_array($resultemail);
	if($rowemail['id'] != NULL){
		$mysqli->query("UPDATE bs_email SET email = '".$_POST['email']."', status = 1  WHERE parent_id = '".$_POST['id']."'");
	}
	else{
		$mysqli->query("INSERT INTO bs_email(datecreated, parent_id, email, status) VALUES('".date('Y-m-d H:i:s')."' , '".$_POST['id']."' , '".$_POST['email']."' , 1)");
	}
	$resultaddress = $mysqli->query("SELECT id FROM bs_address WHERE parent_id = '".$_POST['id']."' ");
	$rowaddress=mysqli_fetch_array($resultaddress);
	$geotag = '{"lat":'.$_POST['lat'].',"lng":'.$_POST['long'].'}';
	if($rowaddress['id'] != NULL){
		$mysqli->query("UPDATE bs_address SET address = '".$_POST['address']."', geotag = '".$geotag."',  status = 1  WHERE parent_id = '".$_POST['id']."'");
	}
	else{
		$mysqli->query("INSERT INTO bs_address(datecreated, parent_id, address, status) VALUES('".date('Y-m-d H:i:s')."' , '".$_POST['id']."' , '".$_POST['email']."' , 1)");
	}
}

// UPDATE VEHICULO
if(isset($_POST['motor'])){
	$resultvehiculo = $mysqli->query("SELECT id FROM bs_account_unit WHERE name = '".$_POST['name']."' ");
	$rowvehiculo=mysqli_fetch_array($resultvehiculo);
	if($rowvehiculo['id'] != NULL){
		$mysqli->query("
		UPDATE bs_account_unit SET name='".$_POST['name']."',  wialon_id='".$_POST['contratistaid']."', color='".$_POST['color']."', line='".$_POST['line']."', brand='".$_POST['brand']."', model='".$_POST['model']."', motor='".$_POST['motor']."', serie='".$_POST['serie']."', owner='".$_POST['owner']."', operation_number='".$_POST['operation_number']."', type='".$_POST['type']."' WHERE name = '".$_POST['name']."' AND parent_id = '".$_POST['id']."'
		");
		$resultvehiculodata = $mysqli->query("SELECT id FROM bs_account_unit_service_extras WHERE unit_id = '".$rowvehiculo['id']."' ");
		$rowvehiculodata=mysqli_fetch_array($resultvehiculodata);
		
		if($rowvehiculodata['id'] != NULL){
			$mysqli->query("UPDATE bs_account_unit_service_extras SET soat = '".$_POST['soat']."', tecnomecanica = '".$_POST['tecnomecanica']."', tarjetadeoperacion = '".$_POST['tarjetadeoperacion']."' WHERE unit_id = '".$rowvehiculo['id']."'");
		}
		else{
			$mysqli->query("INSERT INTO bs_account_unit_service_extras(unit_id, soat, tecnomecanica, tarjetadeoperacion) VALUES('".$rowvehiculo['id']."' , '".$_POST['soat']."' , '".$_POST['tecnomecanica']."', '".$_POST['tarjetadeoperacion']."')");
		}
	}
	echo $redirection;
}
if(isset($_POST['vehiculoid'])){
	$mysqli->query("UPDATE bs_account_unit SET status = '".$_POST['activo']."' WHERE id = '".$_POST['vehiculoid']."'");
	echo $redirection;
}
?>
