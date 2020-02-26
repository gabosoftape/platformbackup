<?php 
require_once 'header.php';
$resultaccount = $mysqli->query("SELECT * FROM empresas WHERE id ='".$_GET['userid']."' ");
$rowaccount=mysqli_fetch_array($resultaccount); 
$empresaid=$_GET['userid'];
?>
<!-- Remember to include jQuery :) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

<div class="container">
    <div class="col-12 header" style=" background-color: #FFF !important; z-index: 0;">
		<img src="images/logo.png" alt="">
		<img class="align-content" src="https://www.supertransporte.gov.co/wp-content/uploads/2019/08/ministerio_1.png" alt="">
	</div>	
	<link rel="stylesheet" href="css/select2.min.css"/> 

		<!-- Estilos Carlos -->
		<style>
	#suggestions {
    box-shadow: 2px 2px 8px 0 rgba(0,0,0,.2);
    height: auto;
    position: absolute;
    top: 45px;
    z-index: 9;
    width: 900px; 
	}
 
	#suggestions .suggest-element {
    background-color: #EEEEEE;
    border-top: 1px solid #d6d4d4;
    cursor: pointer;
    padding: 8px;
    width: 100%;
    float: left;
	}
	</style>
	<!-- Fin Estilos Carlos -->
		<!-- Estilos Carlos -->
		<style>
	#suggestions2 {
    box-shadow: 2px 2px 8px 0 rgba(0,0,0,.2);
    height: auto;
    position: absolute;
    top: 45px;
    z-index: 9;
    width: 900px;
	}
 
	#suggestions2 .suggest-element2 {
    background-color: #EEEEEE;
    border-top: 1px solid #d6d4d4;
    cursor: pointer;
    padding: 8px;
    width: 100%;
    float: left;
	}

	#suggestions3 {
    box-shadow: 2px 2px 8px 0 rgba(0,0,0,.2);
    height: auto;
    position: absolute;
    top: 45px;
    z-index: 9;
    width: 900px;
	}

	#suggestions3 .suggest-element3 {
    background-color: #EEEEEE;
    border-top: 1px solid #d6d4d4;
    cursor: pointer;
    padding: 8px;
    width: 100%;
    float: left;
	}   

	#suggestions4 {
    box-shadow: 2px 2px 8px 0 rgba(0,0,0,.2);
    height: auto;
    position: absolute;
    top: 45px;
    z-index: 9;
    width: 900px;
	}

	#suggestions4 .suggest-element4 {
    background-color: #EEEEEE;
    border-top: 1px solid #d6d4d4;
    cursor: pointer;
    padding: 8px;
    width: 100%;
    float: left;
	}   	 
	</style>
	<!-- Fin Estilos Carlos -->	
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
		.modal a.close-modal {
			margin-top: 15px;
			margin-right: 15px;
		}
	</style>
<!--Scripts Carlos -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script>
$(document).ready(function() {
    $('#key').on('keyup', function() {
        var key = $(this).val();		
		var dataString = 'key='+key;
	$.ajax({
            type: "POST",
            url: "ajax.php",
            data: dataString,
            success: function(data) {
                //Escribimos las sugerencias que nos manda la consulta
                $('#suggestions').fadeIn(1000).html(data);
                //Al hacer click en alguna de las sugerencias
                $('.suggest-element').on('click', function(){
                        //Obtenemos la id unica de la sugerencia pulsada
                        var id = $(this).attr('id');
                        //Editamos el valor del input con data de la sugerencia pulsada
                        $('#key').val($('#'+id).attr('data'));
                        //Hacemos desaparecer el resto de sugerencias
                        $('#suggestions').fadeOut(1000);
                        swal('Has seleccionado el '+id+' ');
                        return false;
                });
            }
        });
    });
}); 
</script>
<!-- Fin Scripts Carlos -->

