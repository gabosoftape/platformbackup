<table class="table table-responsive fontsize12 table-striped table-bordered table-hover table-condensed">
	<?php
	include '../config/conexion.php';
	$resultadd1 = $mysqli->query("SELECT id, empresa, nit, nombres, correo, telfijo, celular, direccion, ciudad FROM contratista WHERE concat_ws(empresa, nit, nombres) LIKE '%".$_POST['selectpickup']."%' AND userid = '".$_POST['userid']."'	ORDER BY empresa ASC LIMIT 10");
	while($rowadd1=mysqli_fetch_array($resultadd1)){
		$resultciudad = $mysqli->query("SELECT nombre FROM ciudades WHERE idCiudad = '".$rowadd1['ciudad']."' ");
		$rowciudad = mysqli_fetch_array($resultciudad);
		?>
		<tr>
			<td class="colorce0002 fontsize10">									
				<input type="radio" name="contratistaid" id="contratistaid" value="<?php echo $rowadd1['id']?>" />
			</td>
			<td class="colorce0002 fontsize10">									
				<label><?php echo strtoupper($rowadd1['empresa']);?></label>
			</td>
			<td class="colorce0002 fontsize10">									
				<label style="white-space: nowrap;"><?php echo $rowadd1['nit'];?></label>
			</td>
			<td class="colorce0002 fontsize10">									
				<?php echo ucwords($rowadd1['nombres']);?>
			</td>
			<td class="fontsize10">									
				<?php echo ucwords($rowciudad['nombre']);?>
			</td>
			<td class="fontsize10">									
				<?php echo ucwords($rowadd1['direccion']);?>
			</td>
			<td class="fontsize10">									
				<?php echo $rowadd1['telfijo'].' - '.$rowadd1['celular'];?>
			</td>
			<td class="fontsize10">									
				<?php echo strtolower($rowadd1['correo']);?>
			</td>
		</tr>
		<?php

	}
	
	?>  

</table>