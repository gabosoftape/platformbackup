<?php
define('DB_SERVER', 'localhost');
define('DB_SERVER_USERNAME', 'root');
define('DB_SERVER_PASSWORD', 'gabosoft1234!');
define('DB_DATABASE', 'gpscontrol_ws');

$connexion = new mysqli(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE);

$html = '';
$resposable = $_POST['resposable'];


$result = $connexion->query(
    'SELECT * FROM responsable  
    WHERE CONCAT (nit, empresa, nombres)  LIKE "%'.strip_tags($resposable).'%"
    ORDER BY nit DESC LIMIT 0,512'
);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $html .= '<div><a class="suggest-element2" data="'.utf8_encode($row['nit']).'" id="responsable'.$row['nit'].'"><table><tr><td></td><td>'.utf8_encode($row['nit']).'</td><td></td><td>'.utf8_encode($row['nombres']).'</td><td></td><td>'.utf8_encode($row['telfino']).'</td><td></td><td>'.utf8_encode($row['celular']).'</td></tr></table></a></div>';
    }
}
echo $html;
?>   