<!--Scripts Carlos -->
<script>
$(document).ready(function() {
    $('#responsable').on('keyup', function() {
        var responsable = $(this).val();		
        var dataString = 'responsable='+responsable;
	$.ajax({
            type: "POST",
            url: "ajax2.php",
            data: dataString,
            success: function(data) {
                //Escribimos las sugerencias que nos manda la consulta
                $('#suggestions2').fadeIn(1000).html(data);
                //Al hacer click en alguna de las sugerencias
                $('.suggest-element2').on('click', function(){
                        //Obtenemos la id unica de la sugerencia pulsada
                        var id = $(this).attr('id');
                        //Editamos el valor del input con data de la sugerencia pulsada
                        $('#responsable').val($('#'+id).attr('data'));
                        //Hacemos desaparecer el resto de sugerencias
                        $('#suggestions2').fadeOut(1000);
                        swal('Has seleccionado el '+id+' ');
                        return false;
                });
            }
        });
    });
}); 
</script>
<script>
function numeros(e){
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = " 0123456789";
        especiales = [8,37,39,46];
     
        tecla_especial = false
        for(var i in especiales){
     if(key == especiales[i]){
         tecla_especial = true;
         break;
            } 
        }
     
        if(letras.indexOf(tecla)==-1 && !tecla_especial)
            return false;
    }
