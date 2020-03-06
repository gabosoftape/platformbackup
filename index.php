<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Iniciar sesion en wialon</title>
		<script type="text/javascript" src="//hst-api.wialon.com/wsdk/script/wialon.js"></script>
	</head>
	<body>
		<script type="text/javascript">
			var url = "http://tracking.gpscontrolcolombia.com/login.html"; 
			url += "?client_id=" + "GPS%20Control";	// your application name
			url += "&access_type=" + 0xFFFFFFFF;	// access level, 0x100 = "Online tracking only"
			url += "&activation_time=" + 0;	// activation time, 0 = immediately; you can pass any UNIX time value
			url += "&duration=" + 604800;	// duration, 604800 = one week in seconds
			url += "&flags=" + 0x1;			// options, 0x1 = add username in response
			url += "&tzOffset=" + -18000;			// "tzOffset":-134170192
			url += "&redirect_uri=https://gpscontrol.cf/enlistcontrol/bdvalidarlogin.php&css_url=https://gpscontrol.cf/enlistcontrol/css/login.css&title=gpscontrol&lang=es&cms_title=gpscontrol&demo_title=gpscontrol&callmode:create";
			// window.open(url); 
			location.href = url;
		</script>
	</body>
</html> 
