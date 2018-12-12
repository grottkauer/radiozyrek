<?php
ob_start();
require_once("naglowekcms.php");
require_once("connect.php");
?>
 <br><h1>Dodawanie newsa</h1><br><br>

 <?php
 /*if (!isset($_SESSION['zalogowany']) || $_SESSION['user']!='admin')
 {
     echo ' ';
 }
 else{ */
 $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
 $sql = "SELECT * from rodzaj_newsa";
 $query = @$polaczenie->query($sql);
   echo '<div class="news-block" id="news-form">
     <h2>Chcesz dodać swojego newsa?</h2><br/><br/>
     <form action="" method="post" class="add-news">
     tytuł: <input type="text" name="tytul">
     <br/>autor <input type="text" name="autor">
     <br/>treść <textarea name="tresc" rows="20" cols="50"></textarea>
     <br/>rodzaj <select name="rodzaj_newsa" >';

     while($rekord = mysqli_fetch_array($query))
     {
     echo '<option value="'.$rekord[0].'">ID: '.$rekord[0].'  '.'Rodzaj: '.$rekord[1].'<br>';
     //echo "string";
     }
     echo '</select>
     <br/><input type="submit" value="Dodaj"></form>
   </div>';
   if(($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_POST['tytul'])))
   {

   $sql = "INSERT INTO newsy values('','".$_POST['tytul']."','".$_POST['autor']."',now(),'".$_POST['tresc']."','".$_POST['rodzaj_newsa']."')";
   $query = $polaczenie->query($sql);

   header ('Location: index.php');
   }
 require_once("stopka.php");
 //...i na koścu
ob_end_flush();
  ?>
