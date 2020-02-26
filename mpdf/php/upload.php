<?php
$clave = $_POST['clave'];
$total = count($_FILES['archivo']['name']);
for($i=0; $i<$total; $i++) {
  $tmpFilePath = $_FILES['archivo']['tmp_name'][$i];
  if ($tmpFilePath != ""){
    $newname = $clave.'.jpg';
    print_r($clave); 
    if(move_uploaded_file($tmpFilePath,"images/firmas/".$newname)) {
        echo 1;
    }else{
        echo 0;
    }
  }
}
?>