</script>
<script>
$(document).ready(function() {
    $('#route').on('focus', function() {
        var route = $(this).val();		
        var dataString = 'route='+route;
	$.ajax({
            type: "POST",
            url: "ajax3.php",
            data: dataString,           
            success: function(data) {
                //Escribimos las sugerencias que nos manda la consulta
                $('#suggestions3').fadeIn(1000).html(data);
                //Al hacer click en alguna de las sugerencias
                $('.suggest-element3').on('click', function(){
                        //Obtenemos la id unica de la sugerencia pulsada
                        var id = $(this).attr('id');
                        //Editamos el valor del input con data de la sugerencia pulsada
                        $('#route').val($('#'+id).attr('data'));
                        //Hacemos desaparecer el resto de sugerencias
                        $('#suggestions3').fadeOut(1000);

                        return false;
                });
            }
        });
    });
}); 
</script>
<script>
$(document).ready(function() {
    $('#route_desc').on('focus', function() {
        var route_desc = $(this).val();		
        var dataString = 'route_desc='+route_desc;
	$.ajax({
            type: "POST",
            url: "ajax4.php",
            data: dataString,           
            success: function(data) {
                //Escribimos las sugerencias que nos manda la consulta
                $('#suggestions4').fadeIn(1000).html(data);
                //Al hacer click en alguna de las sugerencias
                $('.suggest-element4').on('click', function(){
                        //Obtenemos la id unica de la sugerencia pulsada
                        var id = $(this).attr('id');
                        //Editamos el valor del input con data de la sugerencia pulsada
                        $('#route_desc').val($('#'+id).attr('data'));
                        //Hacemos desaparecer el resto de sugerencias
                        $('#suggestions4').fadeOut(1000);

                        return false;
                });
            }
        });
    });
}); 
</script>
<!-- Fin Scripts Carlos -->
<!-- Inicio Menu con íconos Carlos -->  
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
	<form name="bdcrearfuec" action="drivers.php" method="POST" enctype="multipart/form-data">
		<div class="content" class="font11px" >
			<div class="row backgroundF8 animated fadeIn">
				<div class="col-12 text-center background213C6C"> 
					<label>FORMATO ÚNICO DE EXTRACTO DEL CONTRATO DEL SERVICIO PÚBLICO DE TRANSPORTE TERRESTRE AUTOMOTOR ESPECIAL</label>
					<h5><?php echo $rowcompany['territorial_code'];?><h5>
				</div>
				<div class="col-12 backgroundF8 font12px">
					<div class="row backgroundFFF bordesDivBottom padding5px">
						<div class="col-12">
							<b>CONTRATO No.</b>
							<input type="number" name="contratoid" onkeypress="return numeros(event)" class="form-control" value="" required />
						</div>
					</div>
					<div class="row backgroundFFF bordesDivBottom padding5px">
						<div class="col-2">
							<b>CONTRATISTA </b>
						</div>
						<!-- Desarrollo Carlos -->
						<div class="col-6">
							<form class="form-inline" method="post" action="#">
								<div class="input-group input-group-sm">
									<input class="search_query form-control" style="width:500px;z-index:0;" type="text" name="key" id="key" placeholder="Buscar contratista (Nombre de empresa, NIT ó nombre de contacto)." required>
									<input type="hidden" name="userid" value="<?php echo $_GET['userid'];?>" />
								</div>
							</form>
								<div id="suggestions"></div>
						</div>
						<!-- Fin Desarrollo -->
						<div class="col-4">
							<button type="button" class="btn btn-primary font12px">
								<a href="#myModalContratistaCrear" rel="modal:open" style="color:#FFF;">
									<i class="fas fa-plus-circle"></i> Crear contratista
								</a>
							</button>
						</div>
					</div>
					<div class="row marginTop1 marginbottom1">
						<div class="col-12 text-center" id="buscarcliente">
						</div>
					</div>
					<div class="row backgroundFFF bordesDivBottom padding5px">
						<div class="col-2">
							<b>RESPONSABLE </b>
						</div>
						<!-- Desarrollo Carlos -->
						<div class="col-6">
								<div class="input-group input-group-sm">
									<input class="search_query form-control" style="width:500px;z-index:0;" type="text" name="responsable" id="responsable" placeholder="Buscar responsable (Nombre de empresa, NIT ó nombre de contacto)." required>
								</div>
            
								<div id="suggestions2"></div>
						</div>
						<!-- Fin Desarrollo -->						
						<div class="col-4">
							<button type="button" class="btn btn-primary font12px">
								<a href="#myModalbuscardevrespo" rel="modal:open" style="color:#FFF;">
									<i class="fas fa-plus-circle"></i> Crear responsable
								</a>
							</button>
						</div>
					</div>
					<div class="row marginTop1 marginbottom1">
						<div class="col-12 text-center" id="buscardevrespo">
						</div>
					</div>
					<div class="row backgroundFFF bordesDivBottom padding5px">
						<div class="col-4">
							<b>OBJETO DEL CONTRATO </b>
						</div>
						<div class="col-8">
							<select name="objet_contract" class="form-control font12px" required >
								<option></option>
								<option value="1" class="font12px">Prestación de servicio de transporte de pasajeros y equipaje al grupo de usuarios y/o particulares</option>
								<option value="2" class="font12px">Prestación de servicio de transporte de pasajeros y equipaje al grupo de empleados, funcionarios o contratistas de una empresa</option>
							</select>
						</div>
					</div>
<!-- Codigo para rutas modificado -->
                    <div class="row backgroundFFF bordesDivBottom padding5px">
						<div class="col-2">
							<b>RUTA </b>
						</div>
						<!-- Desarrollo Carlos -->
						<div class="col-6">
                            <div class="input-group input-group-sm">
                                <input class="search_query form-control" style="width:500px;z-index:0;" type="text" name="route" id="route" placeholder="Escriba la ruta programada o cree una nueva" required>
                            </div>
        
                            <div id="suggestions3"></div>
						</div>
						<!-- Fin Desarrollo -->						
						<div class="col-4">
							<button type="button" class="btn btn-primary font12px">
								<a href="#myModalcrearuta" rel="modal:open" style="color:#FFF;">
									<i class="fas fa-plus-circle"></i> Crear Ruta
								</a>
							</button>
						</div>
					</div>

