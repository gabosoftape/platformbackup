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
	$resultconductor = $mysqli->query("SELECT id, name, identification, identification_type, status, driving, datedriving FROM bs_account WHERE name NOT LIKE '%Company -%' AND parent_id = ".base64_decode($_POST['id'])." ");
	while($rowconductor=mysqli_fetch_array($resultconductor)){
		if($rowconductor['datedriving'] != NULL){
			
			if($rowconductor['datedriving'] > $_POST['end']){
			?>
			<tr>
				<td>
					<input type="checkbox" name="conductor<?php echo $rowconductor['id']?>" id="conductor<?php echo $rowconductor['id']?>" value="<?php echo $rowconductor['id']?>" />
				</td>
				<td>
					<label for="conductor<?php echo $rowconductor['id']?>"><?php echo ucwords($rowconductor['name'])?></label>
				</td>
				<td>
					<label for="conductor<?php echo $rowconductor['id']?>">	<?php echo $rowconductor['identification_type'].' '.$rowconductor['identification']?></label>
				</td>
				<td>
					<label for="conductor<?php echo $rowconductor['id']?>"><?php echo $rowconductor['driving']?></label>
				</td>
				<td>
					<label for="conductor<?php echo $rowconductor['id']?>"><?php echo $rowconductor['datedriving']?></label>
				</td>
			</tr>
			<?php
			}
		}
	}
	?>
</table>