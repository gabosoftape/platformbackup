<?php
include '../config/conexion.php';
$sesion=$_POST['user'];
$ruta='';
$usuario='';
$firma=$_POST['firma'];
$logo=$_POST['logo'];
$tmp_name=$_POST['uploadedfile'];
echo $firma;
echo $logo;


if ($firma==1):
	$ruta='firmas';
    $usuario=$_POST['id'];
    $uploadedfileload="true";
    $uploadedfile_size=$_FILES[uploadedfile][size];
    //echo $_FILES[uploadedfile][name];

    $file_name=$_FILES[uploadedfile][name];
    $add="../images/firmas/$file_name";


    move_uploaded_file ($_FILES[uploadedfile][tmp_name], $add);

    echo " Ha sido subido satisfactoriamente";

  echo $file_name;
  echo $add;
    //echo $propiedad;
    $inmuebles="UPDATE empresas SET firma='$file_name' WHERE id='$usuario'";
    $resultado=$mysqli->query($inmuebles);
    echo $inmuebles;
else:
if ($logo==2):
	$ruta='logos';
    $usuario=$_POST['id'];
    $uploadedfileload="true";
    $uploadedfile_size=$_FILES[uploadedfile][size];
    //echo $_FILES[uploadedfile][name];

    $file_name=$_FILES[uploadedfile][name];
    $add="../images/logos/$file_name";
    $nombre="../images/logos/5.png"; 

    move_uploaded_file ($_FILES[uploadedfile][tmp_name], $add);

    echo " Ha sido subido satisfactoriamente";


    //echo $propiedad;
    $inmuebles="UPDATE empresas SET logo='$file_name' WHERE id='$usuario'";
    $resultado=$mysqli->query($inmuebles);
    echo $inmuebles;
else:?>
<h1> No se subio variable </h1>        
<?php 
endif;
endif;

$comilla="'";
header('Location:/fuec/home.php?user_name='.$sesion.'');
?>
