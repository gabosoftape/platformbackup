<?php
require_once 'config/conexion.php';
require_once 'controller/select.php';
?>
<link rel="stylesheet" href="css/select2.min.css"/>
<style>
	.select2{
		width:100% !Important;
		display: block;
		width: 100%;
		height: calc(2.25rem + 2px) !important;
		padding: .375rem .75rem;
		font-size: 1rem;
		line-height: 1.5;
		color: #495057;
		background-color: #fff;
		background-clip: padding-box !important;
		border: 1px solid #ced4da !important;
		border-radius: .25rem !important;
		transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
	}
	.select2-container--default .select2-selection--single {
		border: 0px solid #fff !important;
	}
	td, th, button, input{
		font-size:10px !important;
	}
</style>
<div class="row text-center background213C6C mb-2">
	<div class="col-2">
		<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalRemoveVehiculo" data-toggle="tooltip" title="Remover vehículo!">
			<i class="fas fa-user-minus"></i>
		</button>
		<div class="modal" id="myModalRemoveVehiculo">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header background213C6C">
						<h4 class="modal-title">Remover vehículo para <?php echo strtoupper($rowaccount['username']);?></h4>
						<button type="button" class="close btn-outline-danger" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<form action="controller/bdaddcontratista.php" name="bdaddcontratista" method="POST">
							<label class="color213C6C">Seleccione el nombre del vehículo a eliminar</label>
							<select name="bsunidadidremove" class="select2 form-control font12px" required="required">
								<option value="" disabled selected></option>
								<?php
								$resultselectvehiculoremove = $mysqli->query("SELECT id, name FROM bs_account_unit WHERE parent_id = '".$_POST['id']."' ORDER BY name ASC " );
								while($rowselectvehiculoremove=mysqli_fetch_array($resultselectvehiculoremove)){
									echo '<option value="'.$rowselectvehiculoremove["id"].'">'.$rowselectvehiculoremove['name'].'</option>';
								}
								?>
							</select>
							<input type="hidden" name="id" value="<?php echo $_POST['id'];?>" />
							<input type="hidden" name="removevehiculo" value="1" />
							<input type="submit" class="btn background213C6C btn-sm mt-3" value="Guardar"/>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-8">
		<label>VEHÍCULOS PARA <?php echo strtoupper($rowaccount['username']);?></label> 
	</div>
	<div class="col-2">
		<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalVehiculo" data-toggle="tooltip" title="Agregar conductor!">
			<i class="fas fa-user-plus"></i>
		</button>
		<div class="modal" id="myModalVehiculo">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header background213C6C">
						<h4 class="modal-title">Agregar vehículo para <?php echo strtoupper($rowaccount['username']);?></h4>
						<button type="button" class="close btn-outline-danger" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<form action="controller/bdaddcontratista.php" name="bdaddcontratista" method="POST">
							<label class="color213C6C">Seleccione el nombre del vehículo</label>
							<select name="addvehiculoid" class="select2 form-control font12px" required="required">
								<option value="" disabled selected></option>
								<?php 
								$resultselectvehiculo = $mysqli->query("SELECT id, name FROM bs_account_unit ORDER BY name ASC " );
								while($rowselectvehiculo=mysqli_fetch_array($resultselectvehiculo)){
									echo '<option value="'.$rowselectvehiculo["id"].'">'.ucwords($rowselectvehiculo['name']).'</option>';
								}
								?>
							</select>
							<input type="hidden" name="id" value="<?php echo $_POST['id'];?>" />
							<input type="hidden" name="add" value="1" />
							<input type="submit" class="btn background213C6C btn-sm mt-3" value="Guardar"/>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-12">
		<table class="col-12 table table-responsive table-striped table-bordered w-100 d-block d-md-table">
			<tr class="background213C6C">
				<th class="text-center">
					NOMBRE VEHÍCULO
				</th>
				<th class="text-center">
					COLOR
				</th>
				<th class="text-center">
					LÍNEA
				</th>
				<th class="text-center">
					MARCA
				</th>
				<th class="text-center">
					MODELO
				</th>
				<th class="text-center">
					MOTOR
				</th>
				<th class="text-center">
					SERIE
				</th>
				<th class="text-center">
					PROPIETARIO
				</th>
				<th class="text-center">
					NÚMERO DE OPERACIÓN
				</th>
				<th class="text-center">
					TYPE
				</th>
				<th class="text-center">
					CONTRATISTA
				</th>
				<th class="text-center">
					EDITAR
				</th>
				<th class="text-center">
					ESTADO
				</th>
			</tr>
		<?php
		$resultvehiculo = $mysqli->query("SELECT id, name, wialon_id, status, color, line, brand, model, motor, serie, owner, operation_number, type FROM bs_account_unit WHERE parent_id = '".$_POST['id']."'");
		$i=1;
		while($rowvehiculo=mysqli_fetch_array($resultvehiculo)){
			$resultvehiculodata = $mysqli->query("SELECT soat, tecnomecanica, tarjetadeoperacion FROM bs_account_unit_service_extras WHERE unit_id = '".$rowvehiculo['id']."' ");
			$rowvehiculodata=mysqli_fetch_array($resultvehiculodata);
			?>
				<tr>
					<td class="text-center">
						<?php echo strtoupper($rowvehiculo['name']); ?>
					</td>
					<td class="text-center" style="white-space: nowrap;">
						<?php echo $rowvehiculo['color']; ?>
					</td>
					<td class="text-center" style="white-space: nowrap;">
						<?php echo $rowvehiculo['line']; ?>
					</td>
					<td class="text-center" style="white-space: nowrap;">
						<?php echo $rowvehiculo['brand']; ?>
					</td>
					<td class="text-center" style="white-space: nowrap;">
						<?php echo $rowvehiculo['model']; ?>
					</td>
					<td class="text-center" style="white-space: nowrap;">
						<?php echo $rowvehiculo['motor']; ?>
					</td>
					<td class="text-center" style="white-space: nowrap;">
						<?php echo $rowvehiculo['serie']; ?>
					</td>
					<td class="text-center" style="white-space: nowrap;">
						<?php echo $rowvehiculo['owner']; ?>
					</td>
					<td class="text-center" style="white-space: nowrap;">
						<?php echo $rowvehiculo['operation_number']; ?>
					</td>
					<td class="text-center" style="white-space: nowrap;">
						<?php echo $rowvehiculo['type']; ?>
					</td>
					<td class="text-center" style="white-space: nowrap;">
						<?php 
							$resultselectcontratistavehiculo = $mysqli->query("SELECT name FROM bs_account WHERE  id = ".$rowvehiculo['wialon_id']." ");
							$rowselectcontratistavehiculo=mysqli_fetch_array($resultselectcontratistavehiculo);
							echo $rowselectcontratistavehiculo['name'];
						?>
					</td>
					<td class="text-center">
						<a href="#" data-toggle="modal" data-target="#myModalEditarVehiculo<?php echo $i;?>"><button class="btn background213C6C btn-sm">Editar</button></a>
						<style>
							.form-control{
								font-size:11px;
							}
						</style>
						<div id="myModalEditarVehiculo<?php echo $i;?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-lg" style="margin-top:8% !important; width:95%;">
								<div class="modal-content">
									<div class="modal-header background213C6C">
										<button type="button" class="close btn-outline-danger" data-dismiss="modal">&times;</button>
										<label class="modal-title">EDITAR VEHÍCULO <?php echo strtoupper($rowvehiculo['name']);?></label>
									</div>
									<div class="modal-body">
										<div class="row text-center">
											<div class="col-md-12">
												<form action="controller/bdeditarcontratista.php?id=<?php echo $rowvehiculo['id'];?>" name="bdeditarcontratista<?php echo $i;?>" method="POST" >
													<div class="col-md-12 text-justify marginTop2" style="background-color:#FFF; opacity: 0.9; font-size:12px;">
														<div class="row form-group">
															<div class="col-md-3 form-group">
																<a><label>* NOMBRE</label></a>
															</div>
															<div class="col-md-3 form-group">
																<input type="text" name="name" class="form-control" required value="<?php echo $rowvehiculo['name'];?>" style="font-size:12px !important;"/>
															</div>
															<div class="col-md-3 form-group">
																<a><label>* COLOR</label></a>
															</div>
															<div class="col-md-3 form-group">
																<input type="text" name="color" class="form-control" required value="<?php echo $rowvehiculo['color'];?>" style="font-size:12px !important;"/>
															</div>
															<div class="col-md-3 form-group">
																<a><label>* LÍNEA</label></a>
															</div>
															<div class="col-md-3 form-group">
																<input type="search" name="line" class="form-control" required value="<?php echo $rowvehiculo['line'];?>" style="font-size:12px !important;"/>
															</div>
															<div class="col-md-3 form-group">
																<a><label>* MARCA</label></a>
															</div>
															<div class="col-md-3 form-group">
																<input type="search" name="brand" class="form-control" required value="<?php echo $rowvehiculo['brand'];?>" style="font-size:12px !important;"/>
															</div>
															<div class="col-md-3 form-group">
																<a><label>* MODELO</label></a>
															</div>
															<div class="col-md-3 form-group">
																<input type="search" name="model" class="form-control" required value="<?php echo $rowvehiculo['model'];?>" style="font-size:12px !important;"/>
															</div>
															<div class="col-md-3 form-group">
																<a><label>* MOTOR</label></a>
															</div>
															<div class="col-md-3 form-group">
																<input type="search" name="motor" class="form-control" required value="<?php echo $rowvehiculo['motor'];?>" style="font-size:12px !important;"/>
															</div>
															<div class="col-md-3 form-group">
																<a><label>* SERIE</label></a>
															</div>
															<div class="col-md-3 form-group">
																<input type="search" name="serie" class="form-control" required value="<?php echo $rowvehiculo['serie'];?>" style="font-size:12px !important;"/>
															</div>
															<div class="col-md-3 form-group">
																<a><label>* PROPIETARIO</label></a>
															</div>
															<div class="col-md-3 form-group">
																<input type="search" name="owner" class="form-control" required value="<?php echo $rowvehiculo['owner'];?>" style="font-size:12px !important;"/>
															</div>
															<div class="col-md-3 form-group">
																<a><label>* NÚMERO DE OPERACIÓN</label></a>
															</div>
															<div class="col-md-3 form-group">
																<input type="search" name="operation_number" class="form-control" required value="<?php echo $rowvehiculo['operation_number'];?>" style="font-size:12px !important;"/>
															</div>
															<div class="col-md-3 form-group">
																<a><label>* TIPO</label></a>
															</div>
															<div class="col-md-3 form-group">
																<input type="search" name="type" class="form-control" required value="<?php echo $rowvehiculo['type'];?>" style="font-size:12px !important;"/>
															</div>
															<div class="col-md-3 form-group">
																<a><label>* CONTRATISTA</label></a>
															</div>
															<div class="col-md-3 form-group">
																<select name="contratistaid" class="select2 form-control font12px" required="required">
																	<option value="" disabled selected></option>
																	<?php 
																	$resultselectcontratista = $mysqli->query("SELECT id, name, identification FROM bs_account WHERE name LIKE '%Company -%' AND parent_id = ".$_POST['id']." ORDER BY name ASC " );
																	while($rowselectcontratista=mysqli_fetch_array($resultselectcontratista)){
																		echo '<option name="contratistaid" value="'.$rowselectcontratista["id"].'">'.ucwords(str_replace('Company -','',$rowselectcontratista['name'])).' '.$rowselectcontratista['identification'].'</option>';
																	}
																	?>
																</select>
															</div>
															<div class="col-md-3 form-group">
																<a><label>* VEN. SOAT</label></a>
															</div>
															<div class="col-md-3 form-group">
																<input type="date" name="soat" class="form-control" required value="<?php echo $rowvehiculodata['soat'];?>" style="font-size:12px !important;"/>
															</div>
															<div class="col-md-3 form-group">
																<a><label>* VEN. TECNOMECÁNICA</label></a>
															</div>
															<div class="col-md-3 form-group">
																<input type="date" name="tecnomecanica" class="form-control" required value="<?php echo $rowvehiculodata['tecnomecanica'];?>" style="font-size:12px !important;"/>
															</div>
															<div class="col-md-3 form-group"> 
																<a><label>* VEN. TARJETA OPERACIÓN</label></a>
															</div>
															<div class="col-md-3 form-group">
																<input type="date" name="tarjetadeoperacion" class="form-control" required value="<?php echo $rowvehiculodata['tarjetadeoperacion'];?>" style="font-size:12px !important;"/>
															</div>
															<div class="col-md-12 form-group text-center">
																<input type="hidden" name="id" value="<?php echo $_POST['id']?>" />
																<input type="submit" class="btn btn-success btn-sm" value="Actualizar" style="font-size:12px !important;"/>
															</div>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Cerrar</button>
									</div>
								</div>
							</div>
						</div>
					</td>
					<td class="text-center">
						<?php 
							if($rowvehiculo['status'] == 0){
								echo '
									<form action="controller/bdeditarcontratista.php" name="bdcontratista" method="POST" >
										<input type="hidden" value="'.$_POST['id'].'" name="id">
										<input type="hidden" value="'.$rowvehiculo['id'].'" name="vehiculoid">
										<input type="hidden" value="1" name="activo">
										<input type="submit" class="btn btn-warning" value="Off" style="font-size:10px;" />
									</form>
									';
							}elseif($rowvehiculo['status'] == 1){
								echo '
									<form action="controller/bdeditarcontratista.php" name="bdcontratista" method="POST" >
										<input type="hidden" value="'.$_POST['id'].'" name="id">
										<input type="hidden" value="'.$rowvehiculo['id'].'" name="vehiculoid">
										<input type="hidden" value="0" name="activo">
										<input type="submit" class="btn btn-success" value="On" style="font-size:10px;" />
									</form>
								';
							}
						?>
					</td>
				</tr>
			<?php
			$i++;
		}
		?>
		</table>
	</div>
</div>
<script src="js/select2.min.js"></script>
<script>
	$('.select2').select2();
</script>