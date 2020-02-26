<?php
require_once 'header.php';
?>
<div class="sufee-login d-flex align-content-center flex-wrap">
	<div class="container marginTop3">
		<div class="login-content">
			<div class="login-logo">
				<a href="index.html">
					<img class="align-content" src="images/logo.png" alt="">
				</a>
			</div>
			<div class="login-form text-center" style="margin-top:-3%;">
				<h6>INGRESE SUS CONTRASEÑA PARA COMPLETAR EL REGISTRO</h6>
				<br /><br />
				<form action="controller/setpass.php" name="bdvalidarlogin" method="POST">
					<div class="form-group marginTop1">
						<input type="password" name="password" class="form-control" placeholder="Password" required />
					</div>
					<div class="form-group">
						<input type="password" name="passwordconfirm" class="form-control" placeholder="Confirm Password" required />
						<input type="hidden" name="us"  value="<?php echo $_GET['us']?>" />
					</div>
					<input type="submit" class="btn btn-primary btn-flat m-b-20 m-t-20" value="Iniciar Sesión" />
				</form>
			</div>
		</div>
		<!--
		<div class="col-12 text-center">
			<img src="images/home.png" style="max-width: 65% !important; margin-top: -5%;"/>
		</div>
		-->
	</div>
</div>
<?php
require_once 'footer.php';
?>
