<?php
require_once '../config/conexion.php';
$_POST['id'] = $_GET['id'];
$_POST['idfuec'] = $_GET['idfuec'];
$resultcompany = $mysqli->query("SELECT id, name, identification, identification_type, territorial_code FROM bs_account WHERE wialon_id = '".base64_decode($_POST['id'])."' ");
$rowcompany=mysqli_fetch_array($resultcompany);

$resultcontrato = $mysqli->query("SELECT contract, bs_unit_id, object_contract, route, route_desc, start, end, type_cvn, drivers, bs_responsible_id, consecutive_fuec FROM fuec_doc WHERE id = ".$_POST['idfuec']." ");
$rowcontrato=mysqli_fetch_array($resultcontrato);

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
$resultresponsable = $mysqli->query("SELECT name, identification, identification_type FROM bs_account WHERE id = ".$rowcontrato['bs_responsible_id']." ");
$rowresponsable=mysqli_fetch_array($resultresponsable);
$resultresponsable = $mysqli->query("SELECT name, identification, identification_type FROM bs_account WHERE id = ".$rowcontrato['bs_responsible_id']." ");
$rowresponsable=mysqli_fetch_array($resultresponsable);

$tabla='';
$vehiculos = explode(',',$rowcontrato['bs_unit_id']);
foreach($vehiculos AS $vehiculo){
	$resultvehiculo = $mysqli->query("SELECT name, line, brand, model, internal_number, operation_number, operation_number, type FROM bs_account_unit WHERE id = '".$vehiculo."'");
	$rowvehiculo=mysqli_fetch_array($resultvehiculo);
	$tabla = $tabla.'
	<tr>
		<td>
			'.$rowvehiculo['name'].'
		</td>
		<td>
			'.$rowvehiculo['model'].'
		</td>
		<td>
			'.$rowvehiculo['brand'].'
		</td>
		<td>
			'.$rowvehiculo['line'].'
		</td>
		<td>
			'.$rowvehiculo['internal_number'].'
		</td>
		<td>
			'.$rowvehiculo['operation_number'].'
		</td>
	</tr>';
}
$tabla1='';
$conductores = explode(',',$rowcontrato['drivers']);
foreach($conductores AS $conductor){
	$resultconductor = $mysqli->query("SELECT id, name, identification, identification_type, status, driving, datedriving FROM bs_account WHERE id = '".$conductor."'");
	$rowconductor=mysqli_fetch_array($resultconductor);
	$tabla1 = $tabla1.'
	<tr>
		<td>
			'.$rowconductor['name'].'
		</td>
		<td>
			'.$rowconductor['identification_type'].' '.$rowconductor['identification'].'
		</td>
		<td>
			'.$rowconductor['driving'].'
		</td>
		<td>
			'.$rowconductor['datedriving'].'
		</td>
	</tr>
	';
}

