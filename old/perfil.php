<?php
require_once 'config/conexion.php';
require_once 'controller/select.php';
?>
<style>
	td, th, button, input, form-control, select{
		font-size:10px !important;
	}
</style>
<div class="row">
	<label class="background213C6C padding1 col-12 text-center">CONFIGURACIÓN PARA EL PERFIL DE <?php echo strtoupper($rowaccount['username']);?></label>
	<div class="col-md-6 col-sm-12 text-left">
		<form id="formperfil" name="formperfil">
			<div class="col-12 mb-1">
				<label class="marginLEFT2"><i class="fas fa-credit-card"></i> Razon Social</label>
			</div>
			<div class="col-12 mb-1 ">
				<input type="search" name="name" id="name" class="form-control" value="<?php echo $rowaccount['name'];?>"/>
			</div>
			<div class="col-12 mb-1">
				<label class="marginLEFT2"><i class="far fa-id-badge"></i> Identificacion</label>
			</div>
			<div class="col-12 mb-1">
				<div class="input-group">
					<div class="input-group-btn" id="btnidentification_typew1">
						<div class="row">
							<div class="col-md-4 col-sm-12">
								<select name="identification_type" id="identification_type" class="form-control">
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
			<div class="col-12 mb-1">
				<label class="marginLEFT2"><i class="fas fa-phone-volume"></i> Teléfonos</label>
			</div>
			<div class="col-12 mb-1">
				<input type="tel" name="phones" id="phones" class="form-control" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" value="<?php echo $rowphone['phone'];?>"/>
			</div>
			<div class="col-12 mb-1">
				<label class="marginLEFT2"><i class="fas fa-envelope-open-text"></i> E-mail</label>
			</div>
			<div class="col-12 mb-1">
				<input type="email" name="email" id="email" class="form-control" value="<?php echo $rowemail['email'];?>"/>
			</div>
			<div class="col-12 mb-1">
				<label class="marginLEFT2"><i class="fab fa-chrome"></i> Sitio Web</label>
			</div>
			<div class="col-12 mb-1">
				<input type="search" name="website" id="website" class="form-control" value="<?php echo $rowaccountbs['website'];?>"/>
			</div>
			<div class="col-12 mb-1">
				<label class="marginLEFT2"><i class="fas fa-map-marker-alt"></i> Dirección</label>
			</div>
			<div class="col-12 mb-1">
				<input type="search" name="address" id="address" class="form-control" value="<?php echo $rowaddress['address'];?>"/>
			</div>
			<div class="col-12 mb-1">
				<div class="row">
					<?php
					$vartag='';
					if($rowaddress['geotag'] != NULL){
						$vartag = explode(':',str_replace(' ','',str_replace('lng','',str_replace('lat','',str_replace('"','',str_replace('}','',str_replace('{','',$rowaddress['geotag'])))))));
					}
					else{
						$vartag[1] = 0;
						$vartag[2] = 0;
					}
					?>
					<div class="col-6">
						<i class="fas fa-map-marked-alt"></i> Latitud: <input type="search" name="lat" id="lat" class="form-control" value="<?php echo trim($vartag[1],',');?>"/>
					</div>
					<div class="col-6">
						<i class="fas fa-map-marked-alt"></i> Longitud: <input type="search" name="long" id="long" class="form-control" value="<?php echo trim($vartag[2],',');?>"/>
					</div>
				</div>
			</div>
			<div class="col-12 mb-1">
				<label class="marginLEFT2"><i class="fas fa-code-branch"></i> Código de habilitación territorial</label>
			</div>
			<div class="col-12 mb-1">
				<input type="search" name="territorial_code" id="territorial_code" class="form-control" value="<?php echo $rowaccountbs['territorial_code'];?>"/>
			</div>
			<div class="col-12 mb-1">
				<label class="marginLEFT2"><i class="fas fa-barcode"></i> Número de resolución de habilitación</label>
			</div>
			<div class="col-12 mb-1">
				<input type="email" name="resolution_code" id="resolution_code" class="form-control" value="<?php echo $rowaccountbs['resolution_code'];?>"/>
			</div>
			<div class="col-12 mb-1">
				<label class="marginLEFT2"><i class="fas fa-calendar-week"></i> Fecha de habilitación <?php echo date('d/m/Y',strtotime(substr($rowaccountbs['date_enabled'], 0, 9)))?></label>
			</div>
			<div class="col-12 mb-1">
				<input type="datetime" name="date_enabled" id="date_enabled" class="form-control" value="<?php echo date('d/m/Y',strtotime(substr($rowaccountbs['date_enabled'], 0, 9)));?>"/>
			</div>
			<div class="col-12 mb-1 text-center background213C6C">
				<div id="resultado"></div>
				<i class="far fa-save font35px" id="saveperfil"></i>
			</div>
		</form>
	</div>
	<script>
		$("#saveperfil").click(function(){
			var data = $('#formperfil').serializeArray();
			data.push({name:'id', value:'<?php echo $_POST['id'];?>'});
			$.ajax({
				data : data,
				url:   'controller/bdeditarcontratista.php',
				type:  'POST',
				beforeSend: function () {
					$("#resultado").html("Procesando, espere por favor...");
					$("#saveperfil").toggle("fast");
				},
				success:  function (response) {
					$("#saveperfil").toggle("fast");
					$("#resultado").html(response);
				}
			});
		});
	</script>
	<div class="col-6 mt-3 mb-1 backgroundF8">
		<div class="row">
			<div class="col-6 mt-1 mb-3">
				<button type="button" class="btn btn-sm background213C6C mt-1 mb-2" data-toggle="modal" data-target="#myModalLogo" data-toggle="tooltip" title="Agregar logo!">
					<i class="fas fa-sync-alt"></i> 
				</button>
				<div class="padre">
					<div class="hijo">
						<?php
						if(file_exists('images/logos/'.$_POST['id'].'.png') == true){
							echo '<img src="images/logos/'.$_POST['id'].'.png" />';
						}else{
							echo '<h4 class="mt-2">Adjuntar logo</h4>';
						}
						?>
					</div>
				</div>
				<div class="modal" id="myModalLogo">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header background213C6C">
								<h4 class="modal-title">Adjuntar logo</h4>
								<button type="button" class="close btn-outline-danger btn-sm" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<form name="logo" action="controller/bdadjuntar.php" method="POST" enctype="multipart/form-data">
									<div class="col-12">
										<input type="file" class="btn background213C6C form-control " name="imagen[]" id="filelogo" required />
										<output id="listlogo"></output>
										<input type="hidden" name="id" value="<?php echo $_POST['id'];?>">
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
							<div class="modal-footer">
								<button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-6 mt-1 mb-3">
				<button type="button" class="btn btn-sm background213C6C mt-1 mb-2" data-toggle="modal" data-target="#myModalFirma" data-toggle="tooltip" title="Agregar firma!">
					<i class="fas fa-sync-alt"></i> 
				</button>
				<div class="padre">
					<div class="hijo">
						<?php
						if(file_exists('images/firmas/'.$_POST['id'].'.png') == true){
							echo '<img src="images/firmas/'.$_POST['id'].'.png" />';
						}
						else{
							echo '<h4 class="mt-2">Adjuntar firma</h4>';
						}
						?>
					</div>
				</div>
				<div class="modal" id="myModalFirma">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header background213C6C">
								<h4 class="modal-title">Adjuntar firma</h4>
								<button type="button" class="close btn-outline-danger btn-sm" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<form name="firma" action="controller/bdadjuntar.php" method="POST" enctype="multipart/form-data">
									<div class="col-12">
										<input type="file" class="btn background213C6C form-control " name="imagen[]" id="filefirma" required />
										<output id="listfirma"></output>
										<input type="hidden" name="id" value="<?php echo $_POST['id'];?>">
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
							<div class="modal-footer">
								<button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 mt-3">
				<?php
				$geotag='[-74.063753, 4.658622]';
				if($rowaddress['geotag'] != NULL){
					$vartag = explode(':',str_replace(' ','',str_replace('lng','',str_replace('lat','',str_replace('"','',str_replace('}','',str_replace('{','',$rowaddress['geotag'])))))));
					$geotag='['.$vartag[2].', '.trim($vartag[1],',').']';
				}
				?>
				<div id='map' style="width: 100%; height: 450px; position: initial; margin-left: -230px;"></div>
				<script>
					mapboxgl.accessToken = 'pk.eyJ1Ijoib3pjaGFtb3JyaXRvIiwiYSI6ImNqdmM4ejZ3aDAwMmc0M21obWNpc3hiM3YifQ.T0AMUYe9S7Els9g9jKLzFw';
					var map = new mapboxgl.Map({
					container: 'map', 
					style: 'mapbox://styles/mapbox/streets-v11',
					center: <?php echo $geotag;?>, 
					zoom: 13
					});
					map.addControl(new mapboxgl.NavigationControl());
					map.on('load', function() {
						map.loadImage('images/tag.png', function(error, image){
						if (error) throw error;
						map.addImage('cat', image);
							map.addLayer({
								"id": "points",
								"type": "symbol",
								"source": {
									"type": "geojson",
									"data": {
										"type": "FeatureCollection",
										"features": [{
											"type": "Feature",
											"geometry": {
												"type": "Point",
												"coordinates": <?php echo $geotag;?>
											}
										}]
									}
								},
								"layout": {
								"icon-image": "cat",
								"icon-size": 0.25
								}
							});
						});
					});
				</script>
			</div>
		</div>
	</div>
</div>