<?php
require_once 'header.php';
?>
	<div class="content" style="margin-top:10%">
		<div class="animated fadeIn">
			<div class="row">
				<?php
				$resultaccount = $mysqli->query("SELECT id, user, password FROM empresas WHERE id = '".$_SESSION['nickname']."' ");
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
												<a class="nav-link active" id="vehiculostab" data-toggle="tab" href="#vehiculos" role="tab" aria-controls="vehiculos" aria-selected="false">Vehiculos</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" id="conductorestab" data-toggle="tab" href="#conductores" role="tab" aria-controls="conductores" aria-selected="false">Conductores</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" id="contratistastab" data-toggle="tab" href="#contratistas" role="tab" aria-controls="contratistas" aria-selected="false">Contratistas</a>
											</li>
										</ul>
										<div class="tab-content" id="myTabContent">
											<div class="tab-pane fade backgroundFFF show active " id="vehiculos" role="tabpanel" aria-labelledby="vehiculostab">
											</div>
											<div class="tab-pane fade backgroundFFF" id="perfil" role="tabpanel" aria-labelledby="perfiltab">
											</div>
											<div class="tab-pane fade backgroundFFF" id="contratistas" role="tabpanel" aria-labelledby="contratistastab">
											</div>
											<div class="tab-pane fade backgroundFFF" id="gconductores" role="tabpanel" aria-labelledby="gconductorestab">
											</div>
											<div class="tab-pane fade backgroundFFF" id="conductores" role="tabpanel" aria-labelledby="conductorestab">
											</div>
										</div>
										<script>
											$.ajax({
												data : {
													user_name : '<?php echo $rowaccount['user'];?>',
													userid : '<?php echo $rowaccount['id'];?>',
													access_token : '<?php echo $rowaccount['password'];?>'
												},
												url:   'units.php',
												type:  'POST',
												beforeSend: function () {
													$("#vehiculos").html("Procesando, espere por favor...");
												},
												success:  function (response){
													$("#vehiculos").html(response);
												}
											});
											$("#vehiculostab").click(function(){
												$.ajax({
													data : {
														user_name : '<?php echo $rowaccount['user'];?>',
														userid : '<?php echo $rowaccount['id'];?>',
														access_token : '<?php echo $rowaccount['password'];?>'
													},
													url:   'units.php',
													type:  'POST',
													beforeSend: function () {
														$("#vehiculos").html("Procesando, espere por favor...");
													},
													success:  function (response){
														$("#vehiculos").html(response);
													}
												});
											});
											$("#conductorestab").click(function(){
												$.ajax({
													data : { 
														user_name : '<?php echo $rowaccount['user'];?>',
														userid : '<?php echo $rowaccount['id'];?>',
														access_token : '<?php echo $rowaccount['password'];?>'
													},
													url:   'drivers.php',
													type:  'POST',
													beforeSend: function () {
														$("#conductores").html("Procesando, espere por favor...");
													},
													success:  function (response){
														$("#conductores").html(response);
													}
												});
											});
											$("#contratistastab").click(function(){
												$.ajax({
													data : {
														user_name : '<?php echo $rowaccount['user'];?>',
														access_token : '<?php echo $rowaccount['password'];?>'
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