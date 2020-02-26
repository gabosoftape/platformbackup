<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once 'vendor/autoload.php';
require_once 'config/conexion.php';
include 'config/odoo_server.php';
use Ang3\Component\Odoo\Client\ExternalApiClient;
$client = new ExternalApiClient($server['url'], $server['db'], $server['username'], $server['password']);
//get alistamientos
$idEnlist = $_GET['search'];
$client = new ExternalApiClient($server['url'], $server['db'], $server['username'], $server['password']);
$resultalistamientos = $client->searchAndRead("gpscontrol.alistamientos");
$resultempresa = $mysqli->query("SELECT * FROM alistamientos WHERE folio = '".$_REQUEST['search']."' ");
$rowempresa=mysqli_fetch_array($resultempresa);
$matrixPointSize = 5;
$errorCorrectionLevel = 'L';
$enlist;
foreach($resultalistamientos as $alist){
	if($idEnlist==$alist['folio']){
		$enlist = $alist;
	}
}

// Include the main TCPDF library (search for installation path).
require_once 'vendor/tecnickcom/tcpdf/tcpdf.php';

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = 'images/logo.png';
        $this->Image($image_file, 10, 10, 70, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->Cell(0, 15, 'Resumen de alistamiento', 0, false, 'C', 0, '', 0, false, 'C', 'C');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Enlist Control App');
$pdf->SetTitle($idEnlist);
$pdf->SetSubject('Descripcion Alistamiento');
$pdf->SetKeywords('Alistamiento, PDF, resumen');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', 'BI', 12);
// Print a table
$new_time = strtotime($enlist['fecha'] . "-5hours");
$estado_value;
if( $rowempresa['estado']=="incompleto"){
	$estado_value = "Con Novedades";
}else{
	$estado_value = "En orden";
}
// add a page
$pdf->AddPage();
$pdf->SetFillColor(255, 255, 254);
$pdf->MultiCell(55, 10, 'Alistamiento: '.$idEnlist.'', 0, 'J', 1, 0, '', '', true, 1, true, true, 40, 'T');
$pdf->MultiCell(55, 10, 'Conductor: '.$rowempresa['conductor'].'<br /> Vehiculo: '.$rowempresa['vehiculo'].'', 0, 'J', 1, 0, '', '', true, 0, true, true, 40, 'M');
$pdf->MultiCell(55, 10, 'Fecha: '.date("M , d, Y h:i:s A",$new_time).'<br /> Estado: '.$estado_value.'', 0, 'J', 1, 1, '', '', true, 0, true, true, 40, 'B');

$pdf->Ln(4);
$countNegative = 0;
$afirmative = '<td></td>
	<td>x</td>';
$negative = '<td>x</td>
	<td></td>';	
// create some HTML content
$html = '
<h1>Informacion Alistamiento</h1>
</hr>
<table cellpadding="1" cellspacing="1" border="1" style="text-align:center;">
<thead>
	<tr>
		<th>ITEM</th>
		<th class="text-center">CON NOVEDAD</th>
		<th class="text-center">EN ORDEN</th>
	</tr>
</thead>
<tr>
	<td>Documentos Conductor (Cédula, Licencia Conducción, Carné empresa)</td>
	';

if($enlist['documentos_conductor']==true){
	$html .= $afirmative;
}else{
	$html .= $negative;
	$countNegative++;
}

$html .='	
</tr>
<tr>
	<td>Documentos vehiculo (Licencia transito, tarjeta operación, SOAT, poliza RCC y RCE, Revisión tecnicomecánica anual y bimestral, extracto contrato)</td>
	';

if($enlist['documentos_vehiculo']==true){
	$html .= $afirmative;
}else{
	$html .= $negative;
	$countNegative++;
}

$html .='
</tr>
<tr>
	<td>Calcomania " Como conduzco"</td>
	';

if($enlist['calcomania']==true){
	$html .= $afirmative;
}else{
	$html .= $negative;
	$countNegative++;
}

$html .='
</tr>
<tr>
	<td>Pito</td>
	';

if($enlist['pito']==true){
	$html .= $afirmative;
}else{
	$html .= $negative;
	$countNegative++;
}

$html .='
</tr>
<tr>
	<td>Dispositivo de velocidad</td>
	';

if($enlist['disp_velocidad']==true){
	$html .= $afirmative;
}else{
	$html .= $negative;
	$countNegative++;
}

$html .='
</tr>
<tr>
	<td>Estado de escalera puerta de conductor</td>
	';

if($enlist['estado_esc_p_conductor']==true){
	$html .= $afirmative;
}else{
	$html .= $negative;
	$countNegative++;
}

$html .='
</tr>
<tr>
	<td>Estado escalera puerta de pasajero</td>
	';

if($enlist['estado_esc_p_pasajero']==true){
	$html .= $afirmative;
}else{
	$html .= $negative;
	$countNegative++;
}

$html .='
</tr>
<tr>
	<td>Equipo de Carretera (Gato, Llave de pernos, 2 señales carretera,   2 Tacos)</td>
	';

if($enlist['equipo_carretera']==true){
	$html .= $afirmative;
}else{
	$html .= $negative;
	$countNegative++;
}

$html .='
</tr>
<tr>
	<td>Herramientas en buen estado</td>
	';

if($enlist['herramientas']==true){
	$html .= $afirmative;
}else{
	$html .= $negative;
	$countNegative++;
}

$html .='
</tr>
<tr>
	<td>Linterna</td>
	';

if($enlist['linterna']==true){
	$html .= $afirmative;
}else{
	$html .= $negative;
	$countNegative++;
}

$html .='
</tr>
<tr>
	<td>Extintor (vigente, pasador, manometro, corrosión)</td>
	';

if($enlist['extintor']==true){
	$html .= $afirmative;
}else{
	$html .= $negative;
	$countNegative++;
}

$html .='
</tr>
<tr>
	<td>Botiquin</td>
	';

if($enlist['botiquin']==true){
	$html .= $afirmative;
}else{
	$html .= $negative;
	$countNegative++;
}

$html .='
</tr>
<tr>
	<td>Llanta de repuesto</td>
	';

if($enlist['repuesto']==true){
	$html .= $afirmative;
}else{
	$html .= $negative;
	$countNegative++;
}

$html .='
</tr>
<tr>
	<td>Espejos retrovisores (3)</td>
	';

if($enlist['retrovisores']==true){
	$html .= $afirmative;
}else{
	$html .= $negative;
	$countNegative++;
}

$html .='
</tr>
<tr>
	<td>Cinturon de seguridad conductor y pasajeros</td>
	';

if($enlist['cinturones']==true){
	$html .= $afirmative;
}else{
	$html .= $negative;
	$countNegative++;
}

$html .='
</tr>
<tr>
	<td>Motor : No existan fugas</td>
	';

if($enlist['motor']==true){
	$html .= $afirmative;
}else{
	$html .= $negative;
	$countNegative++;
}

$html .='
</tr>
<tr>
	<td>Estado de llantas (desgaste, presion de aire)Estado de llantas (desgaste, presion de aire)</td>
	';

if($enlist['llantas']==true){
	$html .= $afirmative;
}else{
	$html .= $negative;
	$countNegative++;
}

$html .='
</tr>
<tr>
	<td>Baterias: Niveles de Agua, Ajustes de Bornes, Sulfatacion</td>
	';

if($enlist['baterias']==true){
	$html .= $afirmative;
}else{
	$html .= $negative;
	$countNegative++;
}

$html .='
</tr>
<tr>
	<td>Revisar: Transmision, Direccion</td>
	';

if($enlist['transmision']==true){
	$html .= $afirmative;
}else{
	$html .= $negative;
	$countNegative++;
}

$html .='
</tr>
<tr>
	<td>Tension de Correas</td>
	';

if($enlist['tension']==true){
	$html .= $afirmative;
}else{
	$html .= $negative;
	$countNegative++;
}

$html .='
</tr>
<tr>
	<td>Tapas: de Radiador, de Combustible, de Hidraulico</td>
	';

if($enlist['tapas']==true){
	$html .= $afirmative;
}else{
	$html .= $negative;
	$countNegative++;
}

$html .='
</tr>
<tr>
	<td>Niveles de: Agua radiador, Aceite Hidraulico, Aceite de Motor </td>
	';

if($enlist['niveles']==true){
	$html .= $afirmative;
}else{
	$html .= $negative;
	$countNegative++;
}

$html .='
</tr>

<tr>
	<td>Revision de filtros</td>
	';

if($enlist['filtros']==true){
	$html .= $afirmative;
}else{
	$html .= $negative;
	$countNegative++;
}

$html .='
</tr>
<tr>
	<td>Estado limpiaprabrisas y nivel de agua</td>
	';

if($enlist['parabrisas']==true){
	$html .= $afirmative;
}else{
	$html .= $negative;
	$countNegative++;
}

$html .='
</tr>
<tr>
	<td>Sistema de Frenos</td>
	';

if($enlist['frenos']==true){
	$html .= $afirmative;
}else{
	$html .= $negative;
	$countNegative++;
}

$html .='
</tr>
<tr>
	<td>Freno emergencias</td>
	';

if($enlist['frenos_emergencia']==true){
	$html .= $afirmative;
}else{
	$html .= $negative;
	$countNegative++;
}

$html .='
</tr>
<tr>
	<td>Estado Aire Acondicionado</td>
	';

if($enlist['aire']==true){
	$html .= $afirmative;
}else{
	$html .= $negative;
	$countNegative++;
}

$html .='
</tr>
<tr>
	<td>Luces (altas, medias, bajas, direccionales, estacionarias y reversa)</td>
	';

if($enlist['luces']==true){
	$html .= $afirmative;
}else{
	$html .= $negative;
	$countNegative++;
}

$html .='
</tr>
<tr>
	<td>Estado silleteria</td>
	';

if($enlist['silleteria']==true){
	$html .= $afirmative;
}else{
	$html .= $negative;
	$countNegative++;
}

$html .='
</tr>
<tr>
	<td>Estado y alineación asiento conductor</td>
	';

if($enlist['silla_conductor']==true){
	$html .= $afirmative;
}else{
	$html .= $negative;
	$countNegative++;
}

$html .='
</tr>
<tr>
	<td>Aseo interno y externo</td>
	';

if($enlist['aseo']==true){
	$html .= $afirmative;
}else{
	$html .= $negative;
	$countNegative++;
}

$html .='
</tr>
<tr>
	<td>Avantel o Celular con Minutos</td>
	';

if($enlist['celular']==true){
	$html .= $afirmative;
}else{
	$html .= $negative;
	$countNegative++;
}

$html .='
</tr>
<tr>
	<td>Ruteros</td>
	';

if($enlist['ruteros']==true){
	$html .= $afirmative;
}else{
	$html .= $negative;
	$countNegative++;
}

$html .='
</tr>


</table>';

$html .= '</hr>';
if($countNegative == 0){
	$html .= '<h1>Sin Novedades.</h1>';
}else{
	$html .= '<h1>Detalle de novedades</h1>';
	$html .= '
	</hr>
	<table cellpadding="1" cellspacing="1" border="1" style="text-align:center;">
	<thead>
		<tr>
			<th>ITEM</th>
			<th class="text-center">DESCRIPCION</th>
			<th class="text-center">EVIDENCIA</th>
		</tr>
	</thead>
	';
	if($enlist['documentos_conductor']==false){
		$img_base64_encoded = $enlist['img_documentos_conductor'];
		$img = '<img width="200" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
		$html .= '
		<tr>
			<td> <br /><br /><h3>- Documentos del conductor </h3></td>
			<td ><br /><br /><br />'.$enlist['desc_documentos_conductor'].'</td>
			<td align="center" width="201">'.$img.'</td>
		</tr>
		';
	}
	if($enlist['documentos_vehiculo']==false){
		$img_base64_encoded = $enlist['img_documentos_vehiculo'];
		$img = '<img width="200" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
		$html .= '
		<tr>
			<td> <br /><br /><h3>- Documentos del Vehiculo</h3></td>
			<td ><br /><br /><br />'.$enlist['desc_documentos_vehiculo'].'</td>
			<td align="center" width="201">'.$img.'</td>
		</tr>
		';
	}
	if($enlist['calcomania']==false){
		$img_base64_encoded = $enlist['img_calcomania'];
		$img = '<img width="200" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
		$html .= '
		<tr>
			<td> <br /><br /><h3>- Calcomania "Como Conduzco"</h3></td>
			<td ><br /><br /><br />'.$enlist['desc_calcomania'].'</td>
			<td align="center" width="201">'.$img.'</td>
		</tr>
		';
	}
	if($enlist['pito']==false){
		$img_base64_encoded = $enlist['img_pito'];
		$img = '<img width="200" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
		$html .= '
		<tr>
			<td> <br /><br /><h3>- Pito</h3></td>
			<td ><br /><br /><br />'.$enlist['desc_pito'].'</td>
			<td align="center" width="201">'.$img.'</td>
		</tr>
		';
	}
	if($enlist['disp_velocidad']==false){
		$img_base64_encoded = $enlist['img_disp_velocidad'];
		$img = '<img width="200" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
		$html .= '
		<tr>
			<td> <br /><br /><h3>- Dispositivo de velocidad</h3></td>
			<td ><br /><br /><br />'.$enlist['desc_disp_velocidad'].'</td>
			<td align="center" width="201">'.$img.'</td>
		</tr>
		';
	}
	if($enlist['estado_esc_p_conductor']==false){
		$img_base64_encoded = $enlist['img_estado_esc_p_conductor'];
		$img = '<img width="200" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
		$html .= '
		<tr>
			<td> <br /><br /><h3>- Estado escalera de puerta conductor</h3></td>
			<td ><br /><br /><br />'.$enlist['desc_estado_esc_p_conductor'].'</td>
			<td align="center" width="201">'.$img.'</td>
		</tr>
		';
	}
	if($enlist['estado_esc_p_pasajero']==false){
		$img_base64_encoded = $enlist['img_estado_esc_p_pasajero'];
		$img = '<img width="200" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
		$html .= '
		<tr>
			<td> <br /><br /><h3>- Estado escalera de puerta de pasajeros</h3></td>
			<td ><br /><br /><br />'.$enlist['desc_estado_esc_p_pasajero'].'</td>
			<td align="center" width="201">'.$img.'</td>
		</tr>
		';
	}
	if($enlist['equipo_carretera']==false){
		$img_base64_encoded = $enlist['img_equipo_carretera'];
		$img = '<img width="200" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
		$html .= '
		<tr>
			<td> <br /><br /><h3>- Equipo de carretera</h3></td>
			<td ><br /><br /><br />'.$enlist['desc_equipo_carretera'].'</td>
			<td align="center" width="201">'.$img.'</td>
		</tr>
		';
	}
	if($enlist['herramientas']==false){
		$img_base64_encoded = $enlist['img_herramientas'];
		$img = '<img width="200" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
		$html .= '
		<tr>
			<td> <br /><br /><h3>- Herramientas</h3></td>
			<td ><br /><br /><br />'.$enlist['desc_herramientas'].'</td>
			<td align="center" width="201">'.$img.'</td>
		</tr>
		';
	}
	if($enlist['linterna']==false){
		$img_base64_encoded = $enlist['img_linterna'];
		$img = '<img width="200" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
		$html .= '
		<tr>
			<td><br /><br /><h3>- Linterna: </h3></td>
			<td ><br /><br /><br />'.$enlist['desc_linterna'].'</td>
			<td align="center" width="201">'.$img.'</td>
		</tr>
		';
		
	}
	if($enlist['extintor']==false){
		$img_base64_encoded = $enlist['img_extintor'];
		$img = '<img width="200" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
		$html .= '
		<tr>
			<td> <br /><br /><h3>- Extintor</h3></td>
			<td ><br /><br /><br />'.$enlist['desc_extintor'].'</td>
			<td align="center" width="201">'.$img.'</td>
		</tr>
		';
	}
	if($enlist['botiquin']==false){
		$img_base64_encoded = $enlist['img_botiquin'];
		$img = '<img width="200" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
		$html .= '
		<tr>
			<td> <br /><br /><h3>- Botiquin</h3></td>
			<td ><br /><br /><br />'.$enlist['desc_botiquin'].'</td>
			<td align="center" width="201">'.$img.'</td>
		</tr>
		';
	}
	if($enlist['repuesto']==false){
		$img_base64_encoded = $enlist['img_repuesto'];
		$img = '<img width="200" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
		$html .= '
		<tr>
			<td> <br /><br /><h3>- Repuesto</h3></td>
			<td ><br /><br /><br />'.$enlist['desc_repuesto'].'</td>
			<td align="center" width="201">'.$img.'</td>
		</tr>
		';
	}
	if($enlist['retrovisores']==false){
		$img_base64_encoded = $enlist['img_retrovisores'];
		$img = '<img width="200" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
		$html .= '
		<tr>
			<td> <br /><br /><h3>- Retrovisores</h3></td>
			<td ><br /><br /><br />'.$enlist['desc_retrovisores'].'</td>
			<td align="center" width="201">'.$img.'</td>
		</tr>
		';
	}
	if($enlist['cinturones']==false){
		$img_base64_encoded = $enlist['img_cinturones'];
		$img = '<img width="200" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
		$html .= '
		<tr>
			<td> <br /><br /><h3>- Cinturones de seguridad</h3></td>
			<td ><br /><br /><br />'.$enlist['desc_cinturones'].'</td>
			<td align="center" width="201">'.$img.'</td>
		</tr>
		';
	}
	if($enlist['motor']==false){
		$img_base64_encoded = $enlist['img_motor'];
		$img = '<img width="200" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
		$html .= '
		<tr>
			<td> <br /><br /><h3>- Motor</h3></td>
			<td ><br /><br /><br />'.$enlist['desc_motor'].'</td>
			<td align="center" width="201">'.$img.'</td>
		</tr>
		';
	}
	if($enlist['llantas']==false){
		$img_base64_encoded = $enlist['img_llantas'];
		$img = '<img width="200" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
		$html .= '
		<tr>
			<td> <br /><br /><h3>- Llantas</h3></td>
			<td ><br /><br /><br />'.$enlist['desc_llantas'].'</td>
			<td align="center" width="201">'.$img.'</td>
		</tr>
		';
	}
	if($enlist['baterias']==false){
		$img_base64_encoded = $enlist['img_baterias'];
		$img = '<img width="200" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
		$html .= '
		<tr>
			<td> <br /><br /><h3>- Baterias</h3></td>
			<td ><br /><br /><br />'.$enlist['desc_baterias'].'</td>
			<td align="center" width="201">'.$img.'</td>
		</tr>
		';
	}
	if($enlist['transmision']==false){
		$img_base64_encoded = $enlist['img_transmision'];
		$img = '<img width="200" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
		$html .= '
		<tr>
			<td> <br /><br /><h3>- Transmision</h3></td>
			<td ><br /><br /><br />'.$enlist['desc_transmision'].'</td>
			<td align="center" width="201">'.$img.'</td>
		</tr>
		';
	}
	if($enlist['tension']==false){
		$img_base64_encoded = $enlist['img_tension'];
		$img = '<img width="200" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
		$html .= '
		<tr>
			<td> <br /><br /><h3>- Tension de correas</h3></td>
			<td ><br /><br /><br />'.$enlist['desc_tension'].'</td>
			<td align="center" width="201">'.$img.'</td>
		</tr>
		';
	}
	if($enlist['tapas']==false){
		$img_base64_encoded = $enlist['img_tapas'];
		$img = '<img width="200" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
		$html .= '
		<tr>
			<td> <br /><br /><h3>- Tapas</h3></td>
			<td ><br /><br /><br />'.$enlist['desc_tapas'].'</td>
			<td align="center" width="201">'.$img.'</td>
		</tr>
		';
	}
	if($enlist['niveles']==false){
		$img_base64_encoded = $enlist['img_niveles'];
		$img = '<img width="200" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
		$html .= '
		<tr>
			<td> <br /><br /><h3>- Niveles</h3></td>
			<td ><br /><br /><br />'.$enlist['desc_niveles'].'</td>
			<td align="center" width="201">'.$img.'</td>
		</tr>
		';
	}
	if($enlist['filtros']==false){
		$img_base64_encoded = $enlist['img_filtros'];
		$img = '<img width="200" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
		$html .= '
		<tr>
			<td> <br /><br /><h3>- Filtros</h3></td>
			<td ><br /><br /><br />'.$enlist['desc_filtros'].'</td>
			<td align="center" width="201">'.$img.'</td>
		</tr>
		';
	}
	if($enlist['parabrisas']==false){
		$img_base64_encoded = $enlist['img_parabrisas'];
		$img = '<img width="200" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
		$html .= '
		<tr>
			<td> <br /><br /><h3>- Parabrisas</h3></td>
			<td ><br /><br /><br />'.$enlist['desc_parabrisas'].'</td>
			<td align="center" width="201">'.$img.'</td>
		</tr>
		';
	}
	if($enlist['frenos']==false){
		$img_base64_encoded = $enlist['img_frenos'];
		$img = '<img width="200" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
		$html .= '
		<tr>
			<td> <br /><br /><h3>- Frenos</h3></td>
			<td ><br /><br /><br />'.$enlist['desc_frenos'].'</td>
			<td align="center" width="201">'.$img.'</td>
		</tr>
		';
	}
	if($enlist['frenos_emergencia']==false){
		$img_base64_encoded = $enlist['img_frenos_emergencia'];
		$img = '<img width="200" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
		$html .= '
		<tr>
			<td> <br /><br /><h3>- Frenos de emergencia</h3></td>
			<td ><br /><br /><br />'.$enlist['desc_frenos_emergencia'].'</td>
			<td align="center" width="201">'.$img.'</td>
		</tr>
		';
	}
	if($enlist['aire']==false){
		$img_base64_encoded = $enlist['img_aire'];
		$img = '<img width="200" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
		$html .= '
		<tr>
			<td> <br /><br /><h3>- Aire acondicionado</h3></td>
			<td ><br /><br /><br />'.$enlist['desc_aire'].'</td>
			<td align="center" width="201">'.$img.'</td>
		</tr>
		';
	}
	if($enlist['luces']==false){
		$img_base64_encoded = $enlist['img_luces'];
		$img = '<img width="200" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
		$html .= '
		<tr>
			<td> <br /><br /><h3>- Luces </h3></td>
			<td ><br /><br /><br />'.$enlist['desc_luces'].'</td>
			<td align="center" width="201">'.$img.'</td>
		</tr>
		';
	}
	if($enlist['silleteria']==false){
		$img_base64_encoded = $enlist['img_silleteria'];
		$img = '<img width="200" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
		$html .= '
		<tr>
			<td> <br /><br /><h3>- Silleteria</h3></td>
			<td ><br /><br /><br />'.$enlist['desc_silleteria'].'</td>
			<td align="center" width="201">'.$img.'</td>
		</tr>
		';
	}
	if($enlist['silla_conductor']==false){
		$img_base64_encoded = $enlist['img_silla_conductor'];
		$img = '<img width="200" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
		$html .= '
		<tr>
			<td> <br /><br /><h3>- Silla conductor</h3></td>
			<td ><br /><br /><br />'.$enlist['desc_silla_conductor'].'</td>
			<td align="center" width="201">'.$img.'</td>
		</tr>
		';
	}
	if($enlist['aseo']==false){
		$img_base64_encoded = $enlist['img_aseo'];
		$img = '<img width="200" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
		$html .= '
		<tr>
			<td> <br /><br /><h3>- Aseo</h3></td>
			<td ><br /><br /><br />'.$enlist['desc_aseo'].'</td>
			<td align="center" width="201">'.$img.'</td>
		</tr>
		';
	}
	if($enlist['celular']==false){
		$img_base64_encoded = $enlist['img_celular'];
		$img = '<img width="200" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
		$html .= '
		<tr>
			<td> <br /><br /><h3>- Celular con minutos</h3></td>
			<td ><br /><br /><br />'.$enlist['desc_celular'].'</td>
			<td align="center" width="201">'.$img.'</td>
		</tr>
		';
	}
	if($enlist['ruteros']==false){
		$img_base64_encoded = $enlist['img_ruteros'];
		$img = '<img width="200" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $img_base64_encoded) . '">';
		$html .= '
		<tr>
			<td> <br /><br /><h3>- Ruteros</h3></td>
			<td ><br /><br /><br />'.$enlist['desc_ruteros'].'</td>
			<td align="center" width="201">'.$img.'</td>
		</tr>
		';
	}
	

}



// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('alistamiento_'.$idEnlist.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+