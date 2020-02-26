<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
session_start();
include 'config/conexion.php';
?>
<!doctype html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>GPScontrol</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="apple-touch-icon" href="/images/favicon.ico">
		<link rel="shortcut icon" href="images/favicon.ico">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">		
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
		<link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
		<link rel="stylesheet" href="assets/css/style.css">
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
		<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
		<script src="js/main.js"></script>
		<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.53.1/mapbox-gl.js'></script>
		<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.53.1/mapbox-gl.css' rel='stylesheet' />
	</head>
	<style>
		.active{
			background-color:#213C6C!important;
			color:#FFF !important;
		}
		.background213C6C{
			background-color:#213C6C!important;
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
		.colorFFF{
			color:#FFF !important;
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
		.marginTop3{
			margin-top:3% !important;
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
    </style>
	<body>
		<div class="col-12 header" style="position: fixed; background-color: #FFF !important; z-index: 9;">
			<a class="navbar-brand" href="/fuec/home.php">
				<img src="images/logo.png" alt="">
				<img class="align-content" src="images/mintransporte.png" alt="">
			</a>
			<nav class="col-12 navbar navbar-expand-lg  navbar-light background213C6C">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link colorFFF" href="home.php"><i class="fas fa-ellipsis-v"></i> INICIO</a>
					</li>
					<li class="nav-item">
						
					</li>
					<li class="nav-item">
						
					</li>
					<li class="nav-item text-right">
						<a class="nav-link colorFFF" href="logout.php"><i class="fas fa-ellipsis-v"></i> SALIR</a>
					</li>
				</ul>
			</nav>
		</div>
		