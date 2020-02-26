<?php
require_once '../config/conexion.php';
if(isset($_POST['contratistaid'])){
	if(isset($_POST['add'])){
		$mysqli->query("UPDATE bs_account SET parent_id = '".$_POST['id']."' WHERE id = '".$_POST['contratistaid']."'");
	}
	if(isset($_POST['remove'])){
		$mysqli->query("UPDATE bs_account SET parent_id = null WHERE id = '".$_POST['contratistaid']."'");
	}
	if(isset($_POST['website'])){
		$mysqli->query("UPDATE website SET website = '".$_POST['website']."' WHERE id = '".$_POST['contratistaid']."'");
	}
}
if(isset($_POST['addvehiculoid'])){
	$mysqli->query("UPDATE bs_account_unit SET parent_id = '".$_POST['id']."' WHERE id = '".$_POST['addvehiculoid']."'");
}
if(isset($_POST['removevehiculo'])){
	$mysqli->query("UPDATE bs_account_unit SET parent_id = NULL WHERE id = '".$_POST['bsunidadidremove']."'");
}





?>
<script>
alert('Usuario actualizado!');
window.location="../admin.php?id=<?php echo base64_encode($_POST['id']);?>";
</script>