<?php
require_once 'config/conexion.php';
$resultcompany = $mysqli->query("SELECT name, identification, identification_type, territorial_code FROM bs_account WHERE wialon_id = '".base64_decode($_POST['id'])."' ");
$rowcompany=mysqli_fetch_array($resultcompany);

$resultcontrato = $mysqli->query("SELECT contract, bs_unit_id, object_contract, route, route_desc, start, end, type_cvn, drivers, bs_responsible_id, consecutive_fuec FROM fuec_doc WHERE id = ".$_POST['idfuec']." ");
$rowcontrato=mysqli_fetch_array($resultcontrato);
?>
<div class="col-12 backgroundF8 font12px">
	<div class="row backgroundFFF bordesDivBottom padding5px">
		<div class="col-8">
			<b>RAZÓN SOCIAL </b> 
			<?php echo strtoupper($rowcompany['name'])?>
		</div>
		<div class="col-4">
			<b><?php echo strtoupper($rowcompany['identification_type'])?></b> 
			<?php echo strtoupper($rowcompany['identification'])?>
		</div>
	</div>
	<div class="row backgroundFFF bordesDivBottom padding5px">
		<div class="col-12">
			<b>CONTRATO No. </b> 
			<?php 
			echo $rowcontrato['contract'];
			?>
		</div>
	</div>
	<div class="row backgroundFFF bordesDivBottom padding5px">
		<div class="col-4">
			<b>CONTRATISTA </b>
		</div>
		<div class="col-8">
			<?php 
				$resultresponsable = $mysqli->query("SELECT name, identification, identification_type FROM bs_account WHERE id = ".$rowcontrato['bs_responsible_id']." ");
				$rowresponsable=mysqli_fetch_array($resultresponsable);
				echo strtoupper($rowresponsable['name']);
			?>
		</div>
	</div>
	<div class="row backgroundFFF bordesDivBottom padding5px">
		<div class="col-4">
			<b>RESPONSABLE </b>
		</div>
		<div class="col-8" id="responsable">
			<?php 
				$resultresponsable = $mysqli->query("SELECT name, identification, identification_type FROM bs_account WHERE id = ".$rowcontrato['bs_responsible_id']." ");
				$rowresponsable=mysqli_fetch_array($resultresponsable);
				echo strtoupper($rowresponsable['name']);
			?>
		</div>
	</div>
	<div class="row backgroundFFF bordesDivBottom padding5px">
		<div class="col-4">
			<b>OBJETO DEL CONTRATO </b>
		</div>
		<div class="col-8">
			<?php 
			echo ucfirst($rowcontrato['object_contract']);
			?>
		</div>
	</div>
	<div class="row backgroundFFF bordesDivBottom padding5px">
		<div class="col-4">
			<b>ORIGEN-DESTINO, DESCRIBIENDO EL RECORRIDO </b>
		</div>
		<div class="col-8">
			<?php 
			echo ucwords($rowcontrato['route']);
			?>
		</div>
	</div>
	<div class="row backgroundFFF bordesDivBottom padding5px">
		<div class="col-4">
			<b>DESCRIPCION DEL RECORRIDO </b>
		</div>
		<div class="col-8">
			<?php 
			echo ucfirst($rowcontrato['route']);
			?>
		</div>
	</div>
	<div class="row backgroundFFF bordesDivBottom padding5px">
		<div class="col-4">
			<b>CONVENIOS </b>
		</div>
		<div class="col-8">
			<div class="row">
				<?php
				$chckd1='';
				$chckd2='';
				$chckd3='';
				if($rowcontrato['type_cvn'] == 1){
					$chckd1='checked';
				}
				elseif($rowcontrato['type_cvn'] == 2){
					$chckd2='checked';
				}
				elseif($rowcontrato['type_cvn'] == 3){
					$chckd3='checked';
				}
				?>
				<div class="col-4">
					<label for="type_cvn1">Convenio</label> <input type="radio" name="type_cvn" id="type_cvn1" disabled <?php echo $chckd1;?> />
				</div>
				<div class="col-4">
					<label for="type_cvn2">Consorcio</label> <input type="radio" name="type_cvn" id="type_cvn2" disabled <?php echo $chckd2;?> />
				</div>
				<div class="col-4">
					<label for="type_cvn3">Unión temporal</label> <input type="radio" name="type_cvn" id="type_cvn3" disabled <?php echo $chckd3;?> />
				</div>
			</div>
		</div>
	</div>
	<div class="row background213C6C text-center bordesDivBottom padding5px">
		<div class="col-12">
			<b>VIGENCIA DEL CONTRATO </b>
		</div>
	</div>
	<div class="row backgroundFFF bordesDivBottom padding5px">
		<div class="col-3">
			<label for="type_cvn1"><b>FECHA INICIAL</b></label>
		</div>
		<div class="col-3">
			<?php echo substr($rowcontrato['start'],0,10);?>
		</div>
		<div class="col-3">
			<label for="type_cvn1"><b>FECHA VENCIMIENTO</b></label> 
		</div>
		<div class="col-3">
			<?php echo substr($rowcontrato['end'],0,10);?>
		</div>
	</div>
	<div class="row background213C6C text-center bordesDivBottom padding5px">
		<div class="col-12">
			<b>CARACTERÍSTICAS DEL VEHÍCULO </b>
		</div>
	</div>
	<div class="row backgroundFFF bordesDivBottom padding5px">
		<div class="table-responsive">
			<table class="table table-striped table-bordered text-center">
				<tr>
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
				$vehiculos = explode(',',$rowcontrato['bs_unit_id']);
				foreach($vehiculos AS $vehiculo){
					$resultvehiculo = $mysqli->query("SELECT name, line, brand, model, internal_number, operation_number, operation_number, type FROM bs_account_unit WHERE id = '".$vehiculo."'");
					$rowvehiculo=mysqli_fetch_array($resultvehiculo);
					?>
					<tr>
						<td>
							<?php echo $rowvehiculo['name'];?>
						</td>
						<td>
							<?php echo $rowvehiculo['model'];?>
						</td>
						<td>
							<?php echo $rowvehiculo['brand'];?>
						</td>
						<td>
							<?php echo $rowvehiculo['line'];?>
						</td>
						<td>
							<?php echo $rowvehiculo['internal_number'];?>
						</td>
						<td>
							<?php echo $rowvehiculo['operation_number'];?>
						</td>
					</tr>
					<?php
				}
				?>
			</table>
		</div>
	</div>
	<div class="row background213C6C text-center bordesDivBottom padding5px">
		<div class="col-12">
			<b>CONDUCTORES</b>
		</div>
	</div>
	<div class="row backgroundFFF bordesDivBottom padding5px">
		<div class="table-responsive">
			<table class="table table-striped table-bordered text-center">
				<tr>
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
				$conductores = explode(',',$rowcontrato['drivers']);
				foreach($conductores AS $conductor){
					$resultconductor = $mysqli->query("SELECT id, name, identification, identification_type, status, driving, datedriving FROM bs_account WHERE id = '".$conductor."'");
					$rowconductor=mysqli_fetch_array($resultconductor);
					?>
					<tr>
						<td>
							<?php echo $rowconductor['name'];?>
						</td>
						<td>
							<?php echo $rowconductor['identification_type'].' '.$rowconductor['identification'];?>
						</td>
						<td>
							<?php echo $rowconductor['driving'];?>
						</td>
						<td>
							<?php echo $rowconductor['datedriving'];?>
						</td>
					</tr>
					<?php
				}
				?>
			</table>
		</div>
	</div>
</div>
								