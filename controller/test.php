<?php
require_once 'config/conexion.php';
require_once 'config/odoo_server.php';
use Ang3\Component\Odoo\ExternalApiClient;
$client = new ExternalApiClient($server['url'], $server['db'], $server['username'], $server['password']);
//get alistamientos
$resultnotifications = $client->searchAndRead("gpscontrol.notificaciones");
$myNotification = [];
//para efectos de la parametrizacion dinamica inicializo los arreglos de ejemplo
$arrayIds = [];
function update(){
    $client->read('gpscontrol.notificaciones', $arrayIds, [
    'display_name' => 'foo'
    ]);
}
function getCount(){
    $cliente = new ExternalApiClient($server['url'], $server['db'], $server['username'], $server['password']);
    $nbRecords = $cliente->count('gpscontrol.notificaciones');
    return $nbRecords;
}

function create(){
    $recordId = $client->create('gpscontrol.notificaciones', $fields = []);
}

function delete(){
    $client->delete('gpscontrol.notificaciones', $arrayIds);
}

function read(){
    //search
    $records = $client->search('gpscontrol.notificaciones');
    //read 
    $records = $client->read('gpscontrol.notificaciones', $arrayIds);
    //read y search
    $records = $client->searchAndRead('gpscontrol.notificaciones', $options = []);

}

if(count($resultnotifications)>0){
    //existe la notificacion parametrizada
}else{
    $myNotification = getCount();
    var_dump($myNotification);
    //no exitennotificaciones parametrizadas 
}

?>

