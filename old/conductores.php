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
		<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalRemoveConductor" data-toggle="tooltip" title="Remover conductor!">
			<i class="fas fa-user-minus"></i>
		</button>
		<div class="modal" id="myModalRemoveConductor">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header background213C6C">
						<h4 class="modal-title">Remover conductor para <?php echo strtoupper($rowaccount['username']);?></h4>
						<button type="button" class="close btn-outline-danger" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<form action="controller/bdaddcontratista.php" name="bdaddcontratista" method="POST">
							<label class="color213C6C">Seleccione el nombre del conductor a eliminar</label>
							<select name="contratistaid" class="select2 form-control font12px" required="required">
								<option value="" disabled selected></option>
								<?php
								$resultselectcontratistaremove = $mysqli->query("SELECT id, name, identification FROM bs_account WHERE name NOT LIKE '%Company -%' AND parent_id = '".$_POST['id']."' ORDER BY name ASC " );
								while($rowselectcontratistaremove=mysqli_fetch_array($resultselectcontratistaremove)){
									echo '<option name="contratistaid" value="'.$rowselectcontratistaremove["id"].'">'.ucwords(str_replace('Company -','',$rowselectcontratistaremove['name'])).' '.$rowselectcontratistaremove['identification'].'</option>';
								}
								?>
							</select>
							<input type="hidden" name="id" value="<?php echo $_POST['id'];?>" />
							<input type="hidden" name="remove" value="1" />
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
		<label>CONDUCTORES PARA <?php echo strtoupper($rowaccount['username']);?></label> 
	</div>
	<div class="col-2">
		<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalAddConductor" data-toggle="tooltip" title="Agregar conductor!">
			<i class="fas fa-user-plus"></i>
		</button>
		<div class="modal" id="myModalAddConductor">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header background213C6C">
						<h4 class="modal-title">Agregar conductor para <?php echo strtoupper($rowaccount['username']);?></h4>
						<button type="button" class="close btn-outline-danger" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<form action="controller/bdaddcontratista.php" name="bdaddcontratista" method="POST">
							<label class="color213C6C">Seleccione el nombre del conductor</label>
							<select name="contratistaid" class="select2 form-control font12px" required="required">
								<option value="" disabled selected></option>
								<?php 
								$resultselectcontratista = $mysqli->query("SELECT id, name, identification FROM bs_account WHERE name NOT LIKE '%Company -%' AND parent_id IS NULL OR parent_id != '".$_POST['id']."' ORDER BY name ASC " );
								while($rowselectcontratista=mysqli_fetch_array($resultselectcontratista)){
									echo '<option name="contratistaid" value="'.$rowselectcontratista["id"].'">'.ucwords(str_replace('Company -','',$rowselectcontratista['name'])).' '.$rowselectcontratista['identification'].'</option>';
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
					NOMBRES
				</th>
				<th class="text-center">
					IDENTIFICACIÓN
				</th>
				<th class="text-center">
					VENCIMIENTO LICENCIA
				</th>
				<th class="text-center">
					FOTO
				</th>
				<th class="text-center">
					EDITAR
				</th>
				<th class="text-center">
					ESTADO
				</th>
			</tr>
		<?php
		$resultconductor = $mysqli->query("SELECT id, name, identification, status, datedriving FROM bs_account WHERE name NOT LIKE '%Company -%' AND parent_id = '".$_POST['id']."'");
		$i=1;
		while($rowconductor=mysqli_fetch_array($resultconductor)){
			?>
				<tr>
					<td class="text-center">
						<?php echo strtoupper($rowconductor['name']); ?>
					</td>
					<td class="text-center" style="white-space: nowrap;">
						<?php echo $rowconductor['identification']; ?>
					</td>
					<td class="text-center" style="white-space: nowrap;">
						<?php echo $rowconductor['datedriving']; ?>
					</td>
					<td class="text-center" style="white-space: nowrap;">
						<i class="far fa-images font25px" data-toggle="modal" data-target="#myModalFoto<?php echo $rowconductor['id']?>" data-toggle="tooltip" title="Ver / Cambiar Foto!"></i>
						<div class="modal" id="myModalFoto<?php echo $rowconductor['id']?>">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header background213C6C">
										<h4 class="modal-title">FOTO CONDUCTOR</h4>
										<button type="button" class="close btn-outline-danger btn-sm" data-dismiss="modal">&times;</button>
									</div>
									<div class="modal-body">
										<div class="mb-3 text-center">
											<?php
											if(file_exists('images/fotos/'.$rowconductor['id'].'.png') == true){
												echo '<img src="images/fotos/'.$rowconductor['id'].'.png" />';
											}else{
												echo '<h4 class="mt-2">Adjuntar foto</h4>';
											}
											?>
										</div>
										<form name="logo" action="controller/bdadjuntar.php" method="POST" enctype="multipart/form-data">
											<div class="col-12">
												<input type="file" class="btn background213C6C form-control " name="imagen[]" id="filefoto" required />
											</div>
											<div class="col-12">
												<output id="listfoto"></output>
											</div>
											<div class="col-12">
												<input type="hidden" name="id" value="<?php echo $_POST['id'];?>">
												<input type="hidden" name="conductor" value="<?php echo $rowconductor['id'];?>">
												<input type="hidden" name="foto" value="1">
												<input type="submit" class="btn btn-success mt-2" value="Guardar"/>
											</div>
											<script>
												function archivologo(evt) {
												  var files = evt.target.files;
													for (var i = 0, f; f = files[i]; i++){
														if (!f.type.match('image.*')){
															continue;
														}
														var reader = new FileReader();
														reader.onload = (function(theFile){
															return function(e){
																document.getElementById("listfoto").innerHTML = ['<img style="width:50%" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
															};
														})(f);
														reader.readAsDataURL(f);
													}
												}
												document.getElementById('filefoto').addEventListener('change', archivologo, false);
											</script>
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
					</td>
					<td class="text-center">
						<a href="#" data-toggle="modal" data-target="#myModalEditarConductor<?php echo $i;?>"><button class="btn background213C6C btn-sm">Editar</button></a>
						<style>
							.form-control{
								font-size:11px;
							}
						</style>
						<div id="myModalEditarConductor<?php echo $i;?>" class="modal fade" role="dialog">
							<div class="modal-dialog" style="margin-top:8% !important; width:95%;">
								<div class="modal-content">
									<div class="modal-header background213C6C">
										<button type="button" class="close btn-outline-danger" data-dismiss="modal">&times;</button>
										<label class="modal-title">EDITAR CONDUCTOR <?php echo strtoupper($rowconductor['name']);?></label>
									</div>
									<div class="modal-body">
										<div class="row text-center">
											<div class="col-md-12">
												<form action="controller/bdeditarcontratista.php?id=<?php echo $rowconductor['id'];?>" name="bdeditarcontratista<?php echo $i;?>" method="POST" >
													<div class="col-md-12 text-justify marginTop2" style="background-color:#FFF; opacity: 0.9; font-size:12px;">
														<div class="row form-group">
															<div class="col-md-6 form-group">
																<a><label>* NOMBRES</label></a>
															</div>
															<div class="col-md-6 form-group">
																<input type="text" name="name" class="form-control" required value="<?php echo $rowconductor['name'];?>" style="font-size:12px !important;"/>
															</div>
															<div class="col-md-6 form-group">
																<a><label>* IDENTIFICACIÓN</label></a>
															</div>
															<div class="col-md-6 form-group">
																<input type="text" name="identification" class="form-control" required value="<?php echo $rowconductor['identification'];?>" style="font-size:12px !important;"/>
															</div>
															<div class="col-md-6 form-group">
																<a><label>* VENCIMIENTO LICENCIA</label></a>
															</div>
															<div class="col-md-6 form-group">
																<input type="date" name="datedriving" class="form-control" required value="<?php echo $rowconductor['datedriving'];?>" style="font-size:12px !important;"/>
															</div>
														<div class="col-md-12 form-group text-center">
															<input type="hidden" name="contratistaid" value="<?php echo $rowconductor['id'];?>" />
															<input type="hidden" name="id" value="<?php echo $_POST['id']?>" />
															<input type="submit" class="btn btn-success btn-sm" value="Actualizar" style="font-size:12px !important;"/>
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
							if($rowconductor['status'] == 0){
								echo '
									<form action="controller/bdeditarcontratista.php" name="bdeditarcontratista" method="POST" >
										<input type="hidden" value="'.$_POST['id'].'" name="id">
										<input type="hidden" value="'.$rowconductor['id'].'" name="conductorid">
										<input type="hidden" value="1" name="activo">
										<input type="submit" class="btn btn-warning" value="Off" style="font-size:10px;" />
									</form>
									';
							}elseif($rowconductor['status'] == 1){
								echo '
									<form action="controller/bdeditarcontratista.php" name="bdeditarcontratista" method="POST" >
										<input type="hidden" value="'.$_POST['id'].'" name="id">
										<input type="hidden" value="'.$rowconductor['id'].'" name="conductorid">
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