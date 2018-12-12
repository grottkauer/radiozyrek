<?php
//użycie funkcji na początku
ob_start();
require_once("naglowekcms.php");
 ?>
 <?php
 require_once("connect.php");
 $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
 $sql2 = "SELECT * from newsy"; // 2
 $query2 = @$polaczenie->query($sql2);
 echo '<br/><br/><h1>Wysyłanie plików na serwer </h1><br/><br/>';
 echo '<form action="dodaj.php" method="post" enctype="multipart/form-data"  name="form1" class="add-photo">
       <input name="plik" type="file" size="50"/>
       <input name="max_file_size" type="hidden" value="1048576" />
       <select name="id">';
 while($rekord = mysqli_fetch_array($query2))
 {
   echo '<option value="'.$rekord[0].'">ID: '.$rekord[0].'  '.'Tytul: '.$rekord[1].'<br>';

 }
 echo'<option value="0">ID: 0 Jesli nie chcesz dodawac obrazka do newsa';
 echo' </select>
 <select name="idutworu">';
 $sql5 = "SELECT * from utwory"; // 2
 $query5 = @$polaczenie->query($sql5);
 while($rekord5 = mysqli_fetch_array($query5))
 {
   // Do wyboru dajemy tylko te utwory, ktore nie majo jeszcze foty
   $sql6 = "SELECT * from obrazki where id_utworu=$rekord5[0]"; // 2
   $query6 = @$polaczenie->query($sql6);
   if (!$rekordzik = mysqli_fetch_array($query6)) {
     echo '<option value="'.$rekord5[0].'">ID: '.$rekord5[0].'  '.'Tytul: '.$rekord5[2].' Wykonawca: '.$rekord5[3].'<br>';
   }

 }
  echo'<option value="0">ID: 0 Jesli nie chcesz dodawac obrazka do utworu';
  echo' </select>
  <input value="Wyślij plik" type="submit" /></form>';
 require_once("stopka.php");
 ob_end_flush();
  ?>
