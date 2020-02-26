<?php 
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
//subida de archivo firma si se hiciera una a una, recordar cambiar el tipo de campo de text a file
/*	$ruta='firmas';
    $usuario=$_POST['userid'];
    $uploadedfile=$_POST['uploadedfile'];
    $uploadedfileload="true";
    $uploadedfile_size=$_FILES[uploadedfile][size];
    //echo $_FILES[uploadedfile][name];
    //echo $uploadedfile;
    $file_name=$_FILES[uploadedfile][name];
    $add="images/firmas/$file_name";


    move_uploaded_file ($_FILES[uploadedfile][tmp_name], $add);
*/
    //echo " Ha sido subido satisfactoriamente";

  
    //echo $propiedad;
    //$inmuebles="UPDATE empresas SET firma='$file_name' WHERE id='$usuario'";
    //$resultado=$mysqli->query($inmuebles);
    //echo $inmuebles;




require_once 'header.php';
$resultaccount = $mysqli->query("SELECT user, password FROM empresas WHERE id ='".$_POST['userid']."' ");
$rowaccount=mysqli_fetch_array($resultaccount);
$resultfuec = $mysqli->query("SELECT id FROM fuec WHERE contratoid ='".$_POST['contratoid']."' ");
$rowfuec=mysqli_fetch_array($resultfuec);
$contratista=$_POST['key'];
$responsable=$_POST['responsable'];
//echo $contratista;
//echo $responsable; 
$firma=$_POST['firma'];




//condicional innecesaria debido a que un fuec despues de expedido no se puede editar
//if($rowfuec['id'] == NULL){
    $mysqli->query("INSERT INTO fuec(contratoid, userid, contratistaid, responsableid, objet_contract, route, route_desc, type_cvn, utcon, start, end, vehiculo, placa, marca, modelo, motor, linea, soat, tecnomecanica, numero_interno, numero_operacion, firma, fecha) VALUES ('".$_POST['contratoid']."', '".$_POST['userid']."', '".$_POST['key']."', '".$_POST['responsable']."', '".$_POST['objet_contract']."', '".$_POST['route']."', '".$_POST['route_desc']."', '".$_POST['type_cvn']."', '".$_POST['utcon']."', '".$_POST['start']."', '".$_POST['end']."', '".$_POST['vehiculo']."', '".$_POST['placa']."', '".$_POST['marca']."', '".$_POST['modelo']."', '".$_POST['motor']."', '".$_POST['clase']."', '".$_POST['soat']."', '".$_POST['tecnomecanica']."', '".$_POST['numero_interno']."', '".$_POST['tarjetadeoperacion']."', '".$_POST['firma']."', '".date('Y-m-d')."') ");
    //$mysqli->query("INSERT INTO empresas(firma) VALUES ('".$_FILES[uploadedfile][name]."') WHERE id ='".$_POST['userid']."'");
    //$mysqli->query("UPDATE empresas SET firma = '".$_FILES[uploadedfile][name]."'  WHERE id ='".$_POST['userid']."' ");
//}
/*else{
	$mysqli->query("UPDATE fuec SET userid =  '".$_POST['userid']."', contratistaid =  '".$_POST['key']."', responsableid =  '".$_POST['responsable']."', objet_contract =  '".$_POST['objet_contract']."', route =  '".$_POST['route']."', route_desc =  '".$_POST['route_desc']."', type_cvn = '".$_POST['type_cvn']."', utcon = '".$_POST['utcon']."', start =  '".$_POST['start']."', end =  '".$_POST['end']."', vehiculo =  '".$_POST['vehiculo']."', conductor =  '".$_POST['conductor']."', placa =  '".$_POST['placa']."', marca =  '".$_POST['marca']."', modelo =  '".$_POST['modelo']."', motor =  '".$_POST['motor']."', linea =  '".$_POST['clase']."', soat =  '".$_POST['soat']."', tecnomecanica =  '".$_POST['tecnomecanica']."', numero_interno =  '".$_POST['numero_interno']."', numero_operacion = '".$_POST['tarjetadeoperacion']."', firma = '".$_FILES[uploadedfile][name]."', fecha = '".$_POST['uploadedfile']."' WHERE contratoid =  '".$_POST['contratoid']."' ");
}*/




