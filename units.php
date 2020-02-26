<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once 'header.php';
include 'config/conexion.php';
$resultaccount = $mysqli->query("SELECT user, password FROM empresas WHERE id = '".$_GET['userid']."' ");
$rowaccount=mysqli_fetch_array($resultaccount); 
?>
<link rel="stylesheet" href="css/select2.min.css"/>
<div class="container marginTop10">
	<div class="row">
		<div class="col-5">
			<div class="col-12">
				<label>Seleccioner vehículo</label>
			</div>
			<div class="col-12">
				<select class="form-control select2" id="units"><option></option></select><br/><br/>
				<div id="log"></div>
			</div>
		</div>
		<div class="col-7">
			<form id='bdeditarunidad'> 
				<div id='ubicationContent'>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	function msg(text) { 
		$("#log").prepend(text + "<br/>"); 
	}
	function init() { 
		var sess = wialon.core.Session.getInstance(); 
		var flags = wialon.item.Item.dataFlag.base | wialon.item.Unit.dataFlag.lastMessage;

		sess.loadLibrary("itemIcon"); 
		sess.updateDataFlags(
		[{type: "type", data: "avl_unit", flags: flags, mode: 0}],
			function (code){
				if(code){ 
					msg(wialon.core.Errors.getErrorText(code)); return; 
				}
				var units = sess.getItems("avl_unit");
				if (!units || !units.length){ 
					msg("Units not found"); 
					return; 
				}
				for (var i = 0; i< units.length; i++){ 
					var u = units[i];
					$("#units").append("<option value='"+ u.getId() +"'>"+ u.getName()+ "</option>");
				}
				$("#units").change(	
					getSelectedUnitInfo 
				);
			}
		);
	}
	function getSelectedUnitInfo(){ 
		var val = $("#units").val();
		if(!val){
			return;
		}
		var unit = wialon.core.Session.getInstance().getItem(val);
		if(!unit){ 
			msg("Unit not found");return; 
		}
		$('#log').empty();
		var text = "<div><h4><b>Unidad Seleccionada "+unit.getName()+" </b></h4><br/> ";
		var icon = unit.getIconUrl(32);
		if(icon) text = "<img class='icon' src='"+ icon +"' alt='icon'/><br/>"+ text;
		var pos = unit.getPosition();
		if(pos){ 
			var time = wialon.util.DateTime.formatTime(pos.t);
			text += "<b><br />Ultimo mensaje</b> "+ time +"<br/><br/>"+ 
				"<b>Posición</b> "+ pos.x+", "+pos.y +"<br/><br/>"+ 
				"<b>Velocidad</b> "+ pos.s;
			wialon.util.Gis.getLocations([{lon:pos.x, lat:pos.y}], function(code, address){ 
				if (code){ 
					msg(wialon.core.Errors.getErrorText(code)); return; 
				}
				msg(text + "<br/><br/><b>Ubicación</b>: "+ address+" 								</div> 								<br /><br /> 					<div style='display:none !important'>					"+	$.ajax({ 			data : { 				placaunit : unit.getName().replace(' ','').replace('.',''), userid : '<?php echo $_GET['userid']?>'			}, 			url:   'bdeditarunidad.php', 			type:  'POST', 			beforeSend: function () { 				$('#ubicationContent').html('Processing, please wait...')		}, 			success:  function (response) { 				$('#ubicationContent').html(response) 			} 		})+"</div>");
			});
			
		} 
		else{
			msg(text + "<br/><b>Ubicación</b>: Unknown</div>");
		}
	} 
	$(document).ready(function () {
		wialon.core.Session.getInstance().initSession("https://hst-api.wialon.com"); // init session
		// For more info about how to generate token check
		// http://sdk.wialon.com/playground/demo/app_auth_token
		wialon.core.Session.getInstance().loginToken("<?php echo $rowaccount['password']?>", "", // try to login
			function (code) { // login callback
				// if error code - print error message
				if (code){ msg(wialon.core.Errors.getErrorText(code)); return; }
				init(); // when login suceed then run init() function
		});
	});
</script>
<script src="js/select2.min.js"></script>
<script>
	$('.select2').select2();
</script>