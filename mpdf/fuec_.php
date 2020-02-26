<?php
$mysqli = new mysqli('localhost', 'root', 'Gpscontrol**3160', 'gpscontrol_ws');
mysqli_set_charset($mysqli,'utf8');
if ($mysqli->connect_errno) {
	echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

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
	$chckd1='X';
}
elseif($rowcontrato['type_cvn'] == 2){
	$chckd2='X';
}
elseif($rowcontrato['type_cvn'] == 3){
	$chckd3='X';
}
$resultresponsable = $mysqli->query("SELECT name, identification, identification_type FROM bs_account WHERE id = ".$rowcontrato['bs_responsible_id']." ");
$rowresponsable=mysqli_fetch_array($resultresponsable);


$resultresponsableaddress = $mysqli->query("SELECT address FROM bs_address WHERE parent_id = ".$rowcontrato['bs_responsible_id']." ");
$rowresponsableaddress=mysqli_fetch_array($resultresponsableaddress);

$resultresponsablephone = $mysqli->query("SELECT phone FROM bs_phone WHERE parent_id = ".$rowcontrato['bs_responsible_id']." ");
$rowresponsablephone=mysqli_fetch_array($resultresponsablephone);

$resultresponsableemail = $mysqli->query("SELECT email FROM bs_email WHERE parent_id = ".$rowcontrato['bs_responsible_id']." ");
$rowresponsableemail=mysqli_fetch_array($resultresponsableemail);


$tabla='';
$vehiculos = explode(',',$rowcontrato['bs_unit_id']);
foreach($vehiculos AS $vehiculo){
	$resultvehiculo = $mysqli->query("SELECT name, line, brand, model, internal_number, operation_number, operation_number, type FROM bs_account_unit WHERE id = '".$vehiculo."'");
	$rowvehiculo=mysqli_fetch_array($resultvehiculo);
	$tabla = $tabla.'
	<tr class="width100">
		<td class="textCenter bordes">
			'.$rowvehiculo['name'].'
		</td>
		<td class="textCenter bordes">
			'.$rowvehiculo['model'].'
		</td>
		<td class="textCenter bordes">
			'.$rowvehiculo['brand'].'
		</td>
		<td class="textCenter bordes">
			'.$rowvehiculo['line'].'
		</td>
		<td class="textCenter bordes">
			'.$rowvehiculo['internal_number'].'
		</td>
		<td class="textCenter bordes">
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
	<tr class="width100">
		<td class="textCenter bordes">
			'.$rowconductor['name'].'
		</td>
		<td class="textCenter bordes">
			'.$rowconductor['identification_type'].' '.$rowconductor['identification'].'
		</td>
		<td class="textCenter bordes">
			'.$rowconductor['driving'].'
		</td>
		<td class="textCenter bordes">
			'.$rowconductor['datedriving'].'
		</td>
	</tr>
	';
}
$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
$PNG_WEB_DIR = 'temp/';
include "phpqrcode/qrlib.php";
if (!file_exists($PNG_TEMP_DIR)){
	mkdir($PNG_TEMP_DIR);
}
$filename = $PNG_TEMP_DIR.'.png';
$matrixPointSize = 5;
$errorCorrectionLevel = 'L';
$filename = $PNG_TEMP_DIR.md5($_POST['id'].'|'.$errorCorrectionLevel.'|').'.png';
QRcode::png('http://96.126.106.39/fuec/mpdf/fuec.php?id='.$_POST['id'].'&idfuec='.$_POST['idfuec'].'', $filename, $errorCorrectionLevel, $matrixPointSize, 2);
$codigoqr = '<img src="'.$filename.'" />'; 


