<?php
ob_start();
require_once("naglowekcms.php");
require_once("connect.php"); // 1
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
 ?>
 <?php
 $sql = "SELECT * from terminarz order by data"; // 2
 $query = @$polaczenie->query($sql);
 echo '<div class="container">
   <br><br>
   <h1>Usuń plan zajęć</h1><br/><br/>
   <form class="delete-news" action="" method="post">
     <select name="data" >';
     while($rekord = mysqli_fetch_array($query))
     {
     echo '<option value="'.$rekord[1].'">Data: '.$rekord[1].'  '.'Info: '.$rekord[2].'<br>';
     }
     echo '</select><input type="submit" value="Usuń">
   </form>
 </div>';
 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
   $sql = "DELETE FROM terminarz WHERE data = '".$_POST['data']."' LIMIT 1"; // 2
   $query = @$polaczenie->query($sql);
   header("Location: index.php");
 }
 require_once("stopka.php");
 ob_end_flush();
  ?>
