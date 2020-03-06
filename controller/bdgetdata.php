<?php
require_once 'config/conexion.php';
require_once 'config/odoo_server.php';
use Ang3\Component\Odoo\Client\ExternalApiClient;
$client = new ExternalApiClient($server['url'], $server['db'], $server['username'], $server['password']);
//get alistamientos
$resultalistamientos = $client->searchAndRead("gpscontrol.alistamientos");
if(isset($_GET['user_name']) AND isset($_GET['access_token'])){
	//$user = $_GET['user_name']; 
	//$password = $_GET['access_token'];
	//$result = $mysqli->query("SELECT id FROM empresas WHERE user = '".$user."' ");
    //$row = mysqli_fetch_array($result);
    $resultAccount = $mysqli->query("SELECT id, password FROM empresas WHERE user ='".$_GET['user_name']."' ");
	$rowAccount=mysqli_fetch_array($resultAccount);
    // obtener datos wialon ? o  halar mas bien variable alistamientos, vehiculos. y guardarlos.
    //guardar en base dedatos los alistamientos, los vehiculos y los conductores disponibles para este usuario.
    // validar si la informacion ya existe y borrar la innecesaria. No necesitamos tanta vaina, borrar lo que no sirve y añadir lo nuevo en cada reload. 
    $curl = curl_init();
    $curl2 = curl_init();
    $curl3 = curl_init();
	$username = $_GET['user_name'];
    $token = $_GET['access_token'];
    //tokenlogin
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
    //var_dump($res);
    //sid ok
    $sid = $res['eid'];
    //buscar info account .. unidades disponibles
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
    //una vez obtengo informacion de las unidades comparo con los alistamientos globales. 
	$response2 = curl_exec($curl2);
	$err2 = curl_error($curl2);
	$res2 = json_decode($response2, true);
    $vehiculos = $res2['items'];
    //esta variable obtendra los alistamientos validos , o unicos necesarios en la vista (permitidos).
	$alistamientosValidos = array();
	foreach($resultalistamientos as $alist){
		foreach($vehiculos as $vehiculo){
			if($vehiculo['nm']==$alist['vehiculo'][1]){
				array_push($alistamientosValidos, $alist);
			}
		}
    }
    //luego buscamos los conductores en plataforma.
    curl_setopt_array($curl3, array(
	CURLOPT_URL => "https://hst-api.wialon.com/wialon/ajax.html?svc=core/search_items&params={%22spec%22:{%22itemsType%22:%22avl_resource%22,%22propName%22:%22drivers%22,%22propValueMask%22:%22%22,%22sortType%22:%22drivers%22,%22propType%22:%22propitemname%22},%22force%22:1,%22flags%22:4611686018427387903,%22from%22:0,%22to%22:0}&sid=".$sid."",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => array(
		"cache-control: no-cache"
	),
    ));
    //variables que necesito de curl3
	$response3 = curl_exec($curl3);
	$err3 = curl_error($curl3);
    $res3 = json_decode($response3, true);
    $totalItemsCount = $res3['totalItemsCount'];
    $items = $res3['items'];
    $conductores = [];
    $drivers = [];
    $resultDrivers = $mysqli->query("SELECT id, nombre, phone FROM conductores;");
    $rowsDrivers=mysqli_fetch_array($resultDrivers);
    $flagDriv;

    if($totalItemsCount>1){
        foreach($items as $item){
            if (array_key_exists('drvrs', $item)) {
                $conductores = $item['drvrs'];
                $idCuenta = $item['id'];
                $count = 0;
                foreach($conductores as $conductor){
                    if (array_key_exists('id', $conductor)) {
                            $imgRes = "hst-api.wialon.com/avl_driver_image/".$idCuenta."/".$conductor['id']."/200/1.png";
                            $values = $conductor['id'].",'".$conductor['n']."','".$conductor['p']."','".$conductor['pwd']."','".$imgRes."',".$rowAccount['id'];
                            $flagDriv = null;
                            foreach($resultDrivers as $resDriv){
                                //var_dump($conductor);
                                //validar cuando en el diccionario tienen clave 1.2.3.4 o viene sin clave.
                                if($resDriv['id']!= $conductor['id']){
                                        //no existe en la base de datos el conductor
                                        $flagDriv = false;
                                }else{
                                        //ya existe el archivo
                                        $flagDriv = true;

                                    }
                                }
                                //validamos si existe en la base de datos para guardar o actualizar respectivamente.
                                if($flagDriv == false){
                                    $mysqli->query("INSERT INTO conductores(id, nombre, phone, pwd, img, empresaId) VALUES($values)");
                                
                                }else if($flagDriv != null){
                                    $mysqli->query("UPDATE conductores SET 				
                                                name='".$conductor['n']."',, 
                                                phone='".$conductor['p']."',, 
                                                pwd='".$conductor['pwd']."',, 
                                                empresaId='".$rowAccount['id']."',
                                                WHERE id = '".$conductor['id']."'
                                            "); 
                                }else{
                                    echo '<script>alert("hubo error '.$conductor.'");</script>	';
                                }
                             array_push($drivers, $conductor);  
                    }else{

                    }
                }
                if(empty($conductores)){
                }else{
                    
                }
            }else{
                //var_dump("no existen conductores en ".$item['nm']);
            }
            
        }
    }else{
        $conductores = $res3['items'][0]['drvrs'];
        $idCuenta = $res3['items'][0]['id'];
        foreach($conductores as $conductor){
            $imgRes = "hst-api.wialon.com/avl_driver_image/".$idCuenta."/".$conductor['id']."/200/1.png";
            $values = $conductor['id'].",'".$conductor['n']."','".$conductor['p']."','".$conductor['pwd']."','".$imgRes."',".$rowAccount['id'];
            $flagDriv = null;
            foreach($resultDrivers as $resDriv){
               if($resDriv['id'] != $conductor['id']){
                    //no existe en la base de datos el conductor
                    $flagDriv = false;
               }else{
                    //ya existe el archivo
                    $flagDriv = true;

                }
            }
            if($flagDriv == false){
                $mysqli->query("INSERT INTO conductores(id, nombre, phone, pwd, img, empresaId) VALUES($values)");
            
            }else if($flagDriv != null){
               	$mysqli->query("UPDATE conductores SET 				
                            name='".$conductor['n']."',, 
                            phone='".$conductor['p']."',, 
                            pwd='".$conductor['pwd']."',, 
                            empresaId='".$rowAccount['id']."',
							WHERE id = '".$conductor['id']."'
						"); 
            }else{
                echo '<script>alert("hubo error '.$conductor.'");</script>	';
            }
        }
        $drivers = $conductores;
    }
    //consulto en la base de datos todos mis alistamientos.
    $resultEnlistments = $mysqli->query("SELECT id FROM alistamientos;");
    $rowEnlists=mysqli_fetch_array($resultEnlistments);
    $flag;
    //comparo los ids de cada objeto y si se parecen activo un flag para insertar en base de datos..
    foreach($alistamientosValidos as $alistamiento){
        $flag = null;
        foreach($resultEnlistments as $enlist){
            if($enlist['id'] == $alistamiento['id']){
                $flag = true;
            }else{
                $flag = false;
            }
        }
        if($flag == false){
            $mysqli->query("INSERT INTO alistamientos(id, folio, fecha, conductor, vehiculo, estado) VALUES('".$alistamiento['id']."','".$alistamiento['folio']."','".$alistamiento['fecha']."', '".$alistamiento['partner_id'][1]."','".$alistamiento['vehiculo'][1]."', '".$alistamiento['state']."') ");
        }else{
            $mysqli->query("UPDATE alistamientos SET 				
                        id='".$alistamiento['id']."',
                        folio='".$alistamiento['folio']."',
                        conductor='".$alistamiento['partner_id'][1]."',
                        vehiculo='".$alistamiento['vehiculo'][1]."',
                        estado='".$alistamiento['state']."',
                        WHERE id = '".$alistamiento['id']."'
                    "); 
        }
    }
    //creo una variable auxiliar para encapsular los alistamientos validos.
    $alistamientos = $alistamientosValidos;
    $resultVehiculos = $mysqli->query("SELECT id FROM alistamientos;");
    $rowsVehiculos=mysqli_fetch_array($resultVehiculos);
    $flagVeh;
    //comparo los vehiculos obtenidos con los guardados en base de datos.
    foreach($vehiculos as $vehiculo){
        $flagVeh = null;
        foreach($resultVehiculos as $resVeh){
            if($resVeh['id'] == $vehiculo['id']){
                $flagVeh = true;
            }else{
                $flagVeh = false;
            }
        }
        if($flagVeh == false){
            $mysqli->query("INSERT INTO vehiculos(id, nombre) VALUES('".$vehiculo['id']."','".$vehiculo['nm']."') ");
        }else{
            $mysqli->query("UPDATE vehiculos SET 				
                        nombre='".$vehiculo['nm']."',
                        WHERE id = '".$vehiculo['id']."'
                    "); 
        }
    }
}
else{
	echo '<script>alert("Acceso no permitido! Intenta de Nuevo!");</script>	';
}
?>

