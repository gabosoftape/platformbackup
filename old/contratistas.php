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
</style>
<div class="row text-center background213C6C mb-2">
	<div class="col-2">
		<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalRemove" data-toggle="tooltip" title="Remover contratista!">
			<i class="fas fa-user-minus"></i>
		</button>
		<div class="modal" id="myModalRemove">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header background213C6C">
						<h4 class="modal-title">Remover contratista para <?php echo strtoupper($rowaccount['username']);?></h4>
						<button type="button" class="close btn-outline-danger" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<form action="controller/bdaddcontratista.php" name="bdaddcontratista" method="POST">
							<label class="color213C6C">Seleccione el nombre del contratista a eliminar</label>
							<select name="contratistaid" class="select2 form-control font12px" required="required">
								<option value="" disabled selected></option>
								<?php
								$resultselectcontratistaremove = $mysqli->query("SELECT id, name, identification FROM bs_account WHERE name LIKE '%Company -%' AND parent_id = '".$_POST['id']."' ORDER BY name ASC " );
								while($rowselectcontratistaremove=mysqli_fetch_array($resultselectcontratistaremove)){
									echo '<option value="'.$rowselectcontratistaremove["id"].'">'.ucwords(str_replace('Company -','',$rowselectcontratistaremove['name'])).' '.$rowselectcontratistaremove['identification'].'</option>';
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
		<label>CONTRATISTAS PARA <?php echo strtoupper($rowaccount['username']);?></label> 
	</div>
	<div class="col-2">
		<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModalAdd" data-toggle="tooltip" title="Agregar contratista!">
			<i class="fas fa-user-plus"></i>
		</button>
		<div class="modal" id="myModalAdd">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header background213C6C">
						<h4 class="modal-title">Agregar contratista para <?php echo strtoupper($rowaccount['username']);?></h4>
						<button type="button" class="close btn-outline-danger" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<form action="controller/bdaddcontratista.php" name="bdaddcontratista" method="POST">
							<label class="color213C6C">Seleccione el nombre del contratista</label>
							<select name="contratistaid" class="select2 form-control font12px" required="required">
								<option value="" disabled selected></option>
								<?php 
								$resultselectcontratista = $mysqli->query("SELECT id, name, identification FROM bs_account WHERE name LIKE '%Company -%' AND parent_id IS NULL OR parent_id = 0 ORDER BY name ASC " );
								while($rowselectcontratista=mysqli_fetch_array($resultselectcontratista)){
									echo '<option value="'.$rowselectcontratista["id"].'">'.ucwords(str_replace('Company -','',$rowselectcontratista['name'])).' '.$rowselectcontratista['identification'].'</option>';
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
					RAZÓN SOCIAL
				</th>
				<th class="text-center">
					IDENTIFICACIÓN
				</th>
				<th class="text-center">
					RESPONSABLE
				</th>
				<th class="text-center">
					IDENTIFICACIÓN DEL RESPONSABLE
				</th>
				<th class="text-center">
					EDITAR
				</th>
				<th class="text-center">
					ESTADO
				</th>
			</tr>
		<?php
		$resultcontratista = $mysqli->query("SELECT id, name, identification, website, status FROM bs_account WHERE name LIKE '%Company -%' AND parent_id = '".$_POST['id']."'");
		$i=1;
		while($rowcopntratista=mysqli_fetch_array($resultcontratista)){
			$resultresponsable = $mysqli->query("SELECT id, name, identification_type_responsable, identification_responsable FROM bs_responsable WHERE accountid = '".$rowcopntratista['id']."'");
			$rowresponsable=mysqli_fetch_array($resultresponsable);
			
			$resultresponsableaddress = $mysqli->query("SELECT address FROM bs_address WHERE parent_id = ".$rowresponsable['id']." ");
			$rowresponsableaddress=mysqli_fetch_array($resultresponsableaddress);
			
			$resultresponsablephone = $mysqli->query("SELECT phone FROM bs_phone WHERE parent_id = ".$_POST['id']." ");
			$rowresponsablephone=mysqli_fetch_array($resultresponsablephone);
			
			$resultresponsableemail = $mysqli->query("SELECT email FROM bs_email WHERE parent_id = ".$_POST['id']." ");
			$rowresponsableemail=mysqli_fetch_array($resultresponsableemail);
			
			?>
				<tr>
					<td class="text-center">
						<?php echo strtoupper($rowcopntratista['name']); ?>
					</td>
					<td class="text-center" style="white-space: nowrap;">
						<?php echo $rowcopntratista['identification']; ?>
					</td>
					<td class="text-center" style="white-space: nowrap;">
						<?php echo $rowresponsable['name']; ?>
					</td>
					<td class="text-center" style="white-space: nowrap;">
						<?php echo $rowresponsable['identification_type_responsable'].' '.$rowresponsable['identification_responsable']; ?>
					</td>
					<td class="text-center">
						<a href="#" data-toggle="modal" data-target="#myModalEditar<?php echo $i;?>"><button class="btn background213C6C btn-sm">Editar</button></a>
						<style>
							.form-control{
								font-size:11px;
							}
						</style>
						<div id="myModalEditar<?php echo $i;?>" class="modal fade" role="dialog">
							<div class="modal-dialog modal-lg" style="margin-top:8% !important; width:95%;">
								<div class="modal-content">
									<div class="modal-header background213C6C">
										<button type="button" class="close btn-outline-danger" data-dismiss="modal">&times;</button>
										<label class="modal-title">EDITAR CONTRATISTA <?php echo strtoupper($rowcopntratista['name']);?></label>
									</div>
									<div class="modal-body">
										<div class="row text-center">
											<div class="col-md-12">
												<form action="controller/bdeditarcontratista.php?id=<?php echo $rowcopntratista['id'];?>" name="bdeditarcontratista<?php echo $i;?>" method="POST" >
													<div class="col-md-12 text-justify marginTop2" style="background-color:#FFF; opacity: 0.9; font-size:12px;">
														<div class="row form-group">
															<div class="col-md-6 form-group">
																<a><label>* RAZÓN SOCIAL</label></a>
																<input type="text" name="name" class="form-control" required value="<?php echo $rowcopntratista['name'];?>" style="font-size:12px !important;"/>
															</div>
															<div class="col-md-6 form-group">
																<a><label>* IDENTIFICACIÓN</label></a>																
																<div class="input-group">
																	<div class="input-group-btn" id="btnidentification_typew1">
																		<div class="row">
																			<div class="col-md-4 col-sm-12">
																				<select name="identification_type" class="form-control">
																					<option value="" disabled selected></option>
																					<?php 
																					$resulttipodoc = $mysqli->query("SELECT title, description FROM bs_account_id_type ORDER BY id ASC");
																					while($rowtipodoc=mysqli_fetch_array($resulttipodoc)){
																						$selected='';
																						if($rowaccountbs['identification_type'] == $rowtipodoc['title']){
																							$selected='selected';
																						}
																						echo '<option value="'.$rowtipodoc['title'].'" '.$selected.'>'.$rowtipodoc['title'].' - '.$rowtipodoc['description'].'</option>';
																					}
																					?>
																				</select>
																			</div>
																			<div class="col-8">
																				<input type="text" class="form-control" name="identification" id="identification" value="<?php echo $rowaccountbs['identification']?>">
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-md-6 form-group">
																<a><label>* RESPONSABLE</label></a>
																<input type="text" name="nameresponsable" class="form-control" required value="<?php echo $rowresponsable['name'];?>" style="font-size:12px !important;"/>
															</div>
															<div class="col-md-6 form-group">
																<a><label>* IDENTIFICACIÓN DEL RESPONSABLE</label></a>
																<div class="input-group">
																	<div class="input-group-btn">
																		<div class="row">
																			<div class="col-md-4 col-sm-12">
																				<select name="identification_type_responsable" class="form-control">
																					<option value="" disabled selected></option>
																					<?php 
																					$resulttipodocresponsable = $mysqli->query("SELECT title, description FROM bs_account_id_type ORDER BY id ASC");
																					while($rowtipodocresponsable=mysqli_fetch_array($resulttipodocresponsable)){
																						$selected='';
																						if($rowtipodocresponsable['title'] == $rowresponsable['identification_type_responsable']){
																							$selectedresponsable='selected';
																						}
																						else{
																							$selectedresponsable='';
																						}
																						echo '<option value="'.$rowtipodocresponsable['title'].'" '.$selectedresponsable.'>'.$rowtipodocresponsable['title'].' '.$rowtipodocresponsable['description'].'</option>';
																					}
																					?>
																				</select>
																			</div>
																			<div class="col-8">
																				<input type="text" class="form-control" name="identification_responsable" id="identification" value="<?php echo $rowresponsable['identification_responsable']?>">
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-md-6 form-group">
																<a><label>* Dirección</label></a>
																<input type="search" name="address" id="address" class="form-control" value="<?php echo $rowresponsableaddress['address'];?>" />
															</div>
															<div class="col-md-6 form-group">
																<a><label>* Sitio Web</label></a>
																<input type="search" name="website" id="website" class="form-control" value="<?php echo $rowcopntratista['website'];?>"/>
															</div>
															<div class="col-md-6 form-group">
																<a><label>* Teléfonos</label></a>
																<input type="number" name="phones" id="phones" class="form-control" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" value="<?php echo $rowresponsablephone['phone'];?>"/>
															</div>
															<div class="col-md-6 form-group">
																<a><label>* E-mail</label></a>
																<input type="email" name="email" id="email" class="form-control" value="<?php echo $rowresponsableemail['email'];?>"/>
															</div>
														</div>
														<div class="col-md-12 form-group text-center">
															<input type="hidden" name="contratistaid" value="<?php echo $rowcopntratista['id'];?>" />
															<input type="hidden" name="id" value="<?php echo $_POST['id']?>" />
															<input type="submit" class="btn btn-success btn-sm" value="Actualizar" style="font-size:12px !important;"/>
														</div>
													</div>
												</form>
											</div>
											<div class="col-md-12 backgroundF8 marginTop2">
												<label>LOGO</label>
												<form name="logo" action="controller/bdadjuntar.php" method="POST" enctype="multipart/form-data">
													<div class="col-12">
														<input type="file" class="btn background213C6C form-control " name="imagen[]" id="filelogo" required />
														<output id="listlogo"></output>
														<input type="hidden" name="id" value="<?php echo $rowcopntratista['id'];?>">
														<input type="hidden" name="logo" value="1">
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
																		document.getElementById("listlogo").innerHTML = ['<img style="width:50%" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
																	};
																})(f);
																reader.readAsDataURL(f);
															}
														}
														document.getElementById('filelogo').addEventListener('change', archivologo, false);
													</script>
												</form>
											</div>
											<div class="col-md-12 backgroundF8 marginTop3">
												<br />
												<br />
												<br />
												<label>FIRMA</label>
												<form name="firma" action="controller/bdadjuntar.php" method="POST" enctype="multipart/form-data">
													<div class="col-12">
														<input type="file" class="btn background213C6C form-control " name="imagen[]" id="filefirma" required />
														<output id="listfirma"></output>
														<input type="hidden" name="id" value="<?php echo $rowcopntratista['id'];?>">
														<input type="hidden" name="firma" value="1">
														<input type="submit" class="btn btn-success mt-2" value="Guardar"/>
													</div>
													<script>
														function archivofirma(evt) {
														  var files = evt.target.files;
															for (var i = 0, f; f = files[i]; i++){
																if (!f.type.match('image.*')){
																	continue;
																}
																var reader = new FileReader();
																reader.onload = (function(theFile){
																	return function(e){
																		document.getElementById("listfirma").innerHTML = ['<img style="width:50%" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
																	};
																})(f);
																reader.readAsDataURL(f);
															}
														}
														document.getElementById('filefirma').addEventListener('change', archivofirma, false);
													</script>
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
							if($rowcopntratista['status'] == 0){
								echo '
									<form action="controller/bdeditarcontratista.php" name="bdcontratista" method="POST" >
										<input type="hidden" value="'.$_POST['id'].'" name="id">
										<input type="hidden" value="'.$rowcopntratista['id'].'" name="contratistaid">
										<input type="hidden" value="1" name="activo">
										<input type="submit" class="btn btn-warning" value="Off" style="font-size:10px;" />
									</form>
									';
							}elseif($rowcopntratista['status'] == 1){
								echo '
									<form action="controller/bdeditarcontratista.php" name="bdcontratista" method="POST" >
										<input type="hidden" value="'.$_POST['id'].'" name="id">
										<input type="hidden" value="'.$rowcopntratista['id'].'" name="contratistaid">
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