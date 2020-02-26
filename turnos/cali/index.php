<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="gpscontrol">
		<meta name="author" content="gpscontrol">
		<link rel="shortcut icon" href="img/favicon.ico">
		<link href="css/animate.css" rel="stylesheet">
		<title>GPSCONTROL</title>
		<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<script src="//code.jquery.com/jquery-1.12.4.js"></script>
		<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	</head>
	<style>
		.table td, .table th {
			padding: 0.15rem;
		}
	</style>
	<body onload="setInterval('location.reload()',10000)" style="background-image: url('img/fondo.png');">
		<div class="container">
			<div class="row" style="padding:2%;">
				<div class="col-4 text-center esconder animated flip">
					<img src="img/gpscontrol.jpg"/>
				</div>
				<div class="col-4 offset-4 text-center esconder animated wobble">
					<img src="img/sigloxxi.jpg"/>
				</div>
				<div class="col-4 text-center esconder1 animated flip" style="display:none;">
					<img src="img/gpscontrol.jpg" style="width: 350%;"/>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" style="background-color:#FFF;">
							<tr style="background-color:#005EA0; color:#FFF;">
								<th style="color:#FFF !important;">
									<h4><b>#</b></h4>
								</th>
								<th>
									NÚMERO DEL MOVIL
								</th>
								<th>
									ESTADO
								</th>
								<th>
									EXCESO DE VELICIDAD
								</th>
								<th>
									FECHA Y HORA DE LLEGADA &nbsp;&nbsp;&nbsp;<?php echo date('Y-m-d')?>
								</th>
							</tr>
							<?php 
							include '../../config/conexion.php';
							$resultcount = $mysqli->query("SELECT COUNT(id) AS contar FROM mensajes_cali");
							$rowcount=mysqli_fetch_array($resultcount);
							$resultcounttoday = $mysqli->query("SELECT COUNT(id) AS contar FROM mensajes_cali WHERE CURR_TIME >= '".date('Y-m-d 00:00:00')."'");
							$rowcounttoday=mysqli_fetch_array($resultcounttoday);
							$rowcount['contar'] = ($rowcount['contar'] + 1) - ($rowcounttoday['contar'] + 1);
							$resultturno = $mysqli->query("SELECT id, UNIT, POS_TIME, SPEED, estado, SALIDA FROM mensajes_cali WHERE CURR_TIME >= '".date('Y-m-d 00:00:00')."' AND SALIDA = '' ORDER BY CAST(SPEED AS INT) ASC, ZONE DESC");
							$i=1; 
							$fuente='';
							while($rowturno=mysqli_fetch_array($resultturno)){
								$resultgeocerca = $mysqli->query("SELECT ZONE FROM mensajes_cali WHERE UNIT = '".$rowturno['UNIT']."' ORDER BY id DESC LIMIT 1");
								$rowgeocerca=mysqli_fetch_array($resultgeocerca);
								
									if($rowturno['estado'] == 1){
										$fuente='style="color:#CCC !important"';
									}
									else{
										$fuente='';
									}
									?> 
									<tr>
										<td style="background-color:#005EA0; color:#FFF;">
											<b <?php echo $fuente;?>><?php echo $i++;?>.</b>
										</td>
										<td>
											<span <?php echo $fuente;?>><?php echo $rowturno['UNIT'];?></span>
										</td>
										<td>
											<span>
											<?php 
												$resultgeocerca = $mysqli->query("SELECT ZONE FROM mensajes_cali WHERE UNIT = '".$rowturno['UNIT']."' ORDER BY id DESC LIMIT 1");
												$rowgeocerca=mysqli_fetch_array($resultgeocerca);
												if($rowgeocerca['ZONE'] == 'geo_peajes'){
													echo '<span style="color:green ">En camino</span>';
												}
												else{
													echo '<b style="color:#005EA0">En espera</b>';
												}
											?>
											</span>
										</td>
										<td>
											<span>
											<?php 
												if(intval($rowturno['SPEED']) > 80){
													echo '<span style="color:red ">'.$rowturno['SPEED'].'</span>';
												}
												else{
													echo '<b style="color:#005EA0">No reporta</b>';
												}
											?>
											</span>
										</td>
										<td>
											<b style="color:#005EA0">
												<span <?php echo $fuente;?>><?php echo substr($rowturno['POS_TIME'], 11);?></span>
											</b>
										</td>
									</tr>
								<?php 
								
							}
							?>
						</table>
					</div>
				</div>
			</div>
		</div>
		<script src="vendor/jquery/jquery.slim.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	</body>
</html>
<script>
if (($(window).width() <= 1024) && ($(window).height() <= 768)){
	$(".esconder").hide('fast');
	$(".esconder1").show('fast');
}
</script>