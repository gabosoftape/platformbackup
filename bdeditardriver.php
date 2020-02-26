<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once 'config/conexion.php';
$resultunidad = $mysqli->query("SELECT nombres, tipodoc, documento, licencia, vegencialicencia FROM driver WHERE userid = '".$_POST['userid']."' AND id = '".$_POST['driverid']."' ");
$rowunidad=mysqli_fetch_array($resultunidad);
?>
<div class="row form-group">
	<div class="col-4">
		Tipo documento
	</div>
	<div class="col-8">
		<select name="tipodoc" class="form-control">
			<?php 
			$selected1='';
			$selected2='';
			$selected3='';
			if($rowunidad['tipodoc'] == 1){
				$selected1='selected';
				$selected2='';
				$selected3='';
			}
			elseif($rowunidad['tipodoc'] == 2){
				$selected1='';
				$selected2='selected';
				$selected3='';
			}
			elseif($rowunidad['tipodoc'] == 3){
				$selected1='';
				$selected2='';
				$selected3='selected';
			}
			?>
			<option value="" disabled></option>
			<option value="1" <?php echo $selected1?>>Cédula de ciudadania</option>
			<option value="2" <?php echo $selected2?>>Cédula de extrangería</option>
			<option value="3" <?php echo $selected3?>>Pasaporte</option>
		</select>
	</div>
</div>
<div class="row form-group">
	<div class="col-4">
		Documento 
	</div>
	<div class="col-8">
		<input type="number" name="documento" id="documento" class="form-control" value="<?php echo isset($rowunidad['documento'])?$rowunidad['documento']:'';?>" />
	</div>
</div>
<div class="row form-group">
	<div class="col-4">
		No. licencia 
	</div>
	<div class="col-8">
		<input type="text" name="licencia" id="licencia" class="form-control" value="<?php echo isset($rowunidad['licencia'])?$rowunidad['licencia']:'';?>" />
	</div>
</div> 
<div class="row form-group">
	<div class="col-4">
		Vigencia licencia 
	</div>
	<div class="col-8">
		<input type="date" name="vigencia" id="vigencia" class="form-control" value="<?php echo isset($rowunidad['vegencialicencia'])?$rowunidad['vegencialicencia']:'';?>" />
	</div>
</div>
<input type="hidden" name="driverid" value="<?php echo $_POST['driverid']?>">
<input type="button" class="btn background213C6C" id="actualizardriver" value="Actualizar" />
<script>
$("#actualizardriver").click(function(){
	var data = $('#bdeditardriver').serializeArray();
	data.push({name:'userid', value:'<?php echo $_POST['userid'];?>'});
	data.push({name:'name', value:'<?php echo $_POST['name'];?>'});
	data.push({name:'phone', value:'<?php echo $_POST['phone'];?>'});
	$.ajax({
		data : data,
		url:   'controller/bdactualizardriver.php',
		type:  'POST',
		beforeSend: function () {
			$("#ubicationContent").html("Processing, please wait...");
		},
		success:  function (response) {
			$("#ubicationContent").html(response);
		}
	});
});
</script>

