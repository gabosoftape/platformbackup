<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once '../config/conexion.php';
$resultempresa = $mysqli->query("SELECT * FROM empresas WHERE id = '".$_REQUEST['userid']."' ");
$rowempresa=mysqli_fetch_array($resultempresa);


$resulttipodocumento = $mysqli->query("SELECT tipodocumento FROM tipodocumento WHERE id = ".$rowempresa['tipodocumento']." ");
$rowtipodocumento = mysqli_fetch_array($resulttipodocumento);
$resultfuec = $mysqli->query("SELECT * FROM fuec WHERE id = '".$_GET['idfuec']."'");
$rowfuec=mysqli_fetch_array($resultfuec);
$resultresponsable = $mysqli->query("SELECT * FROM responsable WHERE nit = '".$rowfuec['responsableid']."' ");
$rowresponsable =mysqli_fetch_array($resultresponsable);
$resultcontratista = $mysqli->query("SELECT * FROM contratista WHERE nit = '".$rowfuec['contratistaid']."' AND userid = '".$_REQUEST['userid']."' ");
$rowcontratista =mysqli_fetch_array($resultcontratista);
$contratistajoin = $mysqli->query("SELECT * FROM fuec INNER JOIN contratista on fuec.contratistaid=contratista.nit WHERE fuec.id = '".$_GET['idfuec']."' AND  fuec.userid = '".$_REQUEST['userid']."'");
$rownombrescontratista =mysqli_fetch_array($contratistajoin);
$chckd1='';
$chckd2='';
$chckd3='';
if($rowfuec['type_cvn'] == 1){
	$chckd1='X';
}
elseif($rowfuec['type_cvn'] == 2){
	$chckd2='X';
}
elseif($rowfuec['type_cvn'] == 3){
	$chckd3='X';
}

$tabla='';
$tabla = '
	<td colspan="1" style="text-align:center;">
		'.strtoupper($rowfuec['placa']).'
	</td>
	<td colspan="1" style="text-align:center;">
		'.strtoupper($rowfuec['modelo']).'
	</td>
	<td colspan="1" style="text-align:center;">
		'.strtoupper($rowfuec['marca']).'
	</td>
	<td colspan="1" style="text-align:center;">
		'.strtoupper($rowfuec['linea']).'
	</td>
	<td colspan="1" style="text-align:center;">
		'.strtoupper($rowfuec['numero_interno']).'
	</td>
	<td colspan="1" style="text-align:center;">
		'.strtoupper($rowfuec['numero_operacion']).' 
	</td>
';

$tabla1='';
$conductores = explode(',',$rowfuec['conductor']);
$i = 0;
$cantidad = count($conductores);
$tr='';
for($i=0; $i<$cantidad; $i++){
		$tabla1 = $tabla1.'<tr><td colspan="3" style="text-align:center;">'.$conductores[$i].'</td>';
		$i++;
		$tabla1 = $tabla1.'<td colspan="1" style="text-align:center;">'.$conductores[$i].'</td>';
		$i++;
		$tabla1 = $tabla1.'<td colspan="1" style="text-align:center;">'.$conductores[$i].'</td>';
		$i= $i+1;
		$tabla1 = $tabla1.'<td colspan="1" style="text-align:center;">'.$conductores[$i].'</td></tr>';
		var_dump();
		$i= $i+1; 
}

