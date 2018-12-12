<?php
//użycie funkcji na początku
ob_start();
require_once("naglowekcms.php");
 ?>
 <?php
 require_once("connect.php");
 $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
 echo '<br/><br/><h1>Usuwanie obrazka</h1><br/><br/>';
 $sql6 = "SELECT * from obrazki"; // 2
 $query6 = @$polaczenie->query($sql6);
 echo '<form class="add-photo" action="" method="post">
 <select name="id">';
 while($rekord6 = mysqli_fetch_array($query6))
 {
 echo '<option value="'.$rekord6[0].'">ID: '.$rekord6[0].'  '.'Nazwa pliku: '.$rekord6[3].'<br>';
 }
 echo '</select>
 <input type="submit" value="USUŃ"/>
 </form>';

 if(($_SERVER['REQUEST_METHOD'] == 'POST'))
 {
 $sql = "DELETE FROM obrazki WHERE id = '".$_POST['id']."' LIMIT 1"; // 2
 $query = $polaczenie->query($sql);
 header("Location: index.php");
 }
 require_once("stopka.php");
 ob_end_flush();
  ?>
