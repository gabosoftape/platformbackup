<table class="table table-striped table-bordered text-center">
	<tr>
		<th>
			<b><i class="fas fa-check-square font25px"></i></b>
		</th>
		<th>
			<b>NOMBRES Y APELLIDOS</b>
		</th>
		<th>
			<b>No. CÉDULA</b>
		</th>
		<th>
			<b>No. LICENCIA CONDUCCION</b>
		</th>
		<th>
			<b>VIGENCIA</b>
		</th>
	</tr>
	<?php 
	include 'config/conexion.php';
	$resultconductor = $mysqli->query("SELECT * FROM driver WHERE userid = '".$_POST['userid']."'");
	while($rowconductor=mysqli_fetch_array($resultconductor)){
		if($rowconductor['vegencialicencia'] != NULL){
			if($rowconductor['vegencialicencia'] > $_POST['end']){
			?>
			<tr>
				<td>
					<input type="checkbox" name="conductor" id="conductor" value="<?php echo $rowconductor['id']?>" />
				</td>
				<td>
					<label for="conductor<?php echo $rowconductor['id']?>"><?php echo ucwords($rowconductor['nombres'])?></label>
				</td>
				<td>
					<label for="conductor<?php echo $rowconductor['id']?>">	<?php echo $rowconductor['tipodoc'].' '.$rowconductor['documento']?></label>
				</td>
				<td>
					<label for="conductor<?php echo $rowconductor['id']?>"><?php echo $rowconductor['licencia']?></label>
				</td>
				<td>
					<label for="conductor<?php echo $rowconductor['id']?>"><?php echo $rowconductor['vegencialicencia']?></label>
				</td>
			</tr>
			<?php
			}
		}
	}
	?>
</table>