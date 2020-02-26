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
	<form action="controller/bdcrearfuec.php" name="bdcrearfuec" method="POST">
		<div class="content" style="margin-top:10%">
			<div class="row backgroundF8 animated fadeIn">
				<div class="col-12 text-center">
					<label class="background213C6C padding1">FORMATO ÚNICO DE EXTRACTO DEL CONTRATO DEL SERVICIO PÚBLICO DE TRANSPORTE TERRESTRE AUTOMOTOR ESPECIAL</label>
					<h5><?php echo $rowcompany['territorial_code'];?><h5>
				</div>
				<div class="col-12 backgroundF8 font12px">
					<div class="row backgroundFFF bordesDivBottom padding5px">
						<div class="col-8">
							<b>RAZÓN SOCIAL </b> 
							<?php echo strtoupper($rowcompany['name'])?>
						</div>
						<div class="col-4">
							<b><?php echo strtoupper($rowcompany['identification_type'])?></b> 
							<?php echo strtoupper($rowcompany['identification'])?>
						</div>
					</div>
					<div class="row backgroundFFF bordesDivBottom padding5px">
						<div class="col-12">
							<b>CONTRATO No. </b> 
							<?php 
							$resultnumerocontrato = $mysqli->query("SELECT contract FROM fuec_doc WHERE contract = (SELECT MAX( contract ) FROM fuec_doc)" );
							$rownumerocontrato=mysqli_fetch_array($resultnumerocontrato);
							echo $rownumerocontrato['contract'] + 1;
							?>
						</div>
					</div>
					<div class="row backgroundFFF bordesDivBottom padding5px">
						<div class="col-4">
							<b>CONTRATISTA </b>
						</div>
						<div class="col-8">
							<select name="contratistaid" id="contratistaidvalue" class="select2 form-control font12px" required="required">
								<option value="" disabled selected></option>
								<?php 
								$resultselectcontratista = $mysqli->query("SELECT id, name, identification FROM bs_account WHERE name LIKE '%Company -%' AND parent_id = '".base64_decode($_GET['id'])."' AND status = 1 ORDER BY name ASC " );
								while($rowselectcontratista=mysqli_fetch_array($resultselectcontratista)){
									echo '<option class="optionresponsable" value="'.$rowselectcontratista["id"].'">'.ucwords(str_replace('Company -','',$rowselectcontratista['name'])).' '.$rowselectcontratista['identification'].'</option>';
								}
								?>
							</select>
						</div>
					</div>
					<div class="row backgroundFFF bordesDivBottom padding5px">
						<div class="col-4">
							<b>RESPONSABLE </b>
						</div>
						<div class="col-8" id="responsable">
							<div id="contratistaid">
								<i class="fas fa-search-plus font25px"></i>
							</div>
						</div>
					</div>
					<input type="hidden" name="companyid" value="<?php echo $rowaccount['id'];?>" />
					<input type="hidden" name="territorial_code" value="<?php echo $rowcompany['territorial_code'];?>"/>
					<script>
						$("#contratistaid").click(function(){
							$.ajax({
								data : {
									contratistaid : document.getElementById('contratistaidvalue').value
								},
								url:   'responsable.php',
								type:  'POST',
								beforeSend: function () {
									$("#responsable").html("Procesando, espere por favor...");
								},
								success:  function (response){
									$("#responsable").html(response);
								}
							});
						});
					</script>
					<div class="row backgroundFFF bordesDivBottom padding5px">
						<div class="col-4">
							<b>OBJETO DEL CONTRATO </b>
						</div>
						<div class="col-8">
							<input type="search" name="objet_contract" class="form-control" required />
						</div>
					</div>
					<div class="row backgroundFFF bordesDivBottom padding5px">
						<div class="col-4">
							<b>ORIGEN-DESTINO, DESCRIBIENDO EL RECORRIDO </b>
						</div>
						<div class="col-8">
							<input type="search" name="route" class="form-control" required />
						</div>
					</div>
					<div class="row backgroundFFF bordesDivBottom padding5px">
						<div class="col-4">
							<b>DESCRIPCION DEL RECORRIDO </b>
						</div>
						<div class="col-8">
							<input type="search" name="route_desc" class="form-control" required />
						</div>
					</div>
					<div class="row backgroundFFF bordesDivBottom padding5px">
						<div class="col-4">
							<b>CONVENIOS </b>
						</div>
						<div class="col-8">
							<div class="row">
								<div class="col-4">
									<label for="type_cvn1">Convenio</label> <input type="radio" name="type_cvn" id="type_cvn1" value="1"/>
								</div>
								<div class="col-4">
									<label for="type_cvn2">Consorcio</label> <input type="radio" name="type_cvn" id="type_cvn2" value="2"/>
								</div>
								<div class="col-4">
									<label for="type_cvn3">Unión temporal</label> <input type="radio" name="type_cvn" id="type_cvn3" value="3"/>
								</div>
							</div>
						</div>
					</div>
					<div class="row background213C6C text-center bordesDivBottom padding5px">
						<div class="col-12">
							<b>VIGENCIA DEL CONTRATO </b>
						</div>
					</div>
					<div class="row backgroundFFF bordesDivBottom padding5px">
						<div class="col-3">
							<label for="type_cvn1"><b>FECHA INICIAL</b></label>
						</div>
						<div class="col-3">
							<input type="date" name="start" id="start" class="form-control font12px" value="<?php echo date('Y-m-d');?>"/>
						</div>
						<div class="col-3">
							<label for="type_cvn1"><b>FECHA VENCIMIENTO</b></label> 
						</div>
						<div class="col-3">
							<input type="date" name="end" id="end" class="form-control font12px" value="<?php echo date('Y-m-d');?>"/>
						</div>
					</div>
					<div class="row background213C6C text-center bordesDivBottom padding5px">
						<div class="col-12">
							<b>CARACTERÍSTICAS DEL VEHÍCULO </b>
						</div>
					</div>
					<div class="row backgroundFFF bordesDivBottom padding5px">
						<div class="table-responsive" id="responsevehiculo">
						</div>
						<script>
							$.ajax({
								data : {
									start : document.getElementById('start').value,
									end : document.getElementById('end').value,
									id : '<?php echo $_GET['id'];?>'
								},
								url:   'respuestavehiculo.php',
								type:  'POST',
								beforeSend: function () {
									$("#responsevehiculo").html("Procesando, espere por favor...");
								},
								success:  function (response){
									$("#responsevehiculo").html(response);
								}
							});
							$("#start, #end").change(function(){
								$.ajax({
									data : {
										start : document.getElementById('start').value,
										end : document.getElementById('end').value,
										id : '<?php echo $_GET['id'];?>'
									},
									url:   'respuestavehiculo.php',
									type:  'POST',
									beforeSend: function () {
										$("#responsevehiculo").html("Procesando, espere por favor...");
									},
									success:  function (response){
										$("#responsevehiculo").html(response);
									}
								});
							});
						</script>
					</div>
					<div class="row background213C6C text-center bordesDivBottom padding5px">
						<div class="col-12">
							<b>CONDUCTORES</b>
						</div>
					</div>
					<div class="row backgroundFFF bordesDivBottom padding5px">
						<div class="table-responsive" id="responseconductor">
						</div> 
						<script>
							$.ajax({
								data : {
									start : document.getElementById('start').value,
									end : document.getElementById('end').value,
									id : '<?php echo $_GET['id'];?>'
								},
								url:   'respuestaconductor.php',
								type:  'POST',
								beforeSend: function () {
									$("#responseconductor").html("Procesando, espere por favor...");
								},
								success:  function (response){
									$("#responseconductor").html(response);
								}
							});
							$("#start, #end").change(function(){
								$.ajax({
									data : {
										start : document.getElementById('start').value,
										end : document.getElementById('end').value,
										id : '<?php echo $_GET['id'];?>'
									},
									url:   'respuestaconductor.php',
									type:  'POST',
									beforeSend: function () {
										$("#responseconductor").html("Procesando, espere por favor...");
									},
									success:  function (response){
										$("#responseconductor").html(response);
									}
								});
							});
						</script>
					</div>
					<div class="row backgroundFFF bordesDivBottom padding5px">
						<div class="col-12 text-center">
							<input type="submit" class="btn btn-success" value="Guardar">
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
	<div class="clearfix"></div>
<?php
require_once 'footer.php';
?>
<script src="js/select2.min.js"></script>
<script>
	$('.select2').select2();
</script>