$html='
	<!doctype html>
	<html lang="en">
		<head>
			<meta charset="utf-8">
			<link rel="apple-touch-icon" href="http://96.126.106.39/fuec/images/favicon.ico">
			<link rel="stylesheet" href="../css/csspersonalizado.css"/>
			<title>FUEC</title>
		</head>
		<style>
			table{
				
			}
			td{ 
				padding:1px;
				
			}
			/* Define the default color for all the table rows */
			tr{
				background: #FFF !important;
			}	
			.header{
				position:fixed;
			}
			.bordes{
				border-collapse: separate !important; 
				border-spacing:1px !important;
				font-size:13px;
				border-top:0.01em solid #CCC;
				border-left:0.01em solid #CCC;
				border-bottom:0.01em solid #CCC;
				border-right:0.01em solid #CCC;
				margin-top:5px;
			}
			.pagenum:before { content: counter(page); }
		</style>
		<body>
			<table class="width100">
				<tr class="width100">
					<td class="width50 textCenter">
						<img src="../../images/mintransporte.png" alt=""/>
					</td>
                    <td class="width50 textCenter">
                    <!-- conecta la imagen desde la base de datos -->
						<img src="http://96.126.106.39/fuec/images/logos/<?php echo $rowaccount['logo'];?>" alt="" style="width: 3000%;"/>
					</td>
				</tr>
			</table>
			<table class="width100 marginTop3 bordes">
				<tr class="width100">
					<td class="width100 textCenter">
						<b>FORMATO ÚNICO DE EXTRACTO DEL CONTRATO DEL SERVICIO <br />PÚBLICO DE TRANSPORTE TERRESTRE AUTOMOTOR ESPECIAL</b> 
					</td>
				</tr>
				<tr class="width100">
					<td class="width100 textCenter">
						<b style="color:red;">'.strtoupper($rowcontrato['consecutive_fuec']).'</b> 
					</td>
				</tr>
			</table>
			<table class="width100 marginTop3 bordes">
				<tr class="width100">
					<td class="width100">
						<b>RAZÓN SOCIAL </b> 
						'.strtoupper($rowcompany['name']).'
						<b>'.strtoupper($rowcompany['identification_type']).'</b> 
						'.strtoupper($rowcompany['identification']).'
					</td>
				</tr>
				<tr class="width100">
					<td class="width50">
						<b>CONTRATO No. </b> 
						'.$rowcontrato['contract'].'
					</td>
				</tr>
				<tr class="width100">
					<td class="width100">
						<b>OBJETO DEL CONTRATO </b>
						'.ucfirst($rowcontrato['object_contract']).'
					</td>
				</tr>
				<tr class="width100">
					<td class="width100">
						<b>CONTRATISTA </b>
						'.strtoupper($rowresponsable['name']).'
					</td>
				</tr>
				<tr class="width100">
					<td class="width100">
						<b>RESPONSABLE </b>
						'.strtoupper($rowresponsable['name']).'
					</td>
				</tr>
			</table>

			<table class="width100 marginTop3 bordes">
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
								<td class="width25 textCenter bordes">
									Convenio
								</td>
								<td class="width25 textCenter bordes">
									Consorcio
								</td>
								<td class="width25 textCenter bordes">
									Unión temporal
								</td>
							</tr>	
							<tr class="width100">	
								<td class="width25 textCenter bordes">
									'.$chckd1.'
								</td>
								<td class="width25 textCenter bordes">
									 '.$chckd2.'
								</td>
								<td class="width25 textCenter bordes">
									'.$chckd3.'
								</td>
							</tr>
						</table>
					</td>
					
					
					<td class="width50">
						<table class="width100">
							<tr class="width100">
								<td class="width50 textCenter bordes">
									<label for="type_cvn1"><b>FECHA INICIAL</b></label> <br />'.substr($rowcontrato['start'],0,10).'
								</td>
								<td class="width50 textCenter bordes">
									<label for="type_cvn1"><b>FECHA VENCIMIENTO</b></label> <br />'.substr($rowcontrato['end'],0,10).'
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
					
			<table class="width100 marginTop3 bordes">
				<tr class="width100">
					<td class="width100">
						<b>ORIGEN-DESTINO </b>
						'.ucwords($rowcontrato['route']).'
					</td>
				</tr>
				<tr class="width100">
					<td class="width100">
						<b>DESCRIPCION DEL RECORRIDO </b>
						'.ucfirst($rowcontrato['route']).'
					</td>
				</tr>
			</table>
					
					
			<table class="width100 marginTop3">
				<tr class="width100">
					<td class="width100">
						<b>CARACTERÍSTICAS DEL VEHÍCULO </b>
					</td>
				</tr>
			</table>
			<table class="width100 marginTop1 bordes">
				<tr class="width100">
					<td class="table-responsive width100">
						<table class="table table-striped table-bordered text-center width100">
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
			<table class="width100 marginTop3">
				<tr class="width100">
					<td class="width100">
						<b>CONDUCTORES</b>
					</td>
				</tr>
			</table>
			<table class="width100 marginTop1 bordes">
				<tr class="width100">
					<td class="table-responsive width100">
						<table class="table table-striped table-bordered text-center width100">
							<tr class="width100">
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
			<table class="width100 marginTop1 textCenter">
				<tr class="width100 textCenter">
					<td class="table-responsive width25 textCenter">
						'.$codigoqr.'
					</td>
					<td class="table-responsive width25">
						'.ucwords($rowresponsableaddress['address']).'<br />
						'.$rowresponsablephone['phone'].'<br />
						'.strtolower($rowresponsableemail['email']).'<br />
					</td>
					<td class="table-responsive width50 textCenter">
						<img src="../images/firmas/<?php echo $rowaccount['firma'];?>"/>
					</td>
				</tr>
			</table>
		</body>
	</html>
';
$path = 'temp/';
require_once '../vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf(
	array(
		'mode' => '',
		'format' => 'A4',
		'default_font_size' => 0,
		'default_font' => '',
		'margin_left' => 15,
		'margin_right' => 15,
		'margin_top' => 20,
		'margin_bottom' => 16,
		'margin_header' => 9,
		'margin_footer' => 9,
		'orientation' => 'P'
	)
);

$mpdf->WriteHTML($html);
$mpdf->Output();