<!-- Fin rutas modificado -->
					<div class="row backgroundFFF bordesDivBottom padding5px">
						<div class="col-4">
							<b>DESCRIPCION DEL RECORRIDO </b>
						</div>
						<!-- Desarrollo Carlos -->
						<div class="col-6">
                            <div class="input-group input-group-sm">
                                <input class="search_query form-control" style="width:500px;z-index:0;" type="text" name="route_desc" id="route_desc" placeholder="Escriba la ruta programada" required>
                            </div>
        
                            <div id="suggestions4"></div>
						</div>
						<!-- Fin Desarrollo -->	
					</div>
					<div class="row backgroundFFF bordesDivBottom padding5px">
						<div class="col-2">
							<b>CONVENIOS </b>
						</div>
						<div class="col-10">
							<div class="row">
								<div class="col-3 text-center">
									<label for="type_cvn1">Convenio</label> <input type="radio" name="type_cvn" id="type_cvn1" class="form-control" value="1" required />
								</div>
								<div class="col-3 text-center">
									<label for="type_cvn2">Consorcio</label> <input type="radio" name="type_cvn" id="type_cvn2" class="form-control" value="2" required />
								</div>
								<div class="col-3 text-center">
									<label for="type_cvn3">Unión temporal</label> <input type="radio" name="type_cvn" id="type_cvn3" class="form-control" value="3" required />
								</div>
								<div class="col-3 text-center">
									<label for="type_cvn3">UT Con:</label> <input type="text" name="utcon" id="utcon" class="form-control" value="" />
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
							<input type="date" name="start" id="start" class="form-control font12px" value="<?php echo date('Y-m-d');?>" required />
						</div>
						<div class="col-3">
							<label for="type_cvn1"><b>FECHA VENCIMIENTO</b></label> 
						</div>
						<div class="col-3">
							<input type="date" name="end" id="end" class="form-control font12px" value="<?php echo date('Y-m-d');?>" required />
						</div>
					</div>
					
					<div class="row background213C6C text-center bordesDivBottom padding5px">
						<div class="col-12">
							<b>CARACTERÍSTICAS DEL VEHÍCULO </b>
						</div>
					</div>
					<div class="row">
						<div class="col-2">
							Vehículo:
							<select id="units" class="form-control" name="vehiculobuscar" id="vehiculobuscar" required>
								<option></option>
							</select>
						</div>
						<div class="col-2" id="placaselected"></div> 
						<div class="col-2" id="modeloselected"></div> 
						<div class="col-2" id="marcaselected"></div> 
						<div class="col-2" id="claseselected"></div> 
						<div class="col-2" id="soatselected"></div> 
						<div class="col-2" id="tecnoselected"></div>
						<div class="col-3" id="numero_internoselected"></div> 
						<div class="col-3" id="tarjetadeoperacion"></div> 
						<script>
							function init(){ 
								var sess = wialon.core.Session.getInstance();
								var flags = wialon.item.Item.dataFlag.base | wialon.item.Unit.dataFlag.lastMessage | 8388608 | wialon.item.Unit.dataFlag.maintenance | wialon.item.Unit.dataFlag.counters;
								sess.loadLibrary("itemIcon");
								sess.loadLibrary("itemProfileFields");
								sess.loadLibrary("unitEventRegistrar");
								sess.loadLibrary("unitServiceIntervals");
								sess.updateDataFlags(
								[{type: "type", data: "avl_unit", flags: flags, mode: 0}],
									function (code){ 
										var units = sess.getItems("avl_unit");
										for (var i = 0; i< units.length; i++){ 
											var u = units[i]; 
											$("#units").append("<option value='"+ u.getId() +"'>"+ u.getName()+ "</option>");
										}
										$('#units').select2().on('change', function(){
											init1vehiculo($('#units').val());
										});
									}
								);
							}
							function init1vehiculo(unitvalue){
								var sess = wialon.core.Session.getInstance();
								var unit = sess.getItem(unitvalue);
								var servs = unit.getProfileFields();
								var intervls = unit.getServiceIntervals();
								console.log(intervls);
								console.log(servs);
								 
								for(var i in servs){
									if(servs[ i ].n == "registration_plate" ){
										$("#placaselected").html("Placa: <input type='text' name='placa' id='placa' class='form-control' value='" + servs[ i ].v + "' readonly />" );
										break;
									}
									else{
										$("#placaselected").html("Placa: <input type='text' name='placa' id='placa' class='form-control' value='' readonly required />" );
									}
								}
								for(var i in servs){
									if(servs[ i ].n == "model"){
										$("#modeloselected").html("Modelo: <input type='text' name='modelo' id='modelo' class='form-control' value='" + servs[ i ].v + "' readonly />" );
										break;
									}
								}
								for(var i in servs){
									if(servs[ i ].n == "brand"){
										$("#marcaselected").html("Marca: <input type='text' name='marca' id='marca' class='form-control' value='" + servs[ i ].v + "' readonly />" );
										break;
									}
								}
								for(var i in servs){
									if(servs[ i ].n == "vehicle_type"){
										$("#claseselected").html("Clase: <input type='text' name='clase' id='clase' class='form-control' value='" + servs[ i ].v + "' readonly />" );
										break;
									}
								}
								for(var i in servs){
									if(servs[ i ].n == "vin"){
										$("#numero_internoselected").html("Número interno: <input type='text' name='numero_interno' id='numero_interno' class='form-control' value='" + servs[ i ].v + "' readonly />" );
										break;
									}
								}	
								for(var i in intervls){
									if(intervls[ i ].n.toLowerCase() == "soat"){
										var fechafincontrato = $(end).val().replace(',','/');	
										var fechafincontrato = $(end).val().replace(',','/');
										var fecha = new Date(timeConverter(intervls[ i ].pt));
										var dias = intervls[ i ].it;
										fecha.setDate(fecha.getDate() + dias);
										if(fechafincontrato > timeConverter1(fecha)){
											$('#bdcrearfuecbtn').prop("disabled", true);
											swal('la fecha del SOAT no es valida para el perido del contrato!');
											$("#soatselected").html("Soat: <input type='text' name='soatselected' id='soatselected' class='form-control' value='" + timeConverter1(fecha) +" NO CUMPLE' readonly style='border:2px solid red;' />" );
										}else{
											$('#bdcrearfuecbtn').prop("disabled", false);
											$("#soatselected").html("Soat: <input type='text' name='soatselected' id='soatselected' class='form-control' value='" + timeConverter1(fecha) + "' readonly />" );
										}
										break;
										
										
										
										
									}
								}
								for(var i in intervls){
									if(normalize(intervls[ i ].n).toLowerCase().replace(/ /g, "") == "tecnomecanica"){
										var fechafincontrato = $(end).val().replace(',','/');	
										var fechafincontrato = $(end).val().replace(',','/');
										var fecha = new Date(timeConverter(intervls[ i ].pt));
										var dias = intervls[ i ].it;
										fecha.setDate(fecha.getDate() + dias);
										if(fechafincontrato > timeConverter1(fecha)){
											$('#bdcrearfuecbtn').prop("disabled", true);
											swal('la fecha de la revisión Técno mecánica no es valida para el perido del contrato!');
											$("#tecnoselected").html("Técno mecánica: <input type='text' name='tecnomecanica' id='tecnomecanica' class='form-control' value='" + timeConverter1(fecha) +" NO CUMPLE' readonly style='border:2px solid red;' />" );
										}else{
											$('#bdcrearfuecbtn').prop("disabled", false);
											$("#tecnoselected").html("Técno mecánica: <input type='text' name='tecnomecanica' id='tecnomecanica' class='form-control' value='" + timeConverter1(fecha) + "' readonly />" );
										}
										break;
									}
								}
								for(var i in intervls){
									if(normalize(intervls[ i ].n).toLowerCase().replace(/ /g, "") == "tarjetadeoperacion"){ 
										var fechafincontrato = $(end).val().replace(',','/');	
										var fechafincontrato = $(end).val().replace(',','/');
										var fecha = new Date(timeConverter(intervls[ i ].pt));
										var dias = intervls[ i ].it;
										fecha.setDate(fecha.getDate() + dias);
										if(fechafincontrato > timeConverter1(fecha)){
											$('#bdcrearfuecbtn').prop("disabled", true);
											swal('la fecha de la tarjeta de operación no es valida para el perido del contrato!');
											$("#tarjetadeoperacion").html("Tarjeta de operación: <input type='text' name='tarjetadeoperacion' id='tarjetadeoperacion' class='form-control' value='" + timeConverter1(fecha) +" NO CUMPLE' readonly style='border:2px solid red;' />" );
										}else{
											$('#bdcrearfuecbtn').prop("disabled", false);
											$("#tarjetadeoperacion").html("Tarjeta de operación: <input type='text' name='tarjetadeoperacion' id='tarjetadeoperacion' class='form-control' value='" + intervls[ i ].t + "' readonly />" );
										}
										break; 
									}
								}
							}
							wialon.core.Session.getInstance().initSession("https://hst-api.wialon.com");
							wialon.core.Session.getInstance().loginToken("<?php echo $rowaccount['password']?>", "",
								function (code) { 
									if (code){ return; }
							});
							var normalize = (function() {
								var from = "ÃÀÁÄÂÈÉËÊÌÍÏÎÒÓÖÔÙÚÜÛãàáäâèéëêìíïîòóöôùúüûÑñÇç", 
								to   = "AAAAAEEEEIIIIOOOOUUUUaaaaaeeeeiiiioooouuuunncc",
								mapping = {};

								for(var i = 0, j = from.length; i < j; i++ )
									mapping[ from.charAt( i ) ] = to.charAt( i );

								return function( str ) {
									var ret = [];
									for( var i = 0, j = str.length; i < j; i++ ) {
										var c = str.charAt( i );
										if( mapping.hasOwnProperty( str.charAt( i ) ) )
										ret.push( mapping[ c ] );
										else
										ret.push( c );
									}      
									return ret.join( '' );
								}
							})();
							function timeConverter(UNIX_timestamp){
								var a = new Date(UNIX_timestamp * 1000);
								var months = ['01','02','03','04','05','06','07','08','09','10','11','12'];
								var year = a.getFullYear();
								var month = months[a.getMonth()];
								var date = a.getDate();
								var hour = a.getHours();
								var min = a.getMinutes();
								var sec = a.getSeconds();
								if(date < 10){
									date = '0' + a.getDate();
								}
								var time = year+'/'+ month+'/'+date;
								return time;
							}
							function timeConverter1(fecha){
								var months = ['01','02','03','04','05','06','07','08','09','10','11','12'];
								var year = fecha.getFullYear();
								var month = months[fecha.getMonth()];
								var date = fecha.getDate();
								if(date < 10){
									date = '0' + fecha.getDate();
								}
								var fecha = year+'/'+ month+'/'+date;
								return fecha;
							}
						</script>
					</div><br><br>