?>
<style>
	.select2{
		width:100% !Important;
		display: block;
		width: 100%;
		height: calc(2.25rem + 2px) !important; 
		padding: .375rem .75rem;
		line-height: 1.5;
		color: #495057;
		background-color: #fff;
		background-clip: padding-box !important;
		border: 1px solid #ced4da !important;
		border-radius: .25rem !important;
		transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
		font-size:12px !important;
	}
	.select2-container--default .select2-selection--single {
		border: 0px solid #fff !important;
		font-size:12px !important;
	}
	input, .font11px{
		font-size:11px !important;
	}
	.navbargps{
		-webkit-appearance: meter !important; 
		background-color:#1D2C65 !important; 
		color:#ffffff;
	}
	.navbar .navbar-nav li > a {
		line-height: 0px !important;
		padding: 10px !important;
	}
</style>
<div class="container">
    <div class="col-12 header" style=" background-color: #FFF !important; z-index: 9;">
		<img src="images/logo.png" alt="">
		<img class="align-content" src="images/mintransporte.png" alt="">
	</div>	

<div class="container">
	<link rel="stylesheet" href="css/select2.min.css"/>
	<script type="text/javascript" src="//code.jquery.com/jquery-latest.min.js"></script>
	<script type="text/javascript" src="//hst-api.wialon.com/wsdk/script/wialon.js"></script>
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
                    <a href="home.php?user_name=<?php echo $rowaccount['user']?>&userid=<?php echo $_GET['userid'];?>" data-toggle="search">
                        <i class="pe-7s-home"></i>
                        <p>Inicio</p>
                    </a>
                </li>
                <li class="nav-item col-md-3 col-sm-3">
                    <a href="#" style="color:#fff !important;background-color: #1D2C65 !important;">
                        <i class="pe-7s-id"></i>
                        <p>FUEC</p>
                    </a>
                </li>                 
                <li class="nav-item col-md-3 col-sm-3">
                    <a href="consultarfuec.php?userid=<?php echo $_GET['userid'];?>" data-toggle="search">
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

