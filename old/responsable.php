<?php 
require_once 'config/conexion.php';
$resultselectcontratista = $mysqli->query("SELECT id, name, identification_type_responsable, identification_responsable, accountid FROM bs_responsable WHERE accountid = '".($_POST['contratistaid'])."' ");
$rowselectcontratista=mysqli_fetch_array($resultselectcontratista);
echo $rowselectcontratista['name'].' '.$rowselectcontratista['identification_type_responsable'].' '.$rowselectcontratista['identification_responsable'];
echo '<input type="hidden" name="accountid" value="'.$rowselectcontratista['id'].'" />';
?>