<!-- Inicio Firma -->
                    <div class="row background213C6C text-center bordesDivBottom padding5px">
						<div class="col-12">
							<b>FIRMA ACTUALMENTE AUTORIZADA </b>
						</div>
					</div>
                    <div class="col-6 text-center mt-1 mb-3">
                        <div class=row>
								<div class="padre text-center">
									<div class="hijo text-center">
										<img src="images/firmas/<?php echo $rowaccount['firma'];?>" style="width:300px;"> 
									</div>
									<input name="firma" hidden type="text" value="<?php echo $rowaccount['firma'];?>"/><br>               
                                </div>
							</div>
                        </div>    
<!-- Fin Firma -->


				</div>
			</div>
			<div class="row backgroundFFF bordesDivBottom padding5px">
				<div class="col-12 text-center">
					<input type="hidden" name="userid" value="<?php echo $_GET['userid'];?>" />
					<input type="submit" class="btn btn-success" id="bdcrearfuecbtn" value="Agregar conductores" />
				</div>
			</div>
		</div>
	</form>
	<div class="clearfix"></div>
	<div id="bdresponsecrearfuec"></div>
	<div class="modal" id="myModalContratistaCrear" style="max-width: 70%;">
		<h4>Crear contratista</h4>
		<form id="crearcontratistaform" class="mt-3">
			<div class="row form-group mt-3">
				<div class="col-3">
					Empresa 
				</div>
				<div class="col-3">
					<input type="text" name="empresa" id="empresa" class="form-control" />
				</div>
				<div class="col-3">
					NIT.
				</div>
				<div class="col-3">
					<input type="text" name="nit" id="nit" class="form-control" />
				</div>
			</div> 
			<div class="row form-group">
				<div class="col-3">
					Nombre de contacto
				</div>
				<div class="col-3">
					<input type="text" name="contacto" id="contacto" class="form-control"/>
				</div>
				<div class="col-3">
					Email
				</div>
				<div class="col-3">
					<input type="email" name="email" id="email" class="form-control" />
				</div>
			</div> 
			<div class="row form-group">
				<div class="col-3">
					Teléfono fijo
				</div>
				<div class="col-3">
					<input type="number" name="telfijo" id="telfijo" class="form-control" />
				</div>
				<div class="col-3">
					Celular
				</div>
				<div class="col-3">
					<input type="number" name="celular" id="celular" class="form-control" />
				</div>
			</div> 
			<div class="row form-group">
				<div class="col-3">
					Dirección
				</div>
				<div class="col-3">
					<input type="text" name="direccion" id="direccion" class="form-control" />
				</div>
				<div class="col-3">
					Ciudad
				</div>
				<div class="col-3">
					<select name="ciudadcontratista" id="ciudadcontratista" class="select2 form-control fontsize10" >
						<option value="" selected=""></option>
						<?php
						$resultciudad = $mysqli->query("SELECT idCiudad, nombre FROM ciudades ORDER BY nombre ASC");
						while($rowciudad=mysqli_fetch_array($resultciudad)){
							echo '<option  value="'.$rowciudad["idCiudad"].'">'.ucwords($rowciudad['nombre']).'</option>';
						}
						?>
					</select>
				</div>
			</div>
		</form>
		<div class="row form-group">
			<div class="col-12 text-center">
				<button class="btn btn-success" id="crearcontratistabtnotronombredeid">Crear</button>
			</div>
		</div> 
		<div id="responsecontratista" style="min-height:0px; max-height:200px; overflow:scroll;"></div>
		<script>
		$("#crearcontratistabtnotronombredeid").click(function(){
			var data = $('#crearcontratistaform').serializeArray(); 
			data.push({name:'userid', value:'<?php echo $_GET['userid'];?>'});
			$.ajax({
				data : data,
				url:   'controller/bdcrearcontratista.php',
				type:  'POST',
				beforeSend: function () {
					$("#responsecontratista").html("Processing, please wait...");
				},
				success:  function (response) {
					$("#responsecontratista").html(response);
				}
			});
		});
		</script>
	  </div>
	<div class="modal" id="myModalbuscardevrespo" style="max-width: 90%;position:relative;z-index:9999;">
		<h4 class="modal-title">Crear responsable</h4>
		<form id="crearresponsableform" class="mt-3">
			<div class="row form-group mt-3">
				<div class="col-3">
					Tipo Documento: 
				</div>
				<div class="col-3">
					<select name="empresa" id="empresa" class="form-control fontsize11" />
						<option value="CC">Cédula de ciudadania</option>
						<option value="CE">Cédula de extranjería</option>
						<option value="PS">Pasaporte</option>
					</select>
				</div>
				<div class="col-3">
					Documento:
				</div>
				<div class="col-3">
					<input type="text" name="nit" id="nit" class="form-control" />
				</div>
			</div>
			<div class="row form-group">
				<div class="col-3">
					Nombre de contacto
				</div>
				<div class="col-3">
					<input type="text" name="contacto" id="contacto" class="form-control"/>
				</div>
				<div class="col-3">
					Email
				</div>
				<div class="col-3">
					<input type="email" name="email" id="email" class="form-control" />
				</div>
			</div> 
			<div class="row form-group">
				<div class="col-3">
					Teléfono fijo
				</div>
				<div class="col-3">
					<input type="number" name="telfijo" id="telfijo" class="form-control" />
				</div>
				<div class="col-3">
					Celular
				</div>
				<div class="col-3">
					<input type="number" name="celular" id="celular" class="form-control" />
				</div>
			</div> 
			<div class="row form-group">
				<div class="col-3">
					Dirección
				</div>
				<div class="col-3">
					<input type="text" name="direccion" id="direccion" class="form-control" />
				</div>
				<div class="col-3">
					Ciudad
				</div>
				<div class="col-3">
					<select name="ciudadresponsable" id="ciudadresponsable" class="select2 form-control fontsize10" >
						<option value="" selected=""></option>
						<?php
						$resultciudad = $mysqli->query("SELECT idCiudad, nombre FROM ciudades ORDER BY nombre ASC");
						while($rowciudad=mysqli_fetch_array($resultciudad)){
							echo '<option  value="'.$rowciudad["idCiudad"].'">'.ucwords($rowciudad['nombre']).'</option>';
						}
						?>
					</select>
				</div>
			</div>
		</form>
		<div class="row form-group">
			<div class="col-12 text-center">
				<button class="btn btn-success" id="crearrsponsable">Crear responsable</button>
			</div>
		</div> 
		<div id="responseresponsable"></div>
		<script>
		$("#crearrsponsable").click(function(){
			var data = $('#crearresponsableform').serializeArray(); 
			data.push({name:'userid', value:'<?php echo $_GET['userid'];?>'});
			$.ajax({
				data : data,
				url:   'controller/bdcrearresponsable.php',
				type:  'POST',
				beforeSend: function () {
					$("#responseresponsable").html("Processing, please wait...");
				},
				success:  function (response) {
					$("#responseresponsable").html(response);
				}
			});
		});
		</script>
	</div>