$html='
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style>
		@page {
			margin-top: 5em;
			margin-right: 5em;
			margin-bottom: 5em;
			margin-left: 5em;
		}
		table{
			font-size:12px;
		}
		td{ 
			
		}
		tr{
			
		}	
		.header{
			position:fixed;
		}
		.marginTop3{
			margin-top:3% !important;
		}
		.marginTop1{
			margin-top:1% !important;
		}
		.width100{width:100% !important;}
		.width75{width:75%;}
		.width50{width:50%;}
		.width25{width:25%;}
		.textCenter{text-align:center;}
		.backgroundf8{background-color:whitesmoke;}
		.pagenum:before { content: counter(page); }
	</style>
	
	<div class="width100 header">
		<div class="width100" style="float: right !important; font-size:8px !important;">Pag. <span class="pagenum"></span></div>
			<table class="width100">
				<tr class="width100">
					<td class="width50 textCenter">
						<img src="../../images/mintransporte.png" alt="" style="width: 3000%;"/>
					</td>
					<td class="width50 textCenter">
						<img src="../../images/logos/'.base64_decode($_POST['id']).'.png" alt="" style="width: 3000%;"/>
					</td>
				</tr>
			</table>
			<table class="width100 marginTop1">
				<tr class="width100">
					<td class="width100 textCenter">
						<b>FORMATO ÚNICO DE EXTRACTO DEL CONTRATO DEL SERVICIO <br />PÚBLICO DE TRANSPORTE TERRESTRE AUTOMOTOR ESPECIAL</b> 
					</td>
				</tr>
			</table>
			<table class="width100 marginTop1">
				<tr class="width100">
					<td class="width100 textCenter">
						<b style="color:red;">'.strtoupper($rowcontrato['consecutive_fuec']).'</b> 
					</td>
				</tr>
			</table>
			
			
			
			
			<table class="width100 marginTop3 textCenter">
				<tr class="width100">
					<td class="width75">
						<b>RAZÓN SOCIAL </b> 
						'.strtoupper($rowcompany['name']).'
					</td>
					<td class="width50">
						<b>'.strtoupper($rowcompany['identification_type']).'</b> 
						'.strtoupper($rowcompany['identification']).'
					</td>
				</tr>
			</table>
			
			
			
			<table class="width100 marginTop1">
				<tr class="width100">
					<td class="width100">
						<b>CONTRATO No. </b> 
						'.$rowcontrato['contract'].'
					</td>
				</tr>
			</table>
			<table class="width100">
				<tr class="width100">
					<td class="width50">
						<b>OBJETO DEL CONTRATO </b>
					</td>
					<td class="width75">
						'.ucfirst($rowcontrato['object_contract']).'
					</td>
				</tr>
			</table>
			<table class="width100 marginTop1">
				<tr class="width100">
					<td class="width50">
						<b>CONTRATISTA </b>
					</td>
					<td class="width75">
						'.strtoupper($rowresponsable['name']).'
					</td>
				</tr>
			</table>
			<table class="width100">
				<tr class="width100">
					<td class="width50">
						<b>RESPONSABLE </b>
					</td>
					<td class="width75" id="responsable">
						'.strtoupper($rowresponsable['name']).'
					</td>
				</tr>
			</table>
			
			<table class="width100">
				<tr class="width100">
					<td class="width50 textCenter">
						<b>CONVENIOS </b>
					</td>	
					<td class="width50 textCenter">
						<b>VIGENCIA DEL CONTRATO </b>
					</td>
				</tr>
				<tr class="width100">
					<td class="width50">
						<table class="width100">
							<tr class="width100">
								<td class="width25 textCenter">
									<label for="type_cvn1">Convenio</label> <br /><input type="radio" name="type_cvn" id="type_cvn1" disabled '.$chckd1.' />
								</td>
								<td class="width25 textCenter">
									<label for="type_cvn2">Consorcio</label> <br /><input type="radio" name="type_cvn" id="type_cvn2" disabled '.$chckd2.' />
								</td>
								<td class="width25 textCenter">
									<label for="type_cvn3">Unión temporal</label> <br /><input type="radio" name="type_cvn" id="type_cvn3" disabled '.$chckd3.' />
								</td>
							</tr>
						</table>
					</td>
					
					
					<td class="width50">
						<table class="width100">
							<tr class="width100">
								<td class="width50 textCenter">
									<label for="type_cvn1"><b>FECHA INICIAL</b></label> <br />'.substr($rowcontrato['start'],0,10).'
								</td>
								<td class="width50 textCenter">
									<label for="type_cvn1"><b>FECHA VENCIMIENTO</b></label> <br />'.substr($rowcontrato['end'],0,10).'
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
					
					<table class="width100">
						<tr class="width100">
							<td class="width50">
								<b>ORIGEN-DESTINO, DESCRIBIENDO EL RECORRIDO </b>
							</td>
							<td class="width75">
								'.ucwords($rowcontrato['route']).'
							</td>
						</tr>
					</table>
					<table class="width100">
						<tr class="width100">
							<td class="width50">
								<b>DESCRIPCION DEL RECORRIDO </b>
							</td>
							<td class="width75">
								'.ucfirst($rowcontrato['route']).'
							</td>
						</tr>
					</table>
					
					
					<table class="width100">
						<tr class="width100">
							<td class="width100">
								<b>CARACTERÍSTICAS DEL VEHÍCULO </b>
							</td>
						</tr>
					</table>
					<table class="width100">
						<tr class="width100">
							<td class="table-responsive">
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
									'.$tabla.'
								</table>
							</td>
						</tr>
					</table>
					<table class="width100">
						<tr class="width100">
							<td class="width100">
								<b>CONDUCTORES</b>
							</td>
						</tr>
					</table>
					<table class="width100">
						<tr class="width100">
							<td class="table-responsive">
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
									'.$tabla1.'
								</table>
							</td>
						</tr>
					</table>
			
			
			
			
	</div>
';


$path = (getenv('MPDF_ROOT')) ? getenv('MPDF_ROOT') : __DIR__;
require_once '../vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf(['mode' => 'c']);

$mpdf->WriteHTML($html);
$mpdf->Output();
