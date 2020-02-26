<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once 'header.php';
require_once 'config/conexion.php';
$userid=$_REQUEST['userid'];
?>
<style>
.navbargps{
	-webkit-appearance: meter !important; 
	background-color:#1D2C65 !important; 
	color:#ffffff;
}
.navbar .navbar-nav li > a {
    line-height: 0px !important;
    padding: 10px !important;
}
</style>
<div class="container">
    <div class="col-12 header" style=" background-color: #FFF !important; z-index: 9;">
		<img src="images/logo.png" alt="">
		<img class="align-content" src="https://www.supertransporte.gov.co/wp-content/uploads/2019/08/ministerio_1.png" alt="">
	</div>	
	<?php
	$resultaccount = $mysqli->query("SELECT * FROM empresas WHERE id = '".$_REQUEST['userid']."' ");
	$rowaccount=mysqli_fetch_array($resultaccount);
	?>

<!-- Inicio Menu con íconos Carlos -->  
<style>
a:hover {
    text-decoration: none;
    background-color: #1D2C65 !important;
    color: #fff;
}
</style>
    <div class="row">
    	<nav class="navbar navbar-expand col-md-12 col-sm-12" style="background-color:#1D2C65 !important;"> 
            <ul class="nav navbar-nav">
                <li class="nav-item col-md-3 col-sm-3">
                    <a href="home.php?user_name=<?php echo $rowaccount['user']?>" data-toggle="search">
                        <i class="pe-7s-home"></i>
                        <p>Inicio</p>
                    </a>
                </li>
                <li class="nav-item col-md-3 col-sm-3">
                    <a href="crearfuec.php?userid=<?php echo $rowaccount['id'];?>">
                        <i class="pe-7s-id"></i>
                        <p>FUEC</p>
                    </a>
                </li>                 
                <li class="nav-item col-md-3 col-sm-3">
                    <a href="#" data-toggle="search" style="color:#fff !important;background-color: #1D2C65 !important;">
                        <i class="pe-7s-note2"></i>
                        <p>Historial</p>
                    </a>
                </li>    
                <li class="nav-item col-md-3 col-sm-3">
                    <a href="logout.php" data-toggle="search">
                        <i class="pe-7s-door-lock"></i>
                        <p>Salir</p>
                    </a>
                </li>                             

			</ul>
		</nav>
	</div>

<!-- Fin Menu con íconos Carlos --> 

	<div class="content">
		<div class="row backgroundF8 animated fadeIn">
			<div class="col-12 text-center mt-2">
				<h5>HISTORIAL FUEC - <?php echo strtoupper($rowaccount['user']);?><h5>
			</div>
			<div class="col-12 backgroundF8 font12px">
				<div class="content">
					<div class="animated fadeIn">
						<div class="row">
							<table class="col-12 table table-responsive table-striped table-bordered w-100 d-block d-md-table">
								<tr class="background213C6C">
									<th class="text-center">
										<i class="fas fa-sort-numeric-down font25px"></i>
									</th>
									<th class="text-center">
										CONSECUTIVO
									</th>
									<th class="text-center"> 
										CONTRATISTA / RESPONSABLE
									</th>
									<th class="text-center">
										IDENTIFICACIÓN
									</th>
									<th class="text-center">
										ORIGEN-DESTINO
									</th>
									<th class="text-center">
										CONVENIOS
									</th>
									<th class="text-center">
										VIGENCIA
									</th>
									<th class="text-center">
										<!--VER / EDITAR / -->IMPRIMIR 
									</th>
								</tr>
							<?php 
							$resultfuec = $mysqli->query("SELECT * FROM fuec WHERE userid = '".$rowaccount['id']."' ORDER BY ID DESC");
							$i=1;
							while($rowfuec=mysqli_fetch_array($resultfuec)){
								$resultresponsable = $mysqli->query("SELECT * FROM responsable WHERE nit = '".$rowfuec['responsableid']."' ");
								$rowresponsable =mysqli_fetch_array($resultresponsable);
								$resultcontratista = $mysqli->query("SELECT * FROM contratista WHERE id = '".$rowfuec['contratistaid']."' ");
								$rowcontratista =mysqli_fetch_array($resultcontratista);
								?>
								<tr>
									<td class="text-center">
										<b><?php echo $i;?>.</b>
									</td>
									<td class="text-center">
										<b><?php echo $rowfuec['contratoid'];?></b>
									</td>
									<td class="text-center">
										<?php 
											echo strtoupper($rowresponsable['nombres']);
										?>
									</td>
									<td class="text-center">
										<?php echo $rowresponsable['nit'];?>
									</td>
									<td class="text-center">
										<?php echo ucwords($rowfuec['route']);?>
									</td>
									<td class="text-center">
										<?php 
											echo ucwords($rowfuec['type_cvn']);
										?>
									</td>
									<td class="text-center">
										<?php 
											echo '<i class="fas fa-calendar-alt"></i> '.substr($rowfuec['start'],0,10).' <br /><i class="fas fa-calendar-alt"></i> '.substr($rowfuec['end'],0,10);
										?>
									</td>
									<td>
										<div class="row">
											<!--
											<div class="col-4">
												<i class="far fa-eye font20px myModalVer<?php //echo $rowfuec['id']?>" data-toggle="modal" data-target="#myModalVer<?php //echo $rowfuec['id']?>"></i>
												<div class="modal" id="myModalVer<?php //echo $rowfuec['id']?>">
													<div class="modal-dialog modal-lg">
														<div class="modal-content">
															<div class="modal-header background213C6C text-center">
																<div><b class="modal-title">CONSULTAR FUEC <br /> <?php //echo $rowfuec['id'];?></b></div>
																<button type="button" class="close btn-outline-danger btn-sm" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<div id="consultar<?php //echo $rowfuec['id']?>"></div>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close</button>
															</div>
														</div>
													</div>
												</div>
											</div>
											<script>
												$(".myModalVer<?php //echo $rowfuec['id']?>").click(function(){
													$.ajax({
														data : {
															idfuec : '<?php //echo $rowfuec['id']?>',
															id : '<?php //echo $_REQUEST['userid']?>'
														},
														url:   'fuecid.php',
														type:  'POST',
														beforeSend: function () {
															$("#consultar<?php //echo $rowfuec['id']?>").html("Procesando, espere por favor...");
														},
														success:  function (response){
															$("#consultar<?php //echo $rowfuec['id']?>").html(response);
														}
													});
												});
											</script>
											<div class="col-4">
												<i class="fas fa-edit font20px" data-toggle="modal" data-target="#myModalEditar<?php //echo $rowfuec['id']?>"></i>
												<div class="modal" id="myModalEditar<?php //echo $rowfuec['id']?>">
													<div class="modal-dialog modal-lg">
														<div class="modal-content">
															<div class="modal-header background213C6C">
																<h4 class="modal-title">Modal Heading</h4>
																<button type="button" class="close btn-outline-danger btn-sm" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																Modal body..
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close</button>
															</div>
														</div>
													</div>
												</div>
											</div>
											-->
											<div class="col-12 text-center">
												<a href="mpdf/fuec.php?id=<?php echo $rowfuec['id']?>&idfuec=<?php echo $rowfuec['id']?>&userid=<?php echo $_REQUEST['userid']?>" target="_blank">
													<span style="color:#1D2C65 !important"><i class="fas fa-print font20px"  ></i></span>
												</a>	
											</div>
										</div>
									</td> 
								</tr>
								<?php
								$i++; 
							}
							?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
<?php
require_once 'footer.php';
?>
<script src="js/select2.min.js"></script>
<script>
	$('.select2').select2();
</script>