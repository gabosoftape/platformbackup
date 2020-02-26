<table class="table table-striped table-bordered text-center">
	<tr>
		<th>
			<b><i class="fas fa-check-square font25px"></i></b>
		</th>
		<th>
			<b>PLACA</b>
		</th>
		<th>
			<b>MODELO</b>
		</th>
		<th>
			<b>MARCA</b>
		</th>
		<th>
			<b>CLASE</b>
		</th>
		<th>
			<b>NÚMERO INTERNO</b>
		</th>
		<th>
			<b>NÚMERO DE OPERACIÓN</b>
		</th>
		<th>
			<b>TECNOMECANICA</b>
		</th>
		<th>
			<b>SOAT</b>
		</th>
	</tr>
</table>
<div id="responsecampospers"></div>
	<?php 
	include 'config/conexion.php';
	$resultvehiculo = $mysqli->query("SELECT unitid, unitvalue, name_driver FROM drivers_units WHERE empresa = '".$_POST['userid']."'");
	while($rowvehiculo=mysqli_fetch_array($resultvehiculo)){
		?>
		
		<script>
			$.ajax({
				data : {
					unitvalue : '<?php echo $rowvehiculo['unitvalue']?>'
				},
				url:   'campos_personalizados.php',
				type:  'POST',
				beforeSend: function () {
					$("#responsecampospers").html("Procesando, espere por favor...");
				},
				success:  function (response){
					$("#responsecampospers").html(response);
				}
			});
		</script>
		
		<?php 
	}
	?>
