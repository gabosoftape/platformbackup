<?php
	include '../config/conexion.php';
    $query=mysql_query("select * from contratista where nit LIKE '%{$key}%'");
    while($row=mysql_fetch_assoc($query))
    {
      $array[] = $row['title'];
    }
    echo json_encode($array);
?>