<?php require_once 'header.php';

$id=$_POST['id'];
$uploadedfileload="true";
$uploadedfile_size=$_FILES['uploadedfile'][size];
//echo $_FILES[uploadedfile][name];

if ($_FILES[uploadedfile][size]>6000000)
{$msg=$msg."El archivo es mayor que 6MB, debes reducirlo antes de subirlo<BR>";
$uploadedfileload="false";}

if (!($_FILES[uploadedfile][type] =="image/jpeg" OR $_FILES[uploadedfile][type] =="image/png"))
{$msg=$msg." Tu archivo tiene que ser JPG o PNG. Otros archivos no son permitidos<BR>";
$uploadedfileload="false";}

$file_name=$_FILES[uploadedfile][name];
$add="../images/firmas/$file_name";
if($uploadedfileload=="true"){

if(move_uploaded_file ($_FILES[uploadedfile][tmp_name], $add)){
echo " Ha sido subido satisfactoriamente";
//echo $file_name;
//echo $propiedad;


$carpeta="../images/firmas/";
$inmuebles="UPDATE empresas SET firma=''.$usuario.'.png' WHERE cod_evento='$propiedad'";
$resultado=$mysqli->query($inmuebles);
echo $id;
$comilla="'";
/*header('Location:man_eventos.php?cod='.$comilla.$propiedad.$comilla.'');*/
}else{echo "Error al subir el archivo";}

}else{echo $msg;}
?>
