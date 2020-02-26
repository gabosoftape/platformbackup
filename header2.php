<?php 
date_default_timezone_set('America/Bogota');
use Ang3\Component\Odoo\ExternalApiClient;
require __DIR__ . '/vendor/autoload.php';
session_start();
include 'config/conexion.php';
include 'config/odoo_server.php';
if(isset($_GET['user_name'])){
	$resultaccount = $mysqli->query("SELECT id, password FROM empresas WHERE user ='".$_GET['user_name']."' ");
	$rowaccount=mysqli_fetch_array($resultaccount);
	$client = new ExternalApiClient($server['url'], $server['db'], $server['username'], $server['password']);
	//$resultalistamientos = $client->searchAndRead("gpscontrol.alistamientos");
	 //because of true, it's in an array
	$curl = curl_init();
	$curl2 = curl_init();
	$username = $_GET['user_name'];
	$token = $_GET['access_token'];
	curl_setopt_array($curl, array(
	CURLOPT_URL => "https://hst-api.wialon.com/wialon/ajax.html?svc=token/login&params={%22token%22:%22".$_GET['access_token']."%22}",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => array(
		"cache-control: no-cache"
	),
	));
	$response = curl_exec($curl);
	$err = curl_error($curl);
	$res = json_decode($response, true);
	$sid = $res['eid'];
	curl_close($curl);
	curl_setopt_array($curl2, array(
	CURLOPT_URL => "https://hst-api.wialon.com/wialon/ajax.html?svc=core/search_items&params={%22spec%22:{%22itemsType%22:%22avl_unit%22,%22propName%22:%22trailers%22,%22propValueMask%22:%22%22,%22sortType%22:%22trailers%22,%22propType%22:%22propitemname%22},%22force%22:1,%22flags%22:1,%22from%22:0,%22to%22:0}&sid=".$sid."",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => array(
		"cache-control: no-cache"
	),
	));
	$response2 = curl_exec($curl2);
	$err2 = curl_error($curl2);
	$res2 = json_decode($response2, true);
	$vehiculos = $res2['items'];
	$enlistOknum = 0;
	$incompleteEnlist = 0;
	$alistamientos = [];
	$badenlistments = [];
	curl_close($curl2);

}
?>
<!doctype html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>GPScontrol</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="apple-touch-icon" href="/images/favicon.ico">
		<link rel="shortcut icon" href="images/favicon.ico">
		<link href="main.css" rel="stylesheet">
		<script type="text/javascript" src="assets/scripts/main.js"></script>
		<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
		<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
		<link href="https://cdn.fancygrid.com/fancy.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="https://csshake.surge.sh/csshake.min.css">
		<script src="https://cdn.fancygrid.com/fancy.min.js"></script>
		<script>
		Fancy.MODULESDIR="https://cdn.fancygrid.com/modules/";
		</script>

    <style>
        .fa-heart{
            color: #F74933;
        }   
        .space-100{
            height: 100px;
            display: block;
        }
        pre.prettyprint{
            background-color: #ffffff;
            border: 1px solid #999;
            margin-top: 20px;
            padding: 20px;
            text-align: left;
        }
        .atv, .str{
            color: #05AE0E;
        }
        .tag, .pln, .kwd{
             color: #3472F7;
        }
        .atn{
          color: #2C93FF;
        }
        .pln{
           color: #333;
        }
        .com{
            color: #999;
        } 
	</style>
    </head>
	<style>
		.active{
			background-color:#213C6C!important;
			color:#FFF !important;
		}
		.background213C6C{
			background-color:#00ff32!important;
			color:#FFF;
		}
		.backgroundFFF{
			background-color:#FFF!important;
			color:#213C6C !important;
		}
		.backgroundF8{
			background-color:#f8f8f8 !important;
			color:#213C6C !important;
		}
		.bordesDivBottom{border-bottom:1px solid #CCCCCC;}
		.colorDD2A1A{
			color:#DD2A1A;
		}
		.color213C6C{
			color:#213C6C;
		}
		.font10px{
			font-size:10px !important;
		}
		.font12px{
			font-size:12px !important;
		}
		.font20px{
			font-size:20px !important;
		}
		.font25px{
			font-size:25px !important;
		}
		.font35px{
			font-size:35px !important;
		}
		.mapboxgl-ctrl-logo, .mapboxgl-ctrl-bottom-right{
			display: none !important;
		}
		.marginLEFT2{
			margin-left: 2% !important;
		}
		.marginTop6{
			margin-top:6%;
		}
		.marginTop10{
			margin-top:10%;
		}
		.padding5px{
			padding:5px;
		}
		.padding1{
			padding:1%;
		}
		.padre {
			display: table;
			height: 100%;
		}
		.hijo {
			display: table-cell;
			vertical-align: middle;
		}
		.select2{
			width:100% !Important;
		}	
		.app-header{
			background: #000 !Important;
		}			
	</style>
	<script>
	$(document).ready( function () {
		$('#tabletest').DataTable();
	} );

	</script>
	<script type="text/javascript">
		function showContent() {
			element = document.getElementById("content");
			check = document.getElementById("check");
			if (check.checked) {
				element.style.display='block';
			}
			else {
				element.style.display='none';
			}
		}
	</script>
</head>