<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once 'header2.php';
require_once 'controller/test.php';
?>
<style>
    .evidencia {
        width: 100%;
        height: auto;
    } 
    #btn_print{
    position: fixed;
    bottom: 3em;
    right: 3em;
    z-index: 9; 
}  
</style>
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
                            <input type="text" class="search-input" placeholder="Type to search">
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
                                        user_test mockup
                                    </div>
                                    <div class="widget-subheading">
                                        SID: 99999999999
                                    </div>
                                </div>
                                <div class="widget-content-right header-user-info ml-3">
                                    <button type="button" class="btn-shadow p-1 btn btn-primary btn-sm show-toastr-example">
                                        <i class="fa text-white fa-calendar pr-1 pl-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>        </div>
            </div>
        </div>                
		<div class="app-main">
                <div class="app-sidebar sidebar-shadow">
                    <div class="app-header__logo">
                        <div class="logo">
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
                                    
                                    <a href="home.php?access_token=<?php echo $_GET['access_token'];?>&user_name=<?php echo $_GET['user_name']; ?>" class="mm-active">
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
                                        <i class="pe-7s-note2 icon-gradient bg-warm-flame">
                                        </i>
                                    </div>
                                    <div>Administrador de Notificaciones
                                        <div class="page-title-subheading">En el Código Nacional de Tránsito Terrestre o Ley 769 del 6 de agosto de 2002 se encuentran las disposiciones legales que rigen la actividad.
Es su deber conocer, aplicar y tener siempre presente este documento.
                                        </div>
                                    </div>
                                </div>
                                <div class="page-title-actions">
								</div>    
							</div>
                        </div>            
                        <div class="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="main-card mb-3 card">
                                        <div class="card-body">
											<h5 class="card-title">Panel Notificaciones</h5>
											
                                            
                                        </div>
                                        <div class="card-footer">
                                            <button type="button" data-toggle="collapse" aria-expanded="true" href="#collapseExample123" class="btn btn-primary">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="accordion" class="accordion-wrapper mb-3">
                                        <div class="card">
                                            <div id="headingOne" class="card-header">
                                                <button type="button" data-toggle="collapse" data-target="#collapseOne1" aria-expanded="true" aria-controls="collapseOne" class="text-left m-0 p-0 btn btn-link btn-block">
                                                    <h5 class="m-0 p-0">Configuracion</h5>
                                                </button>
                                            </div>
                                            <div data-parent="#accordion" id="collapseOne1" aria-labelledby="headingOne" class="collapse show">
                                                <div class="card-body">
                                                    <div class="main-card mb-3 card">
                                                        <div class="card-body">
                                                            <form class="">
                                                                <div class="position-relative form-group"><label for="exampleAddress" class="">Email 1</label><input name="address" id="exampleAddress" placeholder="usuario@servidor.com" type="email" class="form-control"></div>
                                                                <div class="position-relative form-group"><label for="exampleAddress2" class="">Email 2</label><input name="address2" id="exampleAddress2" placeholder="usuario@servidor.com" type="email" class="form-control">
                                                                <div class="position-relative form-group"><label for="exampleAddress3" class="">Email 3</label><input name="address3" id="exampleAddress3" placeholder="usuario@servidor.com" type="email" class="form-control">
                                                                </div>
                                                                <div class="position-relative form-group"><label for="exampleSelect" class="">Notificar cuando estado de alistamiento sea:  </label><select name="select" id="exampleSelect" class="form-control">
                                                                    <option>Con novedades</option>
                                                                    <option>Completo</option>
                                                                </select></div>
                                                                <div class="position-relative form-group"><label for="exampleText" class="">Mensaje</label><textarea name="text" id="exampleText" class="form-control"></textarea></div>
                                                                <div class="position-relative form-check"><input name="check" id="exampleCheck" type="checkbox" class="form-check-input"><label for="exampleCheck" class="form-check-label">WebApp</label></div>
                                                                <button class="mt-2 btn btn-primary">Guardar</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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

