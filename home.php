<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once 'header.php';
$resultaccount = $mysqli->query("SELECT id, user, password, razonsocial, tipodocumento, documento, telefono, celular, email, website, address, logo, firma, territorial_code, resolution_code, date_enabled FROM empresas WHERE user = '".$_GET['user_name']."' ");
$rowaccount = mysqli_fetch_array($resultaccount);
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

<body>
	<div class="container">
		<div class="col-12 header" style=" background-color: #FFF !important; ">
			<img src="images/logo.png" alt="">
			<img src="images/mintransporte.png" alt="">
		</div>

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
                <a href="#" style="color:#fff !important;background-color: #1D2C65 !important;">
                        <i class="pe-7s-home"></i>
                        <p>Inicio</p>
                    </a>
                </li>
                <li class="nav-item col-md-3 col-sm-3">
                    <a href="crearfuec.php?userid=<?php echo $rowaccount['id'];?>" >
                        <i class="pe-7s-id"></i>
                        <p>FUEC</p>
                    </a>
                </li>                 
                <li class="nav-item col-md-3 col-sm-3">
                    <a href="consultarfuec.php?userid=<?php echo $rowaccount['id'];?>" data-toggle="search">
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
		<div class="animated fadeIn">
			<div class="content">
				<style>
					td, th, button, input, form-control, select{
						font-size:10px !important;
					}
					form{
						font-size:13px !important;
					}
				</style>
				<div class="row mt-1">
					<label class="background213C6C padding1 col-12 text-center"><?php echo strtoupper($rowaccount['user']);?></label>
					<div class="col-md-8 col-sm-8">
						<form id="formperfil" name="formperfil">
							<div class="row">
								<div class="col-md-12 col-sm-12">
									<div class="form-group">
										<br><label class="col-sm-2 col-md-2 control-label">Razon Social</label>
										<div class="col-sm-10 col-md-10">
											<div class="input-group">
												<input type="hidden" name="name" id="name" class="form-control" value="<?php echo $rowaccount['user'];?>"/>
												<span class="input-group-addon"><i class="fas fa-credit-card"></i></span>
												<input type="search" name="razonsocial" id="razonsocial" class="form-control"  style="z-index:0;" value="<?php echo $rowaccount['razonsocial'];?>"/>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<br><label class="col-sm-4 col-md-4 control-label">identificación</label>
										<div class="col-sm-8 col-md-8">
											<div class="input-group">
												<span class="input-group-addon"><i class="far fa-id-badge"></i></span>
												<select name="tipodocumento" id="tipodocumento"  style="z-index:0;" class="form-control">
													<option value="" disabled></option>
													<?php 
													$selected='';
													$resulttipodoc = $mysqli->query("SELECT id, tipodocumento FROM tipodocumento ORDER BY tipodocumento ASC");
													while($rowtipodoc=mysqli_fetch_array($resulttipodoc)){
														if($rowaccount['tipodocumento'] == $rowtipodoc['tipodocumento']){
															$selected='selected';
														}else{
															$selected='';
														}
														echo '<option value="'.$rowtipodoc['id'].'" '.$selected.'>'.$rowtipodoc['tipodocumento'].'</option>';
													}
													?>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<div class="col-sm-12 col-md-12">
											<br><div class="input-group">
												<span class="input-group-addon"><i class="far fa-id-badge"></i></span>
												<input type="text" class="form-control"  style="z-index:0;" name="documento" id="documento" value="<?php echo $rowaccount['documento']?>">
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<br><label class="col-sm-4 col-md-4 control-label">Teléfono</label>
										<div class="col-sm-8 col-md-8">
											<div class="input-group">
											<span class="input-group-addon"><i class="fas fa-phone-volume"></i></span>
												<input type="text" class="form-control" name="telefono"  style="z-index:0;" id="telefono" value="<?php echo $rowaccount['telefono']?>">
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<br><label class="col-sm-4 col-md-4 control-label">Celular</label>
										<div class="col-sm-8 col-md-8">										
											<div class="input-group">
												<span class="input-group-addon"><i class="fas fa-phone-volume"></i></span>
												<input type="text" class="form-control" name="celular" id="celular"  style="z-index:0;" value="<?php echo $rowaccount['celular']?>">
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12 col-sm-12">
									<div class="form-group">
										<br><label class="col-sm-2 col-md-2 control-label">Email</label>
										<div class="col-sm-10 col-md-10">
											<div class="input-group">
												<span class="input-group-addon"><i class="fas fa-envelope-open-text"></i></span>
												<input type="search" name="email" id="email" class="form-control" style="z-index:0;" value="<?php echo $rowaccount['email'];?>"/>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12 col-sm-12">
									<div class="form-group">
										<br><label class="col-sm-2 col-md-2 control-label">Sitio Web</label>
										<div class="col-sm-10 col-md-10">
											<div class="input-group">
												<span class="input-group-addon"><i class="fab fa-chrome"></i></span>
												<input type="search" name="website" id="website" class="form-control"  style="z-index:0;" value="<?php echo $rowaccount['website'];?>"/>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12 col-sm-12">
									<div class="form-group">
										<br><label class="col-sm-2 col-md-2 control-label">Direccion</label>
										<div class="col-sm-10 col-md-10">
											<div class="input-group">
												<span class="input-group-addon"><i class="fas fa-map-marker-alt"></i></span>
												<input type="search" name="address" id="address" class="form-control"  style="z-index:0;" value="<?php echo $rowaccount['address'];?>"/>
											</div>
										</div>
									</div>
								</div>									
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<br><label class="col-sm-7 col-md-7 control-label">Código de Habilitación Territorial</label>
										<div class="col-sm-5 col-md-5">
											<div class="input-group">
											<span class="input-group-addon"><i class="fas fa-code-branch"></i></span>
												<input type="text" class="form-control" name="territorial_code" id="territorial_code"  style="z-index:0;" value="<?php echo $rowaccount['territorial_code']?>">
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
								<div class="form-group">
										<br><label class="col-sm-7 col-md-7 control-label">No. Resolucion Habilitación</label>
										<div class="col-sm-5 col-md-5">
											<div class="input-group">
											<span class="input-group-addon"><i class="fas fa-barcode"></i></span>
												<input type="text" class="form-control" name="resolution_code" id="resolution_code"  style="z-index:0;" value="<?php echo $rowaccount['resolution_code']?>">
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-8 col-sm-8">
								<div class="form-group">
										<br><label class="col-sm-6 col-md-6 control-label">Fecha de Habilitación</label>
										<div class="col-sm-6 col-md-6">
											<div class="input-group">
											<span class="input-group-addon"><i class="fas fa-calendar-week"></i></span>
												<input type="text" class="form-control" name="date_enabled" id="date_enabled"  style="z-index:0;" value="<?php echo $rowaccount['date_enabled']?>">
											</div>
										</div><br><br>
									</div>
								</div>
							

	
							
					</div>
					<div class="col-md-12 col-sm-12">			
								<div class="col-12 text-center background213C6C">
									<div id="resultado"></div>
									<i class="far fa-save font35px" id="saveperfil"></i>
								</div>
							</div>
						</form>
					</div>


					<style>
						.modal{
							max-width: 50vw;
                            max-heigth: 50vh;
						}
						.modal a.close-modal {
							position: absolute;
							top: 50vh;
							right: 50vw;
						}
					</style>
					<div class="col-md-4 col-sm-12 mt-3 mb-1 backgroundF8">
						<div class="row">
							<div class="col-12 text-center mt-1 mb-3">
								<a href="#myModalLogo" rel="modal:open">
									<button type="button" class="btn background213C6C mt-1 mb-2" title="Agregar logo!">
										<i class="fas fa-sync-alt"></i> Cambiar logo
									</button>
								</a>
								<div class="col-12 text-center">
									<img src="images/logos/<?php echo $rowaccount['logo'];?>"/>
								</div>
								<div class="modal" id="myModalLogo">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header background213C6C">
												<h4 class="modal-title">Cambiar logo</h4>
												<button type="button" class="close btn-outline-danger btn-sm" data-dismiss="modal">&times;</button>
											</div>
											<div class="modal-body">
											<form name="logo" action="controller/bdadjuntar.php" method="POST" enctype="multipart/form-data">
													<div class="col-12">
													<form enctype="multipart/form-data" action="bdadjuntar.php" method="POST">
														<input name="uploadedfile" type="file" />
													<br>               
														<input type="hidden" name="id" value="<?php echo $rowaccount['id'];?>">
														<input type="hidden" name="user" value="<?php echo $rowaccount['user'];?>">
														<input type="hidden" name="logo" value="2">                                                
														<input type="submit" value="Subir archivo" />
													</div>
												</form>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div><br><br>
                                <div class="col-12 text-center mt-1 mb-3">
								<a href="#myModalfirma" rel="modal:open">
									<button type="button" class="btn background213C6C mt-1 mb-2" title="Agregar firma!">
										<i class="fas fa-sync-alt"></i> Cambiar firma
									</button>
								</a>
                                <div class="col-12 text-center">
									<img src="images/firmas/<?php echo $rowaccount['firma'];?>" >
                                </div>
                            	<div class="modal" id="myModalfirma">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header background213C6C">
												<h4 class="modal-title">Cambiar Firma</h4>
												<button type="button" class="close btn-outline-danger btn-sm" data-dismiss="modal">&times;</button>
											</div>
											<div class="modal-body">
											<form name="firma" action="controller/bdadjuntar.php" method="POST" enctype="multipart/form-data">
													<div class="col-12">
													<form enctype="multipart/form-data" action="bdadjuntar.php" method="POST">
														<input name="uploadedfile" type="file" />
													<br>               
														<input type="hidden" name="id" value="<?php echo $rowaccount['id'];?>">
														<input type="hidden" name="user" value="<?php echo $rowaccount['user'];?>">
														<input type="hidden" name="firma" value="1">                                                
														<input type="submit" value="Subir archivo" />
													</div>
												</form>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>                                
							</div><!-- aqui iban las firmas -->
						</div>
					</div>
					<script>
						$("#saveperfil").click(function(){
							var data = $('#formperfil').serializeArray();
							data.push({name:'id', value:'<?php echo $rowaccount['id'];?>'});
							$.ajax({
								data : data,
								url:   'controller/bdusuario.php',
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
				</div>
			</div>
		</div>
	</div>
<div class="clearfix"></div>