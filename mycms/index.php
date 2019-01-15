<?php
require_once("naglowekcms.php");
require_once("connect.php");
unset($_SESSION['blad']);
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
if (!isset($_SESSION['zalogowany']))
{
  header("Location: ../index.php");
}
 ?>

 <div class="banner">
   <h1>Witamy w panelu administratora!<br><br>Oto twoj CMS - korzystaj z niego w razie potrzeby :D <br></h1>
 </div>
 <br><br><br><br>
 <div class="latest-news container">
   <h1>Twoje ostatnie newsy: </h1>
   <?php

   $sql = "SELECT * from newsy order by id desc limit 1"; // 2
   $query = @$polaczenie->query($sql);
   echo '<div class="col-one-third">';
   while($rekord = mysqli_fetch_array($query))
   {
   $current_id=$rekord[0];
   $sql4 = "SELECT * from obrazki order by id_newsa"; // 2
   $query4 = @$polaczenie->query($sql4);
   $a=0;
   while($rekord4 = mysqli_fetch_array($query4))
   {
     if($a==0){
       $current_id_newsa=$rekord4[4];
       if ($rekord4[4]==$current_id){
         $aktual_image = '<img src="'.$rekord4[3].'" alt="Fotka probna" /></a>';
         $a+=1;
       }
     }
   }
   if($current_id_newsa!=$current_id){
     $aktual_image = '<img src="./img/logo.jpg" alt="Fotka probna" /></a>';
   }
   echo '<a href="news.php?id='.$rekord[0].'" data-title="'.$rekord[1].'" class="title uncover">'.$aktual_image.'</a>';
   }
   
   $sql = "SELECT * from newsy order by id desc limit 1,1"; // 2
   $query = @$polaczenie->query($sql);
   echo'</div><div class="col-one-third">';
   while($rekord = mysqli_fetch_array($query))
   {
     $current_id=$rekord[0];
     $sql4 = "SELECT * from obrazki order by id_newsa"; // 2
     $query4 = @$polaczenie->query($sql4);
     $a=0;
     while($rekord4 = mysqli_fetch_array($query4))
     {
       if($a==0){
         $current_id_newsa=$rekord4[4];
         if ($rekord4[4]==$current_id){
           $aktual_image = '<img src="'.$rekord4[3].'" alt="Fotka probna" /></a>';
           $a+=1;
         }
       }
     }
     if($current_id_newsa!=$current_id){
       $aktual_image = '<img src="../img/logo.jpg" alt="Fotka probna" /></a>';
     }
     echo '<a href="news.php?id='.$rekord[0].'" data-title="'.$rekord[1].'" class="title uncover">'.$aktual_image.'</a>';
     }
   $sql = "SELECT * from newsy order by id desc limit 2,1"; // 2
   $query = @$polaczenie->query($sql);
   echo'</div><div class="col-one-third">';
   while($rekord = mysqli_fetch_array($query))
   {
     $current_id=$rekord[0];
     $sql4 = "SELECT * from obrazki order by id_newsa"; // 2
     $query4 = @$polaczenie->query($sql4);
     $a=0;
     while($rekord4 = mysqli_fetch_array($query4))
     {
       if($a==0){
         $current_id_newsa=$rekord4[4];
         if ($rekord4[4]==$current_id){
           $aktual_image = '<img src="'.$rekord4[3].'" alt="Fotka probna" /></a>';
           $a+=1;
         }
       }
     }
     if($current_id_newsa!=$current_id){
       $aktual_image = '<img src="../img/logo.jpg" alt="Fotka probna" /></a>';
     }
     echo '<a href="news.php?id='.$rekord[0].'" data-title="'.$rekord[1].'" class="title uncover">'.$aktual_image.'</a>';
     }
    ?>
 </div>
 <div class="clear">

 </div>
 <div class="latest-news">
   <h1>Ostatnio dodane zdjęcia: </h1>
   <div class="col-one-third">
     Fota 1
   </div>
   <div class="col-one-third">
     Fota 2
   </div>
   <div class="col-one-third">
     Fota 3
   </div>
 </div>
 <div class="clear">

 </div>
 <h2>Chcesz się skontaktować z tworcą CMSa w razie dodawania, usuwania lub zmiany określonych funkcji?<br><br>
   <a href="#ex1" rel="modal:open"><h3 class="big-button">KLIKNIJ TUTAJ</h3></a>
   </h2>
<br><br><!-- Modal HTML embedded directly into document -->
<div id="ex1" style="display:none;">
  <h2><a class="email" href="mailto:jaszyr@interia.pl">NAPISZ DO MNIE WIADOMOŚĆ NA E-MAILA - <h3>jaszyr@interia.pl</h3></a></h2><br>
</div>

 <?php
 require_once("stopka.php");
  ?>
