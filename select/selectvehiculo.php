<?php
include '../config/conexion.php';
$resultaccount = $mysqli->query("SELECT password FROM empresas WHERE id ='".$_POST['userid']."' "); 
$rowaccount=mysqli_fetch_array($resultaccount);
$resultadd1 = $mysqli->query("SELECT unitid, unitvalue, name_driver FROM drivers_units WHERE unitid LIKE '%".$_POST['vehiculobuscar']."%' AND empresaid = '".$_POST['userid']."' ORDER BY unitid ASC LIMIT 5");
while($rowadd1=mysqli_fetch_array($resultadd1)){
	?>	
	<div class="row vehiculotr" id="vehiculotr<?php echo $rowadd1['unitvalue']?>">
		<div class="col-4">
			<br /><input type="radio" name="vehiculo" value="<?php echo $rowadd1['unitvalue']?>" class="form-control" id="vehiculo<?php echo $rowadd1['unitvalue']?>" required />
		</div>
		<div class="col-8">
			<label for="vehiculo<?php echo $rowadd1['unitvalue']?>">Vehículo: <input type="text" name="unitid" class="form-control" value="<?php echo $rowadd1['unitid']?>" readonly /></label>
		</div>
	</div>
	<script>
		$('#vehiculo<?php echo $rowadd1['unitvalue']?>').click(function(){ 
			unitvalue = <?php echo $rowadd1['unitvalue']?>;
			init1vehiculo(unitvalue);
			$('.vehiculotr').hide('fast');
			$('#vehiculotr<?php echo $rowadd1['unitvalue']?>').show('fast');
			$('#placaselected').empty(); 
		});
	</script>
	<?php 
}
?>
