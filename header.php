<?php 
session_start();
include 'config/conexion.php';
if(isset($_GET['user_name'])){
	$resultaccount = $mysqli->query("SELECT id, password FROM empresas WHERE user ='".$_GET['user_name']."' ");
	$rowaccount=mysqli_fetch_array($resultaccount);
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
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">		
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"/>
		<link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
		<link rel="stylesheet" href="assets/css/style.css">
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
		<script type="text/javascript" src="https://hst-api.wialon.com/wsdk/script/wialon.js"></script>
		<meta http-equiv="cache-control" content="max-age=0" />
		<meta http-equiv="cache-control" content="no-cache" />
		<meta http-equiv="expires" content="0" />
		<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
		<meta http-equiv="pragma" content="no-cache" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


        <link href="css/entypo.css" rel="stylesheet">
     <link href="css/font-awesome.min.css" rel="stylesheet">
     <link href="css/bootstrap.min.css" rel="stylesheet">
     <link href="css/clevex-core.css" rel="stylesheet">
     <link href="css/clevex-forms.css" rel="stylesheet">
     <link href="css/plugins/scrollbar/perfect-scrollbar.css" rel="stylesheet">
     <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metismenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/blockui-master/jquery-ui.js"></script>
    <script src="js/plugins/blockui-master/jquery.blockUI.js"></script>
    <script src="js/plugins/big-slide/bigslide.min.js"></script>
    <script src="js/plugins/scrollbar/perfect-scrollbar.jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toggles/2.0.4/toggles.min.js"></script>        
    <script src="js/functions.js"></script>

    <link href="css/pe-icon-7-stroke.css" rel="stylesheet" />
	<link href="css/ct-navbar.css" rel="stylesheet" />  
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js"></script>

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
    </style>
</head>