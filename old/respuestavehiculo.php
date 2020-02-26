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
	</tr>
	<?php 
	include 'config/conexion.php';
	$resultvehiculo = $mysqli->query("SELECT id, name, line, brand, model, internal_number, operation_number, type FROM bs_account_unit WHERE parent_id = '".base64_decode($_POST['id'])."'");
	while($rowvehiculo=mysqli_fetch_array($resultvehiculo)){
		$resultvehiculodata = $mysqli->query("SELECT soat, tecnomecanica, tarjetadeoperacion FROM bs_account_unit_service_extras WHERE unit_id = '".$rowvehiculo['id']."' ");
		$rowvehiculodata=mysqli_fetch_array($resultvehiculodata);
		if($rowvehiculodata['soat'] != NULL){
			if($_POST['start'] > date("Y-m-d",strtotime($rowvehiculodata['soat']."- 1 year")) AND $rowvehiculodata['soat'] > $_POST['end']){
				if($_POST['start'] > date("Y-m-d",strtotime($rowvehiculodata['tecnomecanica']."- 1 year")) AND $rowvehiculodata['tecnomecanica'] > $_POST['end']){
					if($_POST['start'] > date("Y-m-d",strtotime($rowvehiculodata['tarjetadeoperacion']."- 1 year")) AND $rowvehiculodata['tarjetadeoperacion'] > $_POST['end']){
						?>
						<tr>
							<td>
								<input type="checkbox" name="vehiculo<?php echo $rowvehiculo['id']?>" id="vehiculo<?php echo $rowvehiculo['id']?>" value="<?php echo $rowvehiculo['id']?>" />
							</td>
							<td>
								<label for="vehiculo<?php echo $rowvehiculo['id']?>"><?php echo strtoupper($rowvehiculo['name']);?></label>
							</td>
							<td>
								<label for="vehiculo<?php echo $rowvehiculo['id']?>"><?php echo $rowvehiculo['model'];?></label>
							</td>
							<td>
								<label for="vehiculo<?php echo $rowvehiculo['id']?>"><?php echo $rowvehiculo['brand'];?></label>
							</td>
							<td>
								<label for="vehiculo<?php echo $rowvehiculo['id']?>"><?php echo $rowvehiculo['line'];?></label>
							</td>
							<td>
								<label for="vehiculo<?php echo $rowvehiculo['id']?>"><?php echo $rowvehiculo['internal_number'];?></label>
							</td>
							<td>
								<label for="vehiculo<?php echo $rowvehiculo['id']?>"><?php echo $rowvehiculo['operation_number'];?></label>
							</td>
						</tr>
						<?php
					}
				}
			}
		}
	}
	?>
</table>