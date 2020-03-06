<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once 'header2.php';
require_once 'controller/bdgetdata.php';
$resultaccount = $mysqli->query("SELECT id, user, password, razonsocial, tipodocumento, documento, telefono, celular, email, website, address, logo, firma, territorial_code, resolution_code, date_enabled FROM empresas WHERE user = '".$_GET['user_name']."' ");
$rowaccount = mysqli_fetch_array($resultaccount);
$folio = $_GET['search'];
$selectAlis;
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
<div id="btn_print" class="shake-constant shake-constant--hover shake-chunk ">
    <a href="report.php?access_token=<?php echo $token;?>&user_name=<?php echo $username;?>&search=<?php echo $folio;?>">
        <img border="0" alt="Imprimir" src="assets/images/print.png" width="70">
    </a>
</div>
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
                                        <?php echo strtoupper($rowaccount['user']);?>
                                    </div>
                                    <div class="widget-subheading">
                                        SID: <?php echo $sid;?>
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
                                        <p id="t_salir">Notificaciones</p>
                                    </a>
                                </li>
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
                                    <div>Alistamiento <?php echo $folio;?>
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
											<h5 class="card-title">Informacion General</h5>
											<?php
												foreach($alistamientosValidos as $alistamiento){
													if ($alistamiento['folio']==$folio){
														$selectAlis = $alistamiento;
													}
                                                }
                                                $oknum = 0;
                                                $notoknum = 0;
                                                $selectAlis['documentos_vehiculo']==false?$notoknum++:$oknum++;
                                                $selectAlis['documentos_conductor']==false?$notoknum++:$oknum++;
                                                $selectAlis['calcomania']==false?$notoknum++:$oknum++;
                                                $selectAlis['aire']==false?$notoknum++:$oknum++;
                                                $selectAlis['aseo']==false?$notoknum++:$oknum++;
                                                $selectAlis['baterias']==false?$notoknum++:$oknum++;
                                                $selectAlis['botiquin']==false?$notoknum++:$oknum++;
                                                $selectAlis['celular']==false?$notoknum++:$oknum++;
                                                $selectAlis['cinturones']==false?$notoknum++:$oknum++;
                                                $selectAlis['disp_velocidad']==false?$notoknum++:$oknum++;
                                                $selectAlis['equipo_carretera']==false?$notoknum++:$oknum++;
                                                $selectAlis['estado_esc_p_conductor']==false?$notoknum++:$oknum++;
                                                $selectAlis['estado_esc_p_pasajero']==false?$notoknum++:$oknum++;
                                                $selectAlis['extintor']==false?$notoknum++:$oknum++;
                                                $selectAlis['filtros']==false?$notoknum++:$oknum++;
                                                $selectAlis['frenos']==false?$notoknum++:$oknum++;
                                                $selectAlis['frenos_emergencia']==false?$notoknum++:$oknum++;
                                                $selectAlis['herramientas']==false?$notoknum++:$oknum++;
                                                $selectAlis['linterna']==false?$notoknum++:$oknum++;
                                                $selectAlis['llantas']==false?$notoknum++:$oknum++;
                                                $selectAlis['luces']==false?$notoknum++:$oknum++;
                                                $selectAlis['motor']==false?$notoknum++:$oknum++;
                                                $selectAlis['niveles']==false?$notoknum++:$oknum++;
                                                $selectAlis['parabrisas']==false?$notoknum++:$oknum++;
                                                $selectAlis['pito']==false?$notoknum++:$oknum++;
                                                $selectAlis['repuesto']==false?$notoknum++:$oknum++;
                                                $selectAlis['retrovisores']==false?$notoknum++:$oknum++;
                                                $selectAlis['ruteros']==false?$notoknum++:$oknum++;
                                                $selectAlis['silla_conductor']==false?$notoknum++:$oknum++;
                                                $selectAlis['silleteria']==false?$notoknum++:$oknum++;
                                                $selectAlis['tapas']==false?$notoknum++:$oknum++;
                                                $selectAlis['tension']==false?$notoknum++:$oknum++;
                                                $selectAlis['transmision']==false?$notoknum++:$oknum++;
											?>
                                            <div class="collapse show" id="collapseExample123">
                                                <p><strong>Fecha y Hora: </strong><em><?php echo $selectAlis['fecha'];?></em></p>
												<p><strong>Folio: </strong><em><?php echo $selectAlis['folio'];?></em></p>
												<p><strong>Conductor: </strong><em><?php echo $selectAlis['partner_id'][1];?></em></p>
												<p><strong>Vehiculo: </strong><em><?php echo $selectAlis['vehiculo'][1];?></em></p>
												<div id="accordionResume" class="accordion-wrapper mb-3">
                                                    <div class="card">
														<div id="headingTwo" class="b-radius-0 card-header">
															<button type="button" data-toggle="collapse" data-target="#collapseResume2" aria-expanded="true" aria-controls="collapseTwo" class="text-left m-0 p-0 btn btn-link btn-block">
																<h5 class="m-0 p-0">Novedades <span class="badge badge-pill badge-warning"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $notoknum;?></font></font></span></h5>
                                                                
															</button>
														</div>
														<div data-parent="#accordionResume" id="collapseResume2" class="collapse show">
															<div class="card-body">
																<p class="mb-3"><?php echo ($selectAlis['documentos_vehiculo']==false?"Documentos del vehiculo":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['documentos_conductor']==false?"Documentos del conductor":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['calcomania']==false?"Calcomania como conduzco":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['aire']==false?"Aire":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['aseo']==false?"Aseo":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['baterias']==false?"Bateria y ..":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['botiquin']==false?"Botiquin":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['celular']==false?"Celular con minutos":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['cinturones']==false?"Cinturones":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['disp_velocidad']==false?"Dispositivo de velocidad":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['equipo_carretera']==false?"Equipo de carretera":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['estado_esc_p_conductor']==false?"Estado escalera puerta conductor":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['estado_esc_p_pasajero']==false?"Estado escalera puerta pasajero":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['extintor']==false?"Extintor":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['filtros']==false?"Filtros":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['frenos']==false?"Frenos":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['frenos_emergencia']==false?"Frenos de emergencia":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['herramientas']==false?"Herramientas":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['linterna']==false?"Linterna":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['llantas']==false?"Llantas":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['luces']==false?"Luces":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['motor']==false?"Motor":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['niveles']==false?"Niveles":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['parabrisas']==false?"Parabrisas":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['pito']==false?"Pito":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['repuesto']==false?"Repuesto":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['retrovisores']==false?"Espejos retrovisores":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['ruteros']==false?"Ruteros":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['silla_conductor']==false?"Silla conductor":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['silleteria']==false?"Silleteria general":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['tapas']==false?"Tapas":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['tension']==false?"Tension de correas":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['transmision']==false?"Transmision":"");?></p>
															</div>
														</div>
													</div>
													<div class="card">
														<div id="headingOne" class="card-header">
															<button type="button" data-toggle="collapse" data-target="#collapseResume1" aria-expanded="false" aria-controls="collapseOne" class="text-left m-0 p-0 btn btn-link btn-block">
																<h5 class="m-0 p-0">En orden<span class="badge badge-pill badge-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $oknum;?></font></font></span></h5>
                                                                
															</button>
														</div>
														<div data-parent="#accordionResume" id="collapseResume1" aria-labelledby="headingOne" class="collapse">
															<div class="card-body">
																<p class="mb-3"><?php echo ($selectAlis['documentos_vehiculo']==true?"Documentos del vehiculo":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['documentos_conductor']==true?"Documentos del conductor":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['calcomania']==true?"Calcomania como conduzco":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['aire']==true?"Aire":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['aseo']==true?"Aseo":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['baterias']==true?"Bateria y ..":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['botiquin']==true?"Botiquin":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['celular']==true?"Celular con minutos":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['cinturones']==true?"Cinturones":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['disp_velocidad']==true?"Dispositivo de velocidad":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['equipo_carretera']==true?"Equipo de carretera":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['estado_esc_p_conductor']==true?"Estado escalera puerta conductor":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['estado_esc_p_pasajero']==true?"Estado escalera puerta pasajero":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['extintor']==true?"Extintor":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['filtros']==true?"Filtros":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['frenos']==true?"Frenos":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['frenos_emergencia']==true?"Frenos de emergencia":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['herramientas']==true?"Herramientas":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['linterna']==true?"Linterna":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['llantas']==true?"Llantas":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['luces']==true?"Luces":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['motor']==true?"Motor":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['niveles']==true?"Niveles":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['parabrisas']==true?"Parabrisas":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['pito']==true?"Pito":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['repuesto']==true?"Repuesto":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['retrovisores']==true?"Espejos retrovisores":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['ruteros']==true?"Ruteros":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['silla_conductor']==true?"Silla conductor":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['silleteria']==true?"Silleteria general":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['tapas']==true?"Tapas":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['tension']==true?"Tension de correas":"");?></p>
																<p class="mb-3"><?php echo ($selectAlis['transmision']==true?"Transmision":"");?></p>
															</div>
														</div>
													</div>
												</div>
											</div>
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
                                                    <h5 class="m-0 p-0">Detalle de novedades</h5>
                                                </button>
                                            </div>
                                            <div data-parent="#accordion" id="collapseOne1" aria-labelledby="headingOne" class="collapse show">
                                                <div class="card-body">
                                                    <p class="mb-3"><?php echo ($selectAlis['documentos_vehiculo']==false?"<strong> Descripcion Documentos del vehiculo:</strong> <i>".$selectAlis['desc_documentos_vehiculo']."</i> ":"");?></p>
                                                     <?php echo ($selectAlis['documentos_vehiculo']==false?'<img class="evidencia" src="data:image/png;base64, '.$selectAlis['img_documentos_vehiculo'].'" alt="Evidencia" />':"");?>
                                                    <p class="mb-3"><?php echo ($selectAlis['documentos_conductor']==false?"<strong>  Descripcion Documentos del conductor:</strong> <i>".$selectAlis['desc_documentos_conductor']."</i> ":"");?></p>
                                                    <?php echo ($selectAlis['documentos_conductor']==false ?'<img class="evidencia" src="data:image/png;base64, '.$selectAlis['img_documentos_conductor'].'" alt="Evidencia" />':"");?>
                                                    <p class="mb-3"><?php echo ($selectAlis['calcomania']==false?"<strong> Descripcion  Descripcion Calcomania como conduzco:</strong> <i>".$selectAlis['desc_calcomania']."</i> ":"");?></p>
                                                     <?php echo ($selectAlis['calcomania']==false ?'<img class="evidencia" src="data:image/png;base64, '.$selectAlis['img_calcomania'].'" alt="Evidencia" />':"");?>
                                                    <p class="mb-3"><?php echo ($selectAlis['aire']==false?"<strong> Descripcion Aire:</strong> <i>".$selectAlis['desc_aire']."</i> ":"");?></p>
                                                     <?php echo ($selectAlis['aire']==false ?'<img class="evidencia" src="data:image/png;base64, '.$selectAlis['img_aire'].'" alt="Evidencia" />':"");?>
                                                    <p class="mb-3"><?php echo ($selectAlis['aseo']==false?"<strong> Descripcion Aseo:</strong> <i>".$selectAlis['desc_aseo']."</i> ":"");?></p>
                                                     <?php echo ($selectAlis['aseo']==false ?'<img class="evidencia" src="data:image/png;base64, '.$selectAlis['img_aseo'].'" alt="Evidencia" />':"");?>
                                                    <p class="mb-3"><?php echo ($selectAlis['baterias']==false?"<strong> Descripcion Bateria :</strong> <i>".$selectAlis['desc_baterias']."</i> ":"");?></p>
                                                     <?php echo ($selectAlis['baterias']==false ?'<img class="evidencia" src="data:image/png;base64, '.$selectAlis['img_baterias'].'" alt="Evidencia" />':"");?>
                                                    <p class="mb-3"><?php echo ($selectAlis['botiquin']==false?"<strong> Descripcion Botiquin:</strong> <i>".$selectAlis['desc_botiquin']."</i> ":"");?></p>
                                                     <?php echo ($selectAlis['botiquin']==false ?'<img class="evidencia" src="data:image/png;base64, '.$selectAlis['img_botiquin'].'" alt="Evidencia" />':"");?>
                                                    <p class="mb-3"><?php echo ($selectAlis['celular']==false?"<strong> Descripcion Celular con minutos:</strong> <i>".$selectAlis['desc_celular']."</i> ":"");?></p>
                                                     <?php echo ($selectAlis['celular']==false ?'<img class="evidencia" src="data:image/png;base64, '.$selectAlis['img_celular'].'" alt="Evidencia" />':"");?>
                                                    <p class="mb-3"><?php echo ($selectAlis['cinturones']==false?"<strong> Descripcion Cinturones:</strong> <i>".$selectAlis['desc_cinturones']."</i> ":"");?></p>
                                                     <?php echo ($selectAlis['cinturones']==false ?'<img class="evidencia" src="data:image/png;base64, '.$selectAlis['img_cinturones'].'" alt="Evidencia" />':"");?>
                                                    <p class="mb-3"><?php echo ($selectAlis['disp_velocidad']==false?"<strong> Descripcion Dispositivo de velocidad:</strong> <i>".$selectAlis['desc_disp_velocidad']."</i> ":"");?></p>
                                                     <?php echo ($selectAlis['disp_velocidad']==false ?'<img class="evidencia" src="data:image/png;base64, '.$selectAlis['img_disp_velocidad'].'" alt="Evidencia" />':"");?>
                                                    <p class="mb-3"><?php echo ($selectAlis['equipo_carretera']==false?"<strong> Descripcion Equipo de carretera:</strong> <i>".$selectAlis['desc_equipo_carretera']."</i> ":"");?></p>
                                                     <?php echo ($selectAlis['equipo_carretera']==false ?'<img class="evidencia" src="data:image/png;base64, '.$selectAlis['img_equipo_carretera'].'" alt="Evidencia" />':"");?>
                                                    <p class="mb-3"><?php echo ($selectAlis['estado_esc_p_conductor']==false?"<strong> Descripcion Estado escalera puerta conductor:</strong> <i>".$selectAlis['desc_estado_esc_p_conductor']."</i> ":"");?></p>
                                                     <?php echo ($selectAlis['estado_esc_p_conductor']==false ?'<img class="evidencia" src="data:image/png;base64, '.$selectAlis['img_estado_esc_p_conductor'].'" alt="Evidencia" />':"");?>
                                                    <p class="mb-3"><?php echo ($selectAlis['estado_esc_p_pasajero']==false?"<strong> Descripcion Estado escalera puerta pasajero:</strong> <i>".$selectAlis['desc_estado_esc_p_pasajero']."</i> ":"");?></p>
                                                     <?php echo ($selectAlis['estado_esc_p_pasajero']==false ?'<img class="evidencia" src="data:image/png;base64, '.$selectAlis['img_estado_esc_p_pasajero'].'" alt="Evidencia" />':"");?>
                                                    <p class="mb-3"><?php echo ($selectAlis['extintor']==false?"<strong> Descripcion Extintor:</strong> <i>".$selectAlis['desc_extintor']."</i> ":"");?></p>
                                                     <?php echo ($selectAlis['extintor']==false ?'<img class="evidencia" src="data:image/png;base64, '.$selectAlis['img_extintor'].'" alt="Evidencia" />':"");?>
                                                    <p class="mb-3"><?php echo ($selectAlis['filtros']==false?"<strong> Descripcion Filtros:</strong> <i>".$selectAlis['desc_filtros']."</i> ":"");?></p>
                                                     <?php echo ($selectAlis['filtros']==false ?'<img class="evidencia" src="data:image/png;base64, '.$selectAlis['img_filtros'].'" alt="Evidencia" />':"");?>
                                                    <p class="mb-3"><?php echo ($selectAlis['frenos']==false?"<strong> Descripcion Frenos:</strong> <i>".$selectAlis['desc_frenos']."</i> ":"");?></p>
                                                     <?php echo ($selectAlis['frenos']==false ?'<img class="evidencia" src="data:image/png;base64, '.$selectAlis['img_frenos'].'" alt="Evidencia" />':"");?>
                                                    <p class="mb-3"><?php echo ($selectAlis['frenos_emergencia']==false?"<strong> Descripcion Frenos de emergencia:</strong> <i>".$selectAlis['desc_frenos_emergencia']."</i> ":"");?></p>
                                                     <?php echo ($selectAlis['frenos_emergencia']==false ?'<img class="evidencia" src="data:image/png;base64, '.$selectAlis['img_frenos_emergencia'].'" alt="Evidencia" />':"");?>
                                                    <p class="mb-3"><?php echo ($selectAlis['herramientas']==false?"<strong> Descripcion Herramientas:</strong> <i>".$selectAlis['desc_herramientas']."</i> ":"");?></p>
                                                     <?php echo ($selectAlis['herramientas']==false ?'<img class="evidencia" src="data:image/png;base64, '.$selectAlis['img_herramientas'].'" alt="Evidencia" />':"");?>
                                                    <p class="mb-3"><?php echo ($selectAlis['linterna']==false?"<strong> Descripcion Linterna:</strong> <i>".$selectAlis['desc_linterna']."</i> ":"");?></p>
                                                     <?php echo ($selectAlis['linterna']==false ?'<img class="evidencia" src="data:image/png;base64, '.$selectAlis['img_linterna'].'" alt="Evidencia" />':"");?>
                                                    <p class="mb-3"><?php echo ($selectAlis['llantas']==false?"<strong> Descripcion Llantas:</strong> <i>".$selectAlis['desc_llantas']."</i> ":"");?></p>
                                                     <?php echo ($selectAlis['llantas']==false ?'<img class="evidencia" src="data:image/png;base64, '.$selectAlis['img_llantas'].'" alt="Evidencia" />':"");?>
                                                    <p class="mb-3"><?php echo ($selectAlis['luces']==false?"<strong> Descripcion Luces:</strong> <i>".$selectAlis['desc_luces']."</i> ":"");?></p>
                                                     <?php echo ($selectAlis['luces']==false ?'<img class="evidencia" src="data:image/png;base64, '.$selectAlis['img_luces'].'" alt="Evidencia" />':"");?>
                                                    <p class="mb-3"><?php echo ($selectAlis['motor']==false?"<strong> Descripcion Motor:</strong> <i>".$selectAlis['desc_motor']."</i> ":"");?></p>
                                                     <?php echo ($selectAlis['motor']==false ?'<img class="evidencia" src="data:image/png;base64, '.$selectAlis['img_motor'].'" alt="Evidencia" />':"");?>
                                                    <p class="mb-3"><?php echo ($selectAlis['niveles']==false?"<strong> Descripcion Niveles:</strong> <i>".$selectAlis['desc_niveles']."</i> ":"");?></p>
                                                     <?php echo ($selectAlis['niveles']==false ?'<img class="evidencia" src="data:image/png;base64, '.$selectAlis['img_niveles'].'" alt="Evidencia" />':"");?>
                                                    <p class="mb-3"><?php echo ($selectAlis['parabrisas']==false?"<strong> Descripcion Parabrisas:</strong> <i>".$selectAlis['desc_parabrisas']."</i> ":"");?></p>
                                                     <?php echo ($selectAlis['parabrisas']==false ?'<img class="evidencia" src="data:image/png;base64, '.$selectAlis['img_parabrisas'].'" alt="Evidencia" />':"");?>
                                                    <p class="mb-3"><?php echo ($selectAlis['pito']==false?"<strong> Descripcion Pito:</strong> <i>".$selectAlis['desc_pito']."</i> ":"");?></p>
                                                     <?php echo ($selectAlis['pito']==false ?'<img class="evidencia" src="data:image/png;base64, '.$selectAlis['img_pito'].'" alt="Evidencia" />':"");?>
                                                    <p class="mb-3"><?php echo ($selectAlis['repuesto']==false?"<strong> Descripcion Repuesto:</strong> <i>".$selectAlis['desc_repuesto']."</i> ":"");?></p>
                                                     <?php echo ($selectAlis['repuesto']==false ?'<img class="evidencia" src="data:image/png;base64, '.$selectAlis['img_repuesto'].'" alt="Evidencia" />':"");?>
                                                    <p class="mb-3"><?php echo ($selectAlis['retrovisores']==false?"<strong> Descripcion Espejos retrovisores:</strong> <i>".$selectAlis['desc_retrovisores']."</i> ":"");?></p>
                                                     <?php echo ($selectAlis['retrovisores']==false ?'<img class="evidencia" src="data:image/png;base64, '.$selectAlis['img_retrovisores'].'" alt="Evidencia" />':"");?>
                                                    <p class="mb-3"><?php echo ($selectAlis['ruteros']==false?"<strong> Descripcion Ruteros:</strong> <i>".$selectAlis['desc_ruteros']."</i> ":"");?></p>
                                                     <?php echo ($selectAlis['ruteros']==false ?'<img class="evidencia" src="data:image/png;base64, '.$selectAlis['img_ruteros'].'" alt="Evidencia" />':"");?>
                                                    <p class="mb-3"><?php echo ($selectAlis['silla_conductor']==false?"<strong> Descripcion Silla conductor:</strong> <i>".$selectAlis['desc_silla_conductor']."</i> ":"");?></p>
                                                     <?php echo ($selectAlis['silla_conductor']==false ?'<img class="evidencia" src="data:image/png;base64, '.$selectAlis['img_silla_conductor'].'" alt="Evidencia" />':"");?>
                                                    <p class="mb-3"><?php echo ($selectAlis['silleteria']==false?"<strong> Descripcion Silleteria general:</strong> <i>".$selectAlis['desc_silleteria']."</i> ":"");?></p>
                                                     <?php echo ($selectAlis['silleteria']==false ?'<img class="evidencia" src="data:image/png;base64, '.$selectAlis['img_silleteria'].'" alt="Evidencia" />':"");?>
                                                    <p class="mb-3"><?php echo ($selectAlis['tapas']==false?"<strong> Descripcion Tapas:</strong> <i>".$selectAlis['desc_tapas']."</i> ":"");?></p>
                                                     <?php echo ($selectAlis['tapas']==false ?'<img class="evidencia" src="data:image/png;base64, '.$selectAlis['img_tapas'].'" alt="Evidencia" />':"");?>
                                                    <p class="mb-3"><?php echo ($selectAlis['tension']==false?"<strong> Descripcion Tension de correas:</strong> <i>".$selectAlis['desc_tension']."</i> ":"");?></p>
                                                     <?php echo ($selectAlis['tension']==false ?'<img class="evidencia" src="data:image/png;base64, '.$selectAlis['img_tension'].'" alt="Evidencia" />':"");?>
                                                    <p class="mb-3"><?php echo ($selectAlis['transmision']==false?"<strong> Descripcion Transmision:</strong> <i>".$selectAlis['desc_transmision']."</i> ":"");?></p>
                                                     <?php echo ($selectAlis['transmision']==false ?'<img class="evidencia" src="data:image/png;base64, '.$selectAlis['img_transmision'].'" alt="Evidencia" />':"");?>
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

