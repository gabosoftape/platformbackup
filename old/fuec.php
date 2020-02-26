<?php
require_once 'header.php';
?>
<div class="container marginTop3">
	<?php
	$resultaccount = $mysqli->query("SELECT id, username, name FROM sys_user WHERE id = '".base64_decode($_GET['id'])."' ");
	$rowaccount=mysqli_fetch_array($resultaccount);
	
	$resultcompany = $mysqli->query("SELECT name, identification, identification_type, territorial_code FROM bs_account WHERE wialon_id = '".$rowaccount['id']."' ");
	$rowcompany=mysqli_fetch_array($resultcompany);
	
	$resultcontrato = $mysqli->query("SELECT id FROM fuec_doc ORDER BY id DESC LIMIT 1 ");
	$rowcontrato=mysqli_fetch_array($resultcontrato);
	
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
	<div class="content" style="margin-top:10%">
		<div class="row backgroundF8 animated fadeIn">
			<div class="col-12 text-center">
				<label class="background213C6C padding1">FORMATO ÚNICO DE EXTRACTO DEL CONTRATO DEL SERVICIO PÚBLICO DE TRANSPORTE TERRESTRE AUTOMOTOR ESPECIAL</label>
				<h5><?php echo $rowcompany['territorial_code'];?><h5>
			</div>
			<div class="col-12 backgroundF8 font12px">
				<div class="content">
					<div class="animated fadeIn">
						<div class="row">
							<div class="col-md-6">
								<div class="card">
									<div class="card-header">
										<strong class="card-title mb-3">CREAR FUEC</strong>
									</div>
									<a href="crearfuec.php?id=<?php echo $_GET['id']?>" >
										<div class="card-body">
											<div class="mx-auto d-block">
												<img class="mx-auto d-block" src="images/fuec.png" style="width:20%" alt="Card image cap">
												<h5 class="text-sm-center mt-2 mb-1">Comenzar</h5>
												<div class="location text-sm-center"><i class="fas fa-plus-square font35px"></i></div>
											</div>
										</div>
									</a>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header">
										<strong class="card-title mb-3">CONSULTAR FUEC</strong>
									</div>
									<a href="consultarfuec.php?id=<?php echo $_GET['id']?>" >
										<div class="card-body">
											<div class="mx-auto d-block">
												<img class="mx-auto d-block" src="images/fuec.png" style="width:20%" alt="Card image cap">
												<h5 class="text-sm-center mt-2 mb-1">Buscar</h5>
												<div class="location text-sm-center"><i class="fas fa-minus-square font35px"></i></div>
											</div>
										</div>
									</a>
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
<script src="js/select2.min.js"></script>
<script>
	$('.select2').select2();
</script>