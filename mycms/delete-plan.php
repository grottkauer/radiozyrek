<?php
ob_start();
require_once("naglowekcms.php");
require_once("connect.php"); // 1
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
 ?>
 <?php
 $sql = "SELECT * from utwory where obecnie=1 order by data"; // 2
 $query = @$polaczenie->query($sql);
 echo '<div class="container">
   <br><br>
   <h1>Usuń utwór z obecnych na liście</h1><br/><br/>
   <form class="delete-news" action="" method="post">
     <select name="id" >';
     while($rekord = mysqli_fetch_array($query))
     {
     echo '<option value='.$rekord[0].'">ID: '.$rekord[0].'  Wykonawca: '.$rekord[3].'Tytuł: '.$rekord[2].'<br>';
     }
     echo '</select><input type="submit" value="Usuń">
   </form>
 </div>';
 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
   $sql = "UPDATE utwory SET obecnie=0 WHERE id = '".$_POST['id']."' LIMIT 1"; // 2
   $query = @$polaczenie->query($sql);
   header("Location: index.php");
 }
 require_once("stopka.php");
 ob_end_flush();
  ?>
