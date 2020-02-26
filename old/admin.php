<?php
require_once 'header.php';
?>
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
<div class="container marginTop3">
	<div class="content" style="margin-top:10%">
		<div class="animated fadeIn">
			<div class="row">
				<?php
				$resultaccount = $mysqli->query("SELECT id, username, name FROM sys_user WHERE id = '".$_GET['id']."' ORDER BY id ASC");
				$rowaccount=mysqli_fetch_array($resultaccount);
				?>
				<div class="col-12 text-center">
					<div class="card">
						<div class="card-body">
							<div class="stat-widget-five">
								<div class="row mb-3">
									<div class="col-12 font12px">
										<ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
											<li class="nav-item">
												<a class="nav-link active" id="perfiltab" data-toggle="tab" href="#perfil" role="tab" aria-controls="perfil" aria-selected="true">Perfil</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" id="contratistastab" data-toggle="tab" href="#contratistas" role="tab" aria-controls="contratistas" aria-selected="false">Contratistas</a>
											</li>
											<!--
											<li class="nav-item">
												<a class="nav-link" id="gconductorestab" data-toggle="tab" href="#gconductores" role="tab" aria-controls="gconductores" aria-selected="true">Grupo de conductores</a>
											</li>
											-->
											<li class="nav-item">
												<a class="nav-link" id="conductorestab" data-toggle="tab" href="#conductores" role="tab" aria-controls="conductores" aria-selected="false">Conductores</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" id="vehiculostab" data-toggle="tab" href="#vehiculos" role="tab" aria-controls="vehiculos" aria-selected="false">Vehiculos</a>
											</li>
										</ul>
										<div class="tab-content" id="myTabContent">
											<div class="tab-pane fade show active backgroundFFF" id="perfil" role="tabpanel" aria-labelledby="perfiltab">
											</div>
											<div class="tab-pane fade backgroundFFF" id="contratistas" role="tabpanel" aria-labelledby="contratistastab">
											</div>
											<div class="tab-pane fade backgroundFFF" id="gconductores" role="tabpanel" aria-labelledby="gconductorestab">
											</div>
											<div class="tab-pane fade backgroundFFF" id="conductores" role="tabpanel" aria-labelledby="conductorestab">
											</div>
											<div class="tab-pane fade backgroundFFF" id="vehiculos" role="tabpanel" aria-labelledby="vehiculostab">
												...
											</div>
										</div>
										<script>
											$.ajax({
												data : {
													id : <?php echo base64_decode($_GET['id']);?>
												},
												url:   'perfil.php',
												type:  'POST',
												beforeSend: function () {
													$("#perfil").html("Procesando, espere por favor...");
												},
												success:  function (response){
													$("#perfil").html(response);
												}
											});
											$("#perfiltab").click(function(){
												$.ajax({
													data : {
														id : <?php echo base64_decode($_GET['id']);?>
													},
													url:   'perfil.php',
													type:  'POST',
													beforeSend: function () {
														$("#perfil").html("Procesando, espere por favor...");
													},
													success:  function (response){
														$("#perfil").html(response);
													}
												});
											});
											$("#contratistastab").click(function(){
												$.ajax({
													data : {
														id : <?php echo base64_decode($_GET['id']);?>
													},
													url:   'contratistas.php',
													type:  'POST',
													beforeSend: function () {
														$("#contratistas").html("Procesando, espere por favor...");
													},
													success:  function (response){
														$("#contratistas").html(response);
													}
												});
											});
											$("#conductorestab").click(function(){
												$.ajax({
													data : {
														id : <?php echo base64_decode($_GET['id']);?>
													},
													url:   'conductores.php',
													type:  'POST',
													beforeSend: function () {
														$("#conductores").html("Procesando, espere por favor...");
													},
													success:  function (response){
														$("#conductores").html(response);
													}
												});
											});
											$("#vehiculostab").click(function(){
												$.ajax({
													data : {
														id : <?php echo base64_decode($_GET['id']);?>
													},
													url:   'vehiculos.php',
													type:  'POST',
													beforeSend: function () {
														$("#vehiculos").html("Procesando, espere por favor...");
													},
													success:  function (response){
														$("#vehiculos").html(response);
													}
												});
											});
										</script>
									</div>
								</div>
							</div>
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