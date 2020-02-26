<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once 'header2.php';
require_once 'controller/bdgetdata.php';
$resultaccount = $mysqli->query("SELECT id, user, password, razonsocial, tipodocumento, documento, telefono, celular, email, website, address, logo, firma, territorial_code, resolution_code, date_enabled FROM empresas WHERE user = '".$_GET['user_name']."' ");
$rowaccount = mysqli_fetch_array($resultaccount);
?>
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div class="logo-src">
                    <img src="assets/images/logo.png" alt="EnlistControlApp" width="185px">
                </div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>    
            <div class="app-header__content">
                <div class="app-header-left">
                    <div class="search-wrapper">
                        <div class="input-holder">
                            <input type="text" class="search-input" placeholder="Escribe algo para buscar">
                            <button class="search-icon"><span></span></button>
                        </div>
                        <button class="close"></button>
                    </div>       
                </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                            <img width="42" class="rounded-circle" src="../fuec/images/logos/<?php echo $rowaccount['logo'];?>" alt="">

                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right" style="background-color:#282828;">
                                            <button type="button" tabindex="0" class="dropdown-item" style="color: #dcdcdc;">User Account</button>
                                            <button type="button" tabindex="0" class="dropdown-item" style="color: #dcdcdc;">Settings</button>
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <button onclick="window.location.href = 'logout.php';" type="button" tabindex="0" class="dropdown-item" style="color: #dcdcdc;">Salir</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        <?php echo strtoupper($rowaccount['user']);?>
                                    </div>
                                    <div class="widget-subheading">
                                        SID: <?php echo $sid;?>
                                    </div>
                                </div>
                                <div class="widget-content-right header-user-info ml-3">
                                </div>
                            </div>
                        </div>
                    </div>        </div>
            </div>
        </div>        
       <div class="app-main">
                <div class="app-sidebar sidebar-shadow">
                    <div class="app-header__logo">
                        <div class="logo-src"></div>
                        <div class="header__pane ml-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="app-header__mobile-menu">
                        <div>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="app-header__menu">
                        <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
                    </div>    
                    <div class="scrollbar-sidebar">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading"><p id="t_resumen">Resumen</p></li>
                                <li>
                                    
                                    <a href="#" class="mm-active">
                                        <i class="metismenu-icon">
                                            <img src="assets/icon/alistamientos.svg"  width="17" >
                                        </i>
                                        
                                        Alistamientos
                                    </a>
                                </li>
                                <li class="app-sidebar__heading"><p id="t_recursos">Recursos</li>
                                <li>
                                    <a href="home.php" class="">
                                        <i class="metismenu-icon">
                                            <img src="assets/icon/soporte.svg"  width="17" >
                                        </i>
                                        Administracion
                                    </a>
                                    <ul>
                                         <li>
                                            <a class="" href="listUnits.php?access_token=<?php echo $_GET['access_token'];?>&user_name=<?php echo $_GET['user_name']; ?>">
                                                <i class="metismenu-icon"></i>
                                                Vehiculos
                                            </a>
                                        </li>
                                        <li>
                                            <a class="" href="listDrivers.php?access_token=<?php echo $_GET['access_token'];?>&user_name=<?php echo $_GET['user_name']; ?>">
                                                <i class="metismenu-icon">
                                                </i>Conductores
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="app-sidebar__heading"><p id="t_config">Configuracion</p></li>
                                <li>
                                    <a href="logout.php" class="">
                                        <i class="metismenu-icon">
                                            <img src="assets/icon/salir.svg"  width="17" >
                                        </i>
                                        <p id="t_salir">Salir</p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>    
                <div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                        <img src="assets/icon/historial.svg"  width="30" >
                                    </div>
                                    <div>Resumen de alistamientos
                                        <div class="page-title-subheading">Siempre antes de salir, realice una inspección pre-operacional a su vehículo.
                                            Es por su propio bienestar y por el de sus pasajeros. Recuerde: Ellos confían ciegamente en usted..
                                        </div>
                                    </div>
                                </div>
                                <div class="page-title-actions">
                                    
                                </div>    
                                </div>
                        </div>            
                        <div class="row">
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content bg-night-sky">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Alistamientos Totales</div>
                                            <div class="widget-subheading">Total de inspecciones realizadas</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers" style="color:#00ff32;"><span><?php echo count($alistamientos)?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content bg-night-sky">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Vehiculos</div>
                                            <div class="widget-subheading">Vehiculos Operacionales</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers " style="color:#00ff32" ><span><?php echo $res2['totalItemsCount']?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content bg-night-sky">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Alistamientos Satisfactorios</div>
                                            <div class="widget-subheading">Alistamientos sin novedades</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers " style="color:#00ff32"><span><?php echo $enlistOknum; ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <style>
                            #tableEnlistComponent{
                                background-color: #282828;
                            }
                        </style>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="tableEnlistComponent" class="main-card mb-3 card">
                                    <div class="card-header">Lista Alistamientos
                                        <div class="btn-actions-pane-right">
                                            <div role="group" class="btn-group-sm btn-group">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tableAlistamientos" class="table-responsive">
                                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <?php
                                        if(count($alistamientos)>0){
                                        ?>
                                            <thead>
                                            <tr>
                                                <th class="text-center">Fecha</th>
                                                <th>Conductor</th>
                                                <th class="text-center">Vehiculo</th>
                                                <th class="text-center">Estado</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    //resultfuec reeplace to resultenlistments
                                                    $resultenlistments = array_reverse($alistamientos);
                                                    $i=1;
                                                        foreach($resultenlistments as $alistamiento){
                                                            if($alistamiento['state']=="creado"){
                                                                $enlistOknum++;
                                                            }else {
                                                                $incompleteEnlist++;
                                                            }
                                                            $nameDriver = $alistamiento['partner_id'][1];
                                                            $driverindb = $mysqli->query("SELECT * FROM conductores WHERE nombre = '".$nameDriver."'");
                                                            $rowDriver=mysqli_fetch_array($driverindb);
                                                        ?>
                                                <tr>
                                                <td class="text-center text-muted"><?php 
                                                    $new_time = strtotime($alistamiento['fecha'] . "-5hours");
                                                    echo date("M , d, Y h:i:s A",$new_time);
                                                ?>
                                                </td>
                                                <td>
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <div class="widget-content-left">
                                                                    <img width="40" height="40" class="rounded-circle" src="http://<?php echo $rowDriver['img'];?>" alt="">
                                                                </div>
                                                            </div>
                                                            <div class="widget-content-left flex2">
                                                                <div class="widget-heading"><?php echo ($alistamiento['partner_id'][1]);?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center"><?php echo $alistamiento['vehiculo'][1];?></td>
                                                <td class="text-center">
                                                    <div class="badge badge-<?php echo($alistamiento['state']=='creado'?"success":"warning");?>"><?php echo($alistamiento['state']=='creado'?"Completado":"Con Novedades");?></div>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn mr-2 mb-2 btn-primary" onClick="window.location.href = 'enlistdesc.php?access_token=<?php echo $token;?>&user_name=<?php echo $username;?>&search=<?php echo $alistamiento['folio'];?>';" >Detalle</button>
                                                </td>
                                                </tr>
                                            <?php
                                                        
                                                $i++; 
                                                }
                                            }else{
                                                ?>
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No se encontraron alistamientos.</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                                <p></p>
                                                
                                            <?php
                                            }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-block text-center card-footer">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
        </div>
    </div>
<div class="clearfix"></div>
<?php
//my modal!!!!
?>
<div class="modal fade bd-example-modal-lg"  id="mymodalenlist" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" id="modalHeader">
                <div id="modalTitle"></div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalBody">
                
            </div>
            <div class="modal-footer" id="modalFooter">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Otra opcion</button>
            </div>
        </div>
    </div>
</div>
