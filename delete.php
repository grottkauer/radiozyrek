<?php
session_start();
require_once("connect.php");
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
$sql = "DELETE FROM newsy WHERE id = '".$_POST['id']."' LIMIT 1"; // 2
$query = @$polaczenie->query($sql);
header("Location: aktual.php");
?>
