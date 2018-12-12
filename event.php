<?php
require_once("connect.php");
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
$sql = "INSERT INTO terminarz values('','".$_POST['data']."','".$_POST['wydarzenie']."')";
$query = $polaczenie->query($sql);
}
header("Location: index.php");
 ?>
