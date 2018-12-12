<?php
//użycie funkcji na początku
ob_start();
require_once("naglowekcms.php");
?>

 <?php
 require_once("connect.php");
 $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
 $sql = "SELECT * from newsy"; // 2
 $query = @$polaczenie->query($sql);
 echo '<br/><br/><h1>Ekran usuwania newsa</h1><br/>';
 echo '<div class="container usuwanie"><h2>Wybierz newsa, ktorego chcesz usunac</h2></div>';
 echo '<form action="" method="post" class="delete-news">';
 echo '<select name="id" >';
 while($rekord = mysqli_fetch_array($query))
 {
 echo '<option value="'.$rekord[0].'">ID: '.$rekord[0].'  '.'Tytul: '.$rekord[1].'<br>';
 }
 echo '</select>';
 echo '<input type="submit" value="USUŃ"/>';
 echo '</form>';
 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
 $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
 $sql = "DELETE FROM newsy WHERE id = '".$_POST['id']."' LIMIT 1"; // 2
 $query = $polaczenie->query($sql);
 header("Location: index.php");
 }
 require_once("stopka.php");
 //...i na koścu
ob_end_flush();
  ?>
