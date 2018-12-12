<?php
require_once("connect.php");
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
$sql = "INSERT INTO plan values('','".$_POST['data']."','".$_POST['nazwa-zajec']."')";
$query = $polaczenie->query($sql);
}
header("Location: index.php");
 ?>
