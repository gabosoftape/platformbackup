<?php
$resultaccount = $mysqli->query("SELECT id, username, name FROM sys_user WHERE id = '".$_POST['id']."' ");
$rowaccount=mysqli_fetch_array($resultaccount);

$resultphone = $mysqli->query("SELECT phone FROM bs_phone WHERE parent_id = '".$_POST['id']."' ");
$rowphone=mysqli_fetch_array($resultphone);

$resultemail = $mysqli->query("SELECT email FROM bs_email WHERE parent_id = '".$_POST['id']."' ");
$rowemail=mysqli_fetch_array($resultemail);

$resultaccountbs = $mysqli->query("SELECT name, identification, identification_type, website, territorial_code, resolution_code, date_enabled FROM bs_account WHERE wialon_id = '".$_POST['id']."'");
$rowaccountbs=mysqli_fetch_array($resultaccountbs);

$resultaddress = $mysqli->query("SELECT address, geotag FROM bs_address WHERE parent_id = '".$_POST['id']."'");
$rowaddress=mysqli_fetch_array($resultaddress);
?>