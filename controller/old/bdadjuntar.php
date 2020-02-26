<?php
$ruta='';
$usuario='';
if(isset($_POST['logo'])){
	$ruta='logos';
	$usuario=$_POST['id'];
}
elseif(isset($_POST['foto'])){
	$ruta='fotos';
	$usuario=$_POST['conductor'];
}
elseif(isset($_POST['firma'])){
	$ruta='firmas';
	$usuario=$_POST['id'];
}
foreach ($_FILES["imagen"]["error"] as $key => $error){
    if ($error == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["imagen"]["tmp_name"][$key];
        move_uploaded_file($tmp_name, '../images/'.$ruta.'/'.$usuario.'.png');
    }
}
?>
<script>
window.location='../admin.php?id=<?php echo base64_encode($_POST['id'])?>"';
</script>