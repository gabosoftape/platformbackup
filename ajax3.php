<?php
define('DB_SERVER', 'localhost');
define('DB_SERVER_USERNAME', 'root');
define('DB_SERVER_PASSWORD', 'gabosoft1234!');
define('DB_DATABASE', 'gpscontrol_ws');

$connexion = new mysqli(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE);

$html = '';
$route = $_POST['route'];


$result = $connexion->query(
    'SELECT * FROM rutas  
    WHERE (ruta  LIKE "%'.strip_tags($route).'%") 
    ORDER BY id DESC LIMIT 0,512'
);
if ($result->num_rows > 0) { 
    while ($row = $result->fetch_assoc()) {                
        $html .= '<div><a class="suggest-element3" data="'.utf8_encode($row['ruta']).'" id="ruta'.$row['id'].'"><table><tr><td>'.utf8_encode($row['ruta']).'</td></tr></table></a></div>';
    }
} 
echo $html;
?>  