$objeto='';
if($rowfuec['objet_contract'] == 1){
	$objeto='Prestación de servicio de transporte de pasajeros y equipaje al grupo de usuarios y/o particulares';
}else{
	$objeto='Prestación de servicio de transporte de pasajeros y equipaje al grupo de empleados, funcionarios o contratistas de una empresa';
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
$filename = $PNG_TEMP_DIR.md5($_GET['id'].'|'.$errorCorrectionLevel.'|').'.png';
QRcode::png('http://http://96.126.106.39/mpdf/fuec.php?userid='.$_GET['id'].'&idfuec='.$rowfuec['id'].'', $filename, $errorCorrectionLevel, $matrixPointSize, 2);
$codigoqr = '<img src="'.$PNG_WEB_DIR.basename($filename).'" />'; 

$territorialdode = '';
$consecutivofuec = substr($rowempresa['territorial_code'],0,3);
$contador=0;

if(strlen($consecutivofuec.$rowempresa['resolution_code']) > 7){ 
	$consecutivofuec = $consecutivofuec.substr($rowempresa['resolution_code'],0,4);
}
else{
	while(strlen($consecutivofuec.$rowempresa['resolution_code']) < 7){ 
		$consecutivofuec = $consecutivofuec.'0';
	}
	$consecutivofuec = $consecutivofuec.$rowempresa['resolution_code'];
}
$consecutivofuec = $consecutivofuec.substr($rowempresa['date_enabled'],2,2).date('Y');

if(strlen($consecutivofuec.$rowfuec['contratoid']) > 17){ 
	$consecutivofuec = $consecutivofuec.substr($rowfuec['contratoid'],0,4);
}
else{
	while(strlen($consecutivofuec.$rowfuec['contratoid']) < 17){ 
		$consecutivofuec = $consecutivofuec.'0';
	}
	$consecutivofuec = $consecutivofuec.$rowfuec['contratoid'];
}
if(strlen($consecutivofuec.$rowfuec['id']) > 21){ 
	$consecutivofuec = $consecutivofuec.substr($rowfuec['id'],0,4);
}
else{
	while(strlen($consecutivofuec.$rowfuec['id']) < 21){ 
		$consecutivofuec = $consecutivofuec.'0';
	}
	$consecutivofuec = $consecutivofuec.$rowfuec['id'];
}

$html='
	<!doctype html>
	<html lang="es">
		<head>
			<meta charset="utf-8">
			<link rel="stylesheet" href="../css/csspersonalizado.css"/>
			<title>FUEC</title>
		</head>
		<style>
			table{
				font-size:14px;
				border-collapse: collapse !important;
				border-bottom:0.01em solid #000;
			}
			td{ 
				border-collapse: collapse!important;
				background-color:#FFF;
				border-top:0.01em solid #000;
				border-left:0.01em solid #000;
				border-right:0.01em solid #000;
				padding:5px;
			}
			tr{
				background-color:#FFF;
				border-collapse: collapse!important;
			}
		</style>
		<body>
			<table style="width:100%;">
				<tr>
					<td colspan="3">
						<img src="https://50.116.2.74/fuec/images/mintransporte.png" alt=""/>
					</td>
					<td colspan="3" style="text-align:center;">
						<img src="../images/logos/'.($rowempresa['logo']).'" alt="" style="width:100%; max-width: 300px; max-height: 100px;"/>
					</td>
				</tr>
				<tr>
					<td colspan="6" style="text-align:center;">
						<br />
						<b>FORMATO ÚNICO DE EXTRACTO DEL CONTRATO DEL SERVICIO <br />PÚBLICO DE TRANSPORTE TERRESTRE AUTOMOTOR ESPECIAL</b> 
						<br />
						<b style="color:red;">'.$consecutivofuec.'</b> 
						<p>&nbsp;</p>
					</td>
				</tr>
				<tr>
					<td colspan="4">
						<b>RAZÓN SOCIAL </b> 
						'.strtoupper($rowempresa['razonsocial']).'
					</td>
					<td colspan="2">
						<b>'.strtoupper($rowtipodocumento['tipodocumento']).'</b> 
						'.strtoupper($rowempresa['documento']).'
					</td>
				</tr>
				<tr>
					<td colspan="6">
						<b>CONTRATO No. </b> 
						'.$rowfuec['contratoid'].'
					</td>
				</tr>
				<tr>
					<td colspan="4">
						<b>CONTRATANTE </b>
						'.strtoupper($rownombrescontratista['nombres']).'
					</td>
					<td colspan="2">
						<b>NIT</b> 
						'.strtoupper($rowfuec['contratistaid']).'
					</td>
				</tr>
				<tr>
					<td colspan="6">
						<b>OBJETO DEL CONTRATO </b> <br />
						'.ucfirst($objeto).'
					</td>
				</tr>
				<tr>
					<td colspan="4">
						<b>RESPONSABLE </b>
						'.strtoupper($rowresponsable['nombres']).'
					</td>
					<td colspan="2">
						<b>'.strtoupper($rowresponsable['empresa']).'</b> 
						'.strtoupper($rowresponsable['nit']).'
					</td>
				</tr>
				<tr>
					<td colspan="6">
						<b>ORIGEN-DESTINO </b>
						'.ucwords($rowfuec['route']).'
					</td>
				</tr>
				<tr>
					<td colspan="6">
						<b>DESCRIPCION DEL RECORRIDO </b>
						'.ucfirst($rowfuec['route_desc']).'
					</td>
				</tr>
				<tr>
					<td colspan="1">
						Convenio <b>'.$chckd1.'</b>
					</td>
					<td colspan="1">
						Consorcio <b>'.$chckd2.'</b>
					</td>
					<td colspan="1">
						Unión temporal <b>'.$chckd3.'</b>
					</td>
					<td colspan="3">
						Con: <b>'.$rowfuec['utcon'].'</b>
					</td>
				</tr>
				<tr>
					<td colspan="6" style="text-align:center;">
						<b>VIGENCIA DEL CONTRATO</b>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<label for="type_cvn1"><b>FECHA INICIAL</b></label> '.substr($rowfuec['start'],0,10).'
					</td>

					<td colspan="3">
						<label for="type_cvn1"><b>FECHA VENCIMIENTO</b></label> '.substr($rowfuec['end'],0,10).'
					</td>
				</tr>
				<tr>
					<td colspan="6" style="text-align:center;">
						<b>CARACTERÍSTICAS DEL VEHÍCULO </b>
					</td>
				</tr>
				<tr>
					<td colspan="1" style="text-align:center;">
						<b>PLACA</b>
					</td>
					<td colspan="1" style="text-align:center;">
						<b>MODELO</b>
					</td>
					<td colspan="1" style="text-align:center;">
						<b>MARCA</b>
					</td>
					<td colspan="1" style="text-align:center;">
						<b>CLASE</b>
					</td>
					<td colspan="1" style="text-align:center;">
						<b>NÚMERO INTERNO</b>
					</td>
					<td colspan="1" style="text-align:center;">
						<b>NÚMERO DE OPERACIÓN</b>
					</td>
				</tr>
				<tr>
					'.$tabla.'
				</tr>
				<tr>
					<td colspan="6" style="text-align:center;">
						<b>CONDUCTORES</b>
					</td>
				</tr>
				<tr>
					<td colspan="3" style="text-align:center;">
						<b>NOMBRES Y APELLIDOS</b>
					</td>
					<td colspan="1" style="text-align:center;">
						<b>No. CÉDULA</b>
					</td>
					<td colspan="1" style="text-align:center;">
						<b>No. LICENCIA CONDUCCION</b>
					</td>
					<td colspan="1" style="text-align:center;">
						<b>VIGENCIA</b>
					</td>
				</tr>
				<tr>
					'.$tabla1.'
				</tr>
				<tr>
					<td colspan="2" style="text-align:center;">
						'.$codigoqr.'
					</td>
					<td colspan="2" style="text-align:center;">
						'.ucwords($rowresponsable['direccion']).'<br />
						'.$rowresponsable['telfijo'].'<br />
						'.$rowresponsable['celular'].'<br />
						'.strtolower($rowresponsable['correo']).'<br />
					</td>
					<td colspan="2" style="text-align:center;">
						<img src="../images/firmas/'.($rowfuec['firma']).'" style="width:100%; max-width: 200px; max-height: 200px;"/> 
					</td>
				</tr> 
			</table>
		</body>
	</html>
';
$html1='
	<!doctype html>
	<html lang="en">
		<head>
			<meta charset="utf-8">
			<link rel="stylesheet" href="../css/csspersonalizado.css"/>
			<title>FUEC</title>
		</head>
		<style>
			table{
				border-collapse: collapse !important;
				border-bottom:0.01em solid #000;
			}
			td{ 
				padding:1px;
				border-collapse: collapse!important;
				background-color:#FFF;
				border-top:0.01em solid #000;
				border-left:0.01em solid #000;
				border-right:0.01em solid #000;
			}
			/* Define the default color for all the table rows */
			tr{
				background: #FFF !important;
				background-color:#FFF;
				border-collapse: collapse!important;
			}	
			.header{
				position:fixed;
			}
			.tdCenter{
				text-align:center;
			}
			ul, li{
				list-style-type: none;
				text-align:justify;	
			}
			.pagenum:before { content: counter(page); }
		</style>
		<body>
			<br />
			<div style="padding:2%; font-size:14px; border-top:0.02em solid #000; border-left:0.01em solid #000; border-right:0.01em solid #000; border-bottom:0.01em solid #000;">
				<div style="text-align:center;">
					<h4><b>INSTRUCTIVO PARA LA DETERMINACION DEL NUMERO CONSECUTIVO DEL FUEC</b></h4>
					<ul>
						
					</ul>
				</div>
				<ul style="margin-left:-100px !important;">
					<li>
						El Formato Unico de Extracto del Contrato "FUEC" estará constituido por los siguientes números:<br />
					</li>
					<li>
						<br />
						a) Los tres primeros dígitos de izquierda a derecha correcponderán al código de la Dirección Territorial que otorgó la habilitación o de aquella a la cual se hubiese trasladado la Empresa	de Servicio público de Transporte Terrestre Automotor Especial;
						<br /><br />
						<table style="width:100%">
							<tr>
								<td>
									Antioquia-Choco
								</td>
								<td class="tdCenter">
									305
								</td>
								<td>
									Huila-Caquetá
								</td>
								<td class="tdCenter">
									441
								</td>
							</tr>
							<tr>
								<td>
									Atlántico
								</td>
								<td class="tdCenter">
									208
								</td>
								<td>
									Magdalena
								</td>
								<td class="tdCenter">
									247
								</td>
							</tr>
							<tr>
								<td>
									Bolívar-San Andrés y Providencia
								</td>
								<td class="tdCenter">
									213
								</td>
								<td>
									Meta-Vaupés-Vichada
								</td>
								<td class="tdCenter">
									550
								</td>
							</tr>
							<tr>
								<td>
									Boyacá-Casanare
								</td>
								<td class="tdCenter">
									415
								</td>
								<td>
									Nariño-Putumayo
								</td>
								<td class="tdCenter">
									352
								</td>
							</tr>
							<tr>
								<td>
									Caldas
								</td>
								<td class="tdCenter">
									317
								</td>
								<td>
									N/Santander-Arauca
								</td>
								<td class="tdCenter">
									454
								</td>
							</tr>
							<tr>
								<td>
									Cauca
								</td>
								<td class="tdCenter">
									319
								</td>
								<td>
									Quindio
								</td>
								<td class="tdCenter">
									363
								</td>
							</tr>
							<tr>
								<td>
									César
								</td>
								<td class="tdCenter">
									220
								</td>
								<td>
									Risaralda
								</td>
								<td class="tdCenter">
									366
								</td>
							</tr>
							<tr>
								<td>
									Córdoba-Sucre
								</td>
								<td class="tdCenter">
									223
								</td>
								<td>
									Santander
								</td>
								<td class="tdCenter">
									468
								</td>
							</tr>
							<tr>
								<td>
									Cundinamarca
								</td>
								<td class="tdCenter">
									425
								</td>
								<td>
									Tolima
								</td>
								<td class="tdCenter">
									473
								</td>
							</tr>
							<tr>
								<td>
									Guajira
								</td>
								<td class="tdCenter">
									241
								</td>
								<td>
									 Valle del Cauca
								</td>
								<td class="tdCenter">
									376
								</td>
							</tr>
						</table>
						<br /><br />
					</li>
					<li>
						b) Los cuatro dígitos siguientes señalarán el número de resolución mediante la cual se otorgó la habilitación de la Empresa. En caso que la resolución no tenga estos dígitos, los faltantes serán completados con ceros a la izquierda;<br /><br />
					</li>
					<li>
						c) Los dos siguientes dígitos, corresponderán a los dos últimos del año en que la empresa fue habilitada;<br /><br />
					</li>
					<li>
						d) Acontinuación, cuatro dígitos que corresponderán al año en el que se expide el extracto del contrato;<br /><br />
					</li>
					<li>
						e) Posteriormente, cuatro dígitos que identifican el número del contrato. La numeración debe ser consecutiva, establecida por cada empresa y continuará con la numeración dada a los contratos de prestación del servicios celebrados para el transporte de estudiantes, empleados, turistas, usuarios del servicio de salud, grupos específicos de usuarios, en vigencia de la resolución 3068 de 2014.<br /><br />
					</li>
					<li>
						f) Finalmente, los cuatro últimos dígitos corresponderán al número consecutivo del extracto de contrato que se expida para la ejecución de cada contrato. Se debe expedir un nuevo extracto por vencimiento del plazo inicial del mismo o por cambio del vehículo.<br /><br />
					</li>
					<li>
						<b>EJEMPLO:</b><br />
						<br />
						Empresa habilitada por la Dirección Territorial Cundinamarca en el año 2012 con resolución de habilitación No. 0155, que expide el primer extracto del contrato en el año 2015, del contrato 255. El número del Formato Unico de Extracto del Contrato "FUEC" será : 425015512201502550001.
						<br />
					</li>
				</ul>
			</div>
	</body>
</html>		
';
$path = (getenv('MPDF_ROOT')) ? getenv('MPDF_ROOT') : __DIR__;
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
		'margin_header' => 6,
		'margin_footer' => 6,
		'orientation' => 'P'
	)
);
$mpdf->WriteHTML($html);
$mpdf->AddPage();
$mpdf->WriteHTML($html1);
$mpdf->Output();