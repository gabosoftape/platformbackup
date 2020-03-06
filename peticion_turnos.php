<?php 
include 'config/conexion.php';
require_once 'header.php';
?>

<div class="container" style="margin-top:15% !important;">
	<div class="row">
		<div class="col-12">
			<?php
			$resultunidades = $mysqli->query("SELECT unitid, unitvalue FROM drivers_units");
			while($rowunidades = mysqli_fetch_array($resultunidades)){
				?>
				<div id="response<?php echo $rowunidades["unitvalue"]?>"></div>
				<script>
						$.ajax({
							data : {
								id_res : 15136513,
								id_unit : '<?php echo $rowunidades["unitvalue"]?>',
								unitid : '<?php echo $rowunidades["unitid"]?>'
							},
							url:   'turnos_junio.php',
							type:  'POST',
							beforeSend: function () {
								$("#response<?php echo $rowunidades['unitvalue']?>").html("Processing, please wait...");
							},
							success:  function (response) {
								$("#response<?php echo $rowunidades['unitvalue']?>").html(response);
							}
						});
				</script>
				<?php 
			}
			?>
		</div>
	</div>
</div> 
<script>
	$(document).ready(function () {
		wialon.core.Session.getInstance().initSession("https://hst-api.wialon.com"); 
		wialon.core.Session.getInstance().loginToken("df55b9c1f05f51d44224c6b85cb2bc901FCB6B7332715D1159258F41BCBC44C8D5EFD90D", "", 
			function (code){ 
				if (code){ msg(wialon.core.Errors.getErrorText(code)); return; }
		});
	});
</script>