<!-- Modal de creación de rutas -->

    <div id="myModalcrearuta" class="modal">
        <div class="modal-header">
            <h4 class="modal-title">Crear Ruta</h4>
        </div>
        <div class="modal-body col-md-12">
            
                <form class="form-horizontal" method="post" action="crea_ruta.php">
                    <div class="form-group">
				        <div class="col-md-12">
				        <input type="text" class="form-control" name="empresa" value="<?php echo $empresaid ?>" style="display:none;" >
                    </div>
                    <div class="form-group">
                    <label class="col-md-4 control-label">Contrato</label>
				        <div class="col-md-8">
				        <input type="number" class="form-control" name="contrato" placeholder="solo numeros, sin guiones ni espacios"><br>
                    </div>  
                    <label class="col-md-4 control-label">Ruta</label>
				        <div class="col-md-8">
				        <input type="text" class="form-control" name="ruta" placeholder="Especifique la ruta que seguira el vehiculo o"><br>
                    </div>  
                    <div class="form-group">
                        <label class="col-md-4 control-label">Detalle Ruta</label>
                        <div class="col-md-8">
                            <textarea rows="4" cols="30" name="detalle_ruta" placeholder="indique en detalle cual sera la ruta a seguir con el vehiculo, incluyendo la ruta de regreso"> </textarea>
                        </div>
                    </div>                                     
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
        </div>
	</div>

<!-- Modal de creación de rutas -->
<script src="js/select2.min.js"></script>
<script>
	$('.select2').select2();
	$(document).ready(function () {
		wialon.core.Session.getInstance().initSession("https://hst-api.wialon.com"); 
		wialon.core.Session.getInstance().loginToken("<?php echo $rowaccount['password']?>", "", 
			function (code) { 
				init();
		});
	});
</script>