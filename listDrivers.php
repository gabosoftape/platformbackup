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
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                            <button type="button" tabindex="0" class="dropdown-item">User Account</button>
                                            <button type="button" tabindex="0" class="dropdown-item">Settings</button>
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <button onclick="window.location.href = 'logout.php';" type="button" tabindex="0" class="dropdown-item">Salir</button>
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
                    <div class="scrollbar-sidebar">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading"><p id="t_resumen">Resumen</p></li>
                                <li>
                                    
                                    <a href="home.php?access_token=<?php echo $_GET['access_token'];?>&user_name=<?php echo $_GET['user_name']; ?>" >
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
                                            <a class="mm-active" href="listDrivers.php?access_token=<?php echo $_GET['access_token'];?>&user_name=<?php echo $_GET['user_name']; ?>">
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
                </div>    <div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                        <img src="assets/icon/documentos-conductor.svg"  width="30" >
                                    </div>
                                    <div>Resumen Conductores
                                        <div class="page-title-subheading">Siempre antes de salir, realice una inspección pre-operacional a su vehículo.
                                            Es por su propio bienestar y por el de sus pasajeros. Recuerde: Ellos confían ciegamente en usted..
                                        </div>
                                    </div>
                                </div>
                                <div class="page-title-actions">
                                    
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
                                    <div class="card-header">Resumen Conductores
                                        <div class="btn-actions-pane-right">
                                            <div role="group" class="btn-group-sm btn-group">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tableAlistamientos" class="table-responsive">
                                        <table class="align-middle mb-0 table table-bordered table-striped table-hover">
                                        <?php
                                        $index = 0;
                                        if(count($drivers)>0){
                                        ?>
                                            <thead>
                                            <tr>
                                                <th class="text-center">Id Interno</th>
                                                <th>Conductor</th>
                                                <th class="text-center">Telefono</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                        $totaldrivers = array_values($drivers);
                                                        foreach($drivers as $conductor){
                                                            $nameDriver = $conductor['n'];
                                                            $imgResource = "http://hst-api.wialon.com/avl_driver_image/".$idCuenta."/".$conductor['id']."/200/1.png";
                                                        ?>
                                                <tr>
                                                <td class="text-center text-muted"><?php echo $conductor['id']; ?>
                                                </td>
                                                <td>
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <div class="widget-content-left">
                                                                    <img width="100" height="100" class="rounded-circle" src="<?php echo $imgResource;?>" alt="">
                                                                </div>
                                                            </div>
                                                            <div class="widget-content-left flex2">
                                                                <div class="widget-heading"><?php echo $nameDriver;?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center"><?php echo $conductor['p'];?></td>
                                                </tr>
                                            <?php
                                                }
                                            }else{
                                                ?>
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No se encontraron conductores.</th>
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
