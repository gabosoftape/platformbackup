<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Login</title>
		<script type="text/javascript" src="//code.jquery.com/jquery-latest.min.js"></script>
		<script type="text/javascript" src="//hst-api.wialon.com/wsdk/script/wialon.js"></script>
	</head>
	<body>
		<div id="log"></div>
		<script type="text/javascript">
			function msg(text) { 
				$("#log").prepend(text + "<br/>"); 
			}

			// Login to server using entered username and password
			var sess = wialon.core.Session.getInstance(); // get instance of current Session
			var user = sess.getCurrUser(); // get current User
				
			sess.initSession("https://hst-api.wialon.com"); // initialize Wialon session
			sess.loginToken("53dac8bfe1c32941e9a7b7121196dfe2AA6ED500FD61CA254D62F291C4BD35AFAB5405D8", "", // trying login 
				function (code) { // login callback
					if (code) msg(wialon.core.Errors.getErrorText(code)); // login failed, print error
					else msg("Logged successfully"); // login succeed
				}
			);
			
			var user = wialon.core.Session.getInstance().getCurrUser(); // get current user
			function obtenerValorParametro(sParametroNombre){
				var sPaginaURL = window.location.search.substring(1);
				 var sURLVariables = sPaginaURL.split('&');
				  for (var i = 0; i < sURLVariables.length; i++) {
					var sParametro = sURLVariables[i].split('=');
					if (sParametro[0] == sParametroNombre) {
					  return sParametro[1];
					}
				  }
				 return null;
			}
			var valor = obtenerValorParametro('user');
			if (valor){
				msg("usuario utilizado en la prueba: " +valor); // user not exists
			}
			if( user ) { // if user exists - you are already logged, print username to log
				msg("You are logged as '" + user.getName()+"', click logout button first");
			}
		</script>
	</body>
</html>