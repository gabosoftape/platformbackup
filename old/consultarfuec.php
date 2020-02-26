<?php
require_once 'header.php';
require_once 'config/conexion.php';
?>
<div class="container">
	<div class="col-12 header" style="position: fixed; background-color: #FFF !important; z-index: 9;">
		<a class="navbar-brand" href="/fuec/home.php">
			<img src="images/logo.png" alt="">
			<img class="align-content" src="images/mintransporte.png" alt="">
		</a>
	</div>
	<?php
	$resultaccount = $mysqli->query("SELECT id, username, name FROM sys_user WHERE id = '".base64_decode($_GET['id'])."' ");
	$rowaccount=mysqli_fetch_array($resultaccount);
	?>
	<div class="content" style="margin-top:10%">
		<div class="row backgroundF8 animated fadeIn">
			<div class="col-12 text-center">
				<label class="background213C6C padding1">
					CONSULTAR FORMATO ÚNICO DE EXTRACTO DEL CONTRATO DEL SERVICIO PÚBLICO DE TRANSPORTE TERRESTRE AUTOMOTOR ESPECIAL
				</label>
				<h5><?php echo strtoupper($rowaccount['name']);?><h5>
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
										VER / EDITAR / IMPRIMIR 
									</th>
								</tr>
							<?php 
							$resultfuec = $mysqli->query("SELECT id, route, type_cvn, start, end, bs_responsible_id, consecutive_fuec FROM fuec_doc WHERE created_by = '".$rowaccount['id']."' ORDER BY ID DESC");
							$i=1;
							while($rowfuec=mysqli_fetch_array($resultfuec)){
								?>
								<tr>
									<td class="text-center">
										<b><?php echo $i;?>.</b>
									</td>
									<td class="text-center">
										<b><?php echo $rowfuec['consecutive_fuec'];?></b>
									</td>
									<td class="text-center">
										<?php 
											$resultresponsable = $mysqli->query("SELECT name, identification, identification_type FROM bs_account WHERE id = ".$rowfuec['bs_responsible_id']." ");
											$rowresponsable=mysqli_fetch_array($resultresponsable);
											echo strtoupper($rowresponsable['name']);
										?>
									</td>
									<td class="text-center">
										<?php echo $rowresponsable['identification_type'].' '.$rowresponsable['identification'];?>
									</td>
									<td class="text-center">
										<?php echo ucwords($rowfuec['route']);?>
									</td>
									<td class="text-center">
										<?php 
											$resulttipocontrato = $mysqli->query("SELECT tipocontrato FROM tipocontrato WHERE id = ".$rowfuec['type_cvn']." ");
											$rowtipocontrato=mysqli_fetch_array($resulttipocontrato);
											echo ucwords($rowtipocontrato['tipocontrato']);
										?>
									</td>
									<td class="text-center">
										<?php 
											echo '<i class="fas fa-calendar-alt"></i> '.substr($rowfuec['start'],0,10).' <br /><i class="fas fa-calendar-alt"></i> '.substr($rowfuec['end'],0,10);
										?>
									</td>
									<td>
										<div class="row">
											<div class="col-4">
												<i class="far fa-eye font20px myModalVer<?php echo $rowfuec['id']?>" data-toggle="modal" data-target="#myModalVer<?php echo $rowfuec['id']?>"></i>
												<div class="modal" id="myModalVer<?php echo $rowfuec['id']?>">
													<div class="modal-dialog modal-lg">
														<div class="modal-content">
															<div class="modal-header background213C6C text-center">
																<div><b class="modal-title">CONSULTAR FUEC <br /> <?php echo $rowfuec['consecutive_fuec'];?></b></div>
																<button type="button" class="close btn-outline-danger btn-sm" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<div id="consultar<?php echo $rowfuec['id']?>"></div>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close</button>
															</div>
														</div>
													</div>
												</div>
											</div>
											<script>
												$(".myModalVer<?php echo $rowfuec['id']?>").click(function(){
													$.ajax({
														data : {
															idfuec : '<?php echo $rowfuec['id']?>',
															id : '<?php echo $_GET['id']?>'
														},
														url:   'fuecid.php',
														type:  'POST',
														beforeSend: function () {
															$("#consultar<?php echo $rowfuec['id']?>").html("Procesando, espere por favor...");
														},
														success:  function (response){
															$("#consultar<?php echo $rowfuec['id']?>").html(response);
														}
													});
												});
											</script>
											<div class="col-4">
												<i class="fas fa-edit font20px" data-toggle="modal" data-target="#myModalEditar<?php echo $rowfuec['id']?>"></i>
												<div class="modal" id="myModalEditar<?php echo $rowfuec['id']?>">
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
											<div class="col-4">
												<a href="mpdf/fuec.php?id=<?php echo $_GET['id']?>&idfuec=<?php echo $rowfuec['id']?>" target="_blank">
													<i class="fas fa-print font20px"></i>
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