<!-- Fin Menu con íconos Carlos -->    
	<div id="base" class="mt-3">
		<div class="row" id="driver_data">
			<div class="col-1 mt-3">
				<b>Cuenta:</b>
			</div>
			<div class="col-5 mt-3">
				<select id="resource" name="resource" required class="form-control select2 font12px"><option value="">--  --</option></select>
			</div>
			<div class="col-1 mt-3">
				<b>Recurso:</b>
			</div>
			<div class="col-5 mt-3">
				<select id="drivers" name="drivers" required class="form-control select2 font12px"><option value="">--  --</option></select>
			</div>
			<div class="col-12 mt-3">
				<form id="formdriverfuec" name="formdriverfuec">
					<div claSS="row">
						<div class="col-3 font11px" id="n"></div> 
						<div class="col-3 font11px" id="cedula"></div> 
						<div class="col-3 font11px" id="nolicencia"></div> 
						<div class="col-3 font11px" id="licencia"></div> 
					</div>
				</form>
			</div>
		</div>	
		<div class="row text-center mt-3">
			<div class="col-6 text-center">
				 <a href="#"> <input type="button" class="btn btn-primary" value="agregar conductor" id="adddriver"/> </a>
			</div>	
			<div class="col-6 text-center mt-3" style="display:none;" id="finalizarconsultar">
				<a href="#"> 
					<form action="consultarfuec.php" name="crearfuec" method="POST">
						<input type="hidden" name="userid" value="<?php echo $_POST['userid'];?>" /> 
						<input type="submit" class="btn btn-success" id="finalizar" value="finalizar y consultar" />
					</form>
				</a>
			</div>	
		</div>	
	</div>
	<div id="base1"></div>
	<input type="hidden" name="fechafincontrato" id="fechafincontrato" value="<?php echo $_POST['end']?>">
	<script>
	$("#adddriver").click(function(){
		var data = $('#formdriverfuec').serializeArray(); 
		data.push({name:'contratoid', value:'<?php echo $_POST['contratoid'];?>'});
		$.ajax({
			data : data,
			url:   'adddriverfuec.php',
			type:  'POST',
			beforeSend: function () {
				$("#base1").html("Processing, please wait...");
			},
			success:  function (response) {
				$("#base1").html(response);
			}
		});
		$('#finalizarconsultar').show('fast');
	});
	var createDriver = {
		init: function () {
			var self = this;
			this.res = null;
			this.sess = wialon.core.Session.getInstance();
			this.sess.loadLibrary("resourceDrivers");
			this.getResurse();
			this.addEventListeners();
		},
		addEventListeners: function(){
			var self = this;
			$('#resource').on('change', function(){
				self.getDrivers();	
			});
			$('#drivers').on('change', function(){
				self.getDriverInfo();	
			});
		},
		resetForm: function(){
			this.curRes = null;
			$('#drivers').html('<option value="">-- --</option>');
			$('#driver_data input[type="text"], #drivers').val('');
		},
		getResurse: function(){
			var self = this;
			var flags =  wialon.util.Number.or(wialon.item.Item.dataFlag.base, wialon.item.Resource.dataFlag.drivers, wialon.item.Resource.dataFlag.driverUnits);
			this.sess.updateDataFlags(
				[{type: "type", data: "avl_resource", flags: flags, mode: 0}],
				function (code){ 
					if (code) {
						self.log("Error: "+wialon.core.Errors.getErrorText(code));
						return; 
					}
					var ress = self.sess.getItems("avl_resource");
					$('#resource').html('<option value="">--  --</option>');	
					for (var i = 0; i < ress.length; i++) {
						$('#resource').append('<option value="'+ ress[i].getId() +'">'+ ress[i].getName() +'</option>');
					}
				});
		},
		getDrivers: function(){
			var self = this;
			this.resId = $('#resource').val();

			if (!this.resId) {
				this.resetForm();
				return;
			}
		  
			var $drivers = $('#drivers');     	
			if (!this.resId) {
			  $drivers.val('');
			  return;
			}
			this.curRes = this.sess.getItem( this.resId );
			var drivers  = this.sess.getItem( this.resId ).getDrivers()
			$drivers.html('<option value="">-- --</option>');	
			for (var i in drivers) {
			  $drivers.append('<option value="'+ drivers[i].id +'">'+ drivers[i].n +'</option>');
			}
		},
		getDriverInfo: function(){
			var driverId = $('#drivers').val();
			if ( !driverId ) {
				this.resetForm();
				return;
			}
			if ( !driverId ) return;
			var driver  = this.curRes.getDriver( driverId );			
			$("#n").html("Nombre: <input type='text' name='n' id='n' class='form-control' value='" + driver.n + "' readonly />" );
			if(typeof driver.jp.nolicencia == 'undefined' ){
				$('#finalizar, #adddriver').prop("disabled", true);
				alert('El Número de cédula no es valido para el perido del contrato!');
				$("#cedula").html("Cédula: <input type='text' name='cedula' id='cedula' class='form-control' value='" + driver.jp.cedula + "' readonly style='border:2px solid red;' readonly />" );
			}
			else{
				$('#finalizar, #adddriver').prop("disabled", false);
				$("#cedula").html("Cédula: <input type='text' name='cedula' id='cedula' class='form-control' value='" + driver.jp.cedula + "' readonly />" );
			}
			if(typeof driver.jp.nolicencia == 'undefined' ){
				$('#finalizar, #adddriver').prop("disabled", true);
				alert('El Número de licencia no es valida para el perido del contrato!');
				$("#nolicencia").html("Número de licencia: <input type='text' name='nolicencia' id='nolicencia' class='form-control' value='" + driver.jp.nolicencia + "' readonly style='border:2px solid red;' readonly />" );
			}
			else{
				$('#finalizar, #adddriver').prop("disabled", false);
				$("#nolicencia").html("Número de licencia: <input type='text' name='nolicencia' id='nolicencia' class='form-control' value='" + driver.jp.nolicencia + "' readonly />" );
			}
			if(fechafincontrato.value > driver.jp.licencia || typeof driver.jp.licencia == 'undefined' ){
				$('#finalizar, #adddriver').prop("disabled", true);
				alert('la fecha de la licencia de conducción no es valida para el perido del contrato!');
				$("#licencia").html("Vencimiento licencia: <input type='text' name='licencia' id='licencia' class='form-control' value='" + driver.jp.licencia + "' readonly style='border:2px solid red;' readonly />" );
			}
			else{
				$('#finalizar, #adddriver').prop("disabled", false);
				$("#licencia").html("Vencimiento licencia: <input type='text' name='licencia' id='licencia' class='form-control' value='" + driver.jp.licencia + "' readonly />" );
			}
		}
	};
	$(document).ready(function () {			 
		wialon.core.Session.getInstance().initSession("https://hst-api.wialon.com");
		wialon.core.Session.getInstance().loginToken("<?php echo $rowaccount['password'];?>", "", 
		function (code) {
			if (code){
				createDriver.log(wialon.core.Errors.getErrorText(code));
				return; 
			}
			createDriver.init();
		});
	});
	</script>
</div>
<script src="js/select2.min.js"></script>
<script>
	$('.select2').select2();
</script>