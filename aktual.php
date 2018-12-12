<?php require_once("naglowek.php");
require_once("connect.php"); // 1
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
$sql = "SELECT * from newsy order by id desc limit 1"; // 2
$query = @$polaczenie->query($sql); ?>
<br><br><br><br>

<div class="container">
  <table class="aktualnosci">
    <caption>Najnowsze wieści z Radia Żyrek</caption>
    <tr>
      <th colspan="2" class="najnowszy">
        <div class="col-half">
        <?php  while($rekord = mysqli_fetch_array($query))
        {
          echo '<a href="news.php?id='.$rekord[0].'">';
          $current_id=$rekord[0];
        }

        $sql4 = "SELECT * from obrazki order by id_newsa"; // 2
        $query4 = @$polaczenie->query($sql4);
        $a=0;
        $current_id_newsa=-1;
        while($rekord4 = mysqli_fetch_array($query4))
        {
          if($a==0){
            $current_id_newsa=$rekord4[4];
            if ($rekord4[4]==$current_id){
              echo '<img src="'.$rekord4[3].'" alt="Fotka probna" /></a>';
              $a+=1;
            }
          }
        }
        if($current_id_newsa!=$current_id || !isset($current_id_newsa)){
          echo '<img src="img/logo.jpg" alt="Fotka probna" /></a>';
        }
        ?>
        </div>
        <div class="col-half"><a href="#">
          <?php
          require_once("connect.php"); // 1
          $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
          $sql = "SELECT * from newsy order by id desc limit 1"; // 2
          $query = @$polaczenie->query($sql);
          while($rekord = mysqli_fetch_array($query))
          {
          echo '<a href="news.php?id='.$rekord[0].'">';
          echo '<h2>'.$rekord[1].'</h2>Autor: '.$rekord[2].'<br/>Data: '.$rekord[3].'<br/><br/><div class="aktual-text">'.nl2br(substr($rekord[4], 0, 150).'...<br/>Czytaj wiecej...').'</div></a>';
          }
          ?>
        </div>
      </th>
    </tr>
    <tr>
      <td class="wpisy">
        <div class="col-half image-aktual">
          <?php
          $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
          $sql = "SELECT * from newsy order by id desc limit 1,1"; // 2
          $query = @$polaczenie->query($sql);
          while($rekord = mysqli_fetch_array($query))
          {
            echo '<a href="news.php?id='.$rekord[0].'">';
            $current_id=$rekord[0];
          }
          $sql4 = "SELECT * from obrazki order by id_newsa"; // 2
          $query4 = @$polaczenie->query($sql4);
          $a=0;
          $current_id_newsa=-1;
          while($rekord4 = mysqli_fetch_array($query4))
          {
            if($a==0){
              $current_id_newsa=$rekord4[4];
              if ($rekord4[4]==$current_id){
                echo '<img src="'.$rekord4[3].'" alt="Fotka probna" /></a>';
                $a+=1;
              }
            }
          }
          if($current_id_newsa!=$current_id){
            echo '<img src="img/logo.jpg" alt="Fotka probna" /></a>';
          }
          ?>

        </div>
        <div class="col-half">
          <a href="#">
            <?php
            $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
            $sql = "SELECT * from newsy order by id desc limit 1,1"; // 2
            $query = @$polaczenie->query($sql);
            while($rekord = mysqli_fetch_array($query))
            {
            echo '<a href="news.php?id='.$rekord[0].'">';
            echo '<h3>'.$rekord[1].'</h3>Autor: '.$rekord[2].'<br/>Data: '.$rekord[3].'<br/><br/><div class="aktual-text">'.nl2br(substr($rekord[4], 0, 50).'...<br/>Czytaj wiecej...').'</div>';
            }
            ?></a>
        </div>
      </td>
      <td class="wpisy">
        <div class="col-half image-aktual">
          <?php
          $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
          $sql = "SELECT * from newsy order by id desc limit 2,1"; // 2
          $query = @$polaczenie->query($sql);
          while($rekord = mysqli_fetch_array($query))
          {
            echo '<a href="news.php?id='.$rekord[0].'">';
            $current_id=$rekord[0];
          }
          $sql4 = "SELECT * from obrazki order by id_newsa"; // 2
          $query4 = @$polaczenie->query($sql4);
          $a=0;
          $current_id_newsa=-1;
          while($rekord4 = mysqli_fetch_array($query4))
          {
            if($a==0){
              $current_id_newsa=$rekord4[4];
              if ($rekord4[4]==$current_id){
                echo '<img src="'.$rekord4[3].'" alt="Fotka probna" /></a>';
                $a+=1;
              }
            }
          }
          if($current_id_newsa!=$current_id){
            echo '<img src="img/logo.jpg" alt="Fotka probna" /></a>';
          }
          ?>

        </div>
        <div class="col-half">
          <a href="#">
            <?php
            $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
            $sql = "SELECT * from newsy order by id desc limit 2,1"; // 2
            $query = @$polaczenie->query($sql);
            while($rekord = mysqli_fetch_array($query))
            {
            echo '<a href="news.php?id='.$rekord[0].'">';
            echo '<h3>'.$rekord[1].'</h3>Autor: '.$rekord[2].'<br/>Data: '.$rekord[3].'<br/><br/><div class="aktual-text">'.nl2br(substr($rekord[4], 0, 50).'...<br/>Czytaj wiecej...').'</div>';
            }
            ?></a>
        </div>
      </td>
    </tr>
  </table>
</div>
<br><br>
<div class="container">
  <table class="aktualnosci-kategorie">
    <caption>Najnowsze wieści z tytułowych</caption>
    <tr>
      <th colspan="2" class="najnowszy-kategorie">
        <div class="col-half">
        <?php
        $sql = "SELECT * from newsy where rodzaj=1 order by id desc limit 1"; // 2
        $query = @$polaczenie->query($sql);
         while($rekord = mysqli_fetch_array($query))
        {
          echo '<a href="news.php?id='.$rekord[0].'">';
          $current_id=$rekord[0];
        }

        $sql4 = "SELECT * from obrazki order by id_newsa"; // 2
        $query4 = @$polaczenie->query($sql4);
        $a=0;
        $current_id_newsa=-1;
        while($rekord4 = mysqli_fetch_array($query4))
        {
          if($a==0){
            $current_id_newsa=$rekord4[4];
            if ($rekord4[4]==$current_id){
              echo '<img src="'.$rekord4[3].'" alt="Fotka probna" /></a>';
              $a+=1;
            }
          }
        }
        if($current_id_newsa!=$current_id || !isset($current_id_newsa)){
          echo '<img src="img/logo.jpg" alt="Fotka probna" /></a>';
        }
        ?>
        </div>
        <div class="col-half"><a href="#">
          <?php
          require_once("connect.php"); // 1
          $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
          $sql = "SELECT * from newsy where rodzaj=1 order by id desc limit 1"; // 2
          $query = @$polaczenie->query($sql);
          while($rekord = mysqli_fetch_array($query))
          {
          echo '<a href="news.php?id='.$rekord[0].'">';
          echo '<h2>'.$rekord[1].'</h2>Autor: '.$rekord[2].'<br/>Data: '.$rekord[3].'<br/><br/><div class="aktual-text">'.nl2br(substr($rekord[4], 0, 150).'...<br/>Czytaj wiecej...').'</div></a>';
          }
          ?>
        </div>
      </th>
    </tr>
    <tr>
      <td class="wpisy">
        <div class="col-half image-aktual-kategorie">
          <?php
          $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
          $sql = "SELECT * from newsy where rodzaj=1 order by id desc limit 1,1"; // 2
          $query = @$polaczenie->query($sql);
          while($rekord = mysqli_fetch_array($query))
          {
            echo '<a href="news.php?id='.$rekord[0].'">';
            $current_id=$rekord[0];
          }
          $sql4 = "SELECT * from obrazki order by id_newsa"; // 2
          $query4 = @$polaczenie->query($sql4);
          $a=0;
          $current_id_newsa=-1;
          while($rekord4 = mysqli_fetch_array($query4))
          {
            if($a==0){
              $current_id_newsa=$rekord4[4];
              if ($rekord4[4]==$current_id){
                echo '<img src="'.$rekord4[3].'" alt="Fotka probna" /></a>';
                $a+=1;
              }
            }
          }
          if($current_id_newsa!=$current_id){
            echo '<img src="img/logo.jpg" alt="Fotka probna" /></a>';
          }
          ?>

        </div>
        <div class="col-half">
          <a href="#">
            <?php
            $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
            $sql = "SELECT * from newsy where rodzaj=1 order by id desc limit 1,1"; // 2
            $query = @$polaczenie->query($sql);
            while($rekord = mysqli_fetch_array($query))
            {
            echo '<a href="news.php?id='.$rekord[0].'">';
            echo '<h3>'.$rekord[1].'</h3>Autor: '.$rekord[2].'<br/>Data: '.$rekord[3].'<br/><br/><div class="aktual-text">'.nl2br(substr($rekord[4], 0, 50).'...<br/>Czytaj wiecej...').'</div>';
            }
            ?></a>
        </div>
      </td>
      <td class="wpisy">
        <div class="col-half image-aktual-kategorie">
          <?php
          $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
          $sql = "SELECT * from newsy where rodzaj=1 order by id desc limit 2,1"; // 2
          $query = @$polaczenie->query($sql);
          while($rekord = mysqli_fetch_array($query))
          {
            echo '<a href="news.php?id='.$rekord[0].'">';
            $current_id=$rekord[0];
          }
          $sql4 = "SELECT * from obrazki order by id_newsa"; // 2
          $query4 = @$polaczenie->query($sql4);
          $a=0;
          $current_id_newsa=-1;
          while($rekord4 = mysqli_fetch_array($query4))
          {
            if($a==0){
              $current_id_newsa=$rekord4[4];
              if ($rekord4[4]==$current_id){
                echo '<img src="'.$rekord4[3].'" alt="Fotka probna" /></a>';
                $a+=1;
              }
            }
          }
          if($current_id_newsa!=$current_id){
            echo '<img src="img/logo.jpg" alt="Fotka probna" /></a>';
          }
          ?>

        </div>
        <div class="col-half">
          <a href="#">
            <?php
            $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
            $sql = "SELECT * from newsy where rodzaj=1 order by id desc limit 2,1"; // 2
            $query = @$polaczenie->query($sql);
            while($rekord = mysqli_fetch_array($query))
            {
            echo '<a href="news.php?id='.$rekord[0].'">';
            echo '<h3>'.$rekord[1].'</h3>Autor: '.$rekord[2].'<br/>Data: '.$rekord[3].'<br/><br/><div class="aktual-text">'.nl2br(substr($rekord[4], 0, 50).'...<br/>Czytaj wiecej...').'</div>';
            }
            ?></a>
        </div>
      </td>
    </tr>
  </table>
  <table class="aktualnosci-kategorie">
    <caption>Najnowsze wieści z listą przebojów</caption>
    <tr>
      <th colspan="2" class="najnowszy-kategorie">
        <div class="col-half">
        <?php
        $sql = "SELECT * from newsy where rodzaj=3 order by id desc limit 1"; // 2
        $query = @$polaczenie->query($sql);
          while($rekord = mysqli_fetch_array($query))
        {
          echo '<a href="news.php?id='.$rekord[0].'">';
          $current_id=$rekord[0];
        }

        $sql4 = "SELECT * from obrazki order by id_newsa"; // 2
        $query4 = @$polaczenie->query($sql4);
        $a=0;
        $current_id_newsa=-1;
        while($rekord4 = mysqli_fetch_array($query4))
        {
          if($a==0){
            $current_id_newsa=$rekord4[4];
            if ($rekord4[4]==$current_id){
              echo '<img src="'.$rekord4[3].'" alt="Fotka probna" /></a>';
              $a+=1;
            }
          }
        }
        if($current_id_newsa!=$current_id || !isset($current_id_newsa)){
          echo '<img src="img/logo.jpg" alt="Fotka probna" /></a>';
        }
        ?>
        </div>
        <div class="col-half"><a href="#">
          <?php
          require_once("connect.php"); // 1
          $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
          $sql = "SELECT * from newsy where rodzaj=3 order by id desc limit 1"; // 2
          $query = @$polaczenie->query($sql);
          while($rekord = mysqli_fetch_array($query))
          {
          echo '<a href="news.php?id='.$rekord[0].'">';
          echo '<h2>'.$rekord[1].'</h2>Autor: '.$rekord[2].'<br/>Data: '.$rekord[3].'<br/><br/><div class="aktual-text">'.nl2br(substr($rekord[4], 0, 150).'...<br/>Czytaj wiecej...').'</div></a>';
          }
          ?>
        </div>
      </th>
    </tr>
    <tr>
      <td class="wpisy">
        <div class="col-half image-aktual-kategorie">
          <?php
          $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
          $sql = "SELECT * from newsy where rodzaj=3 order by id desc limit 1,1"; // 2
          $query = @$polaczenie->query($sql);
          while($rekord = mysqli_fetch_array($query))
          {
            echo '<a href="news.php?id='.$rekord[0].'">';
            $current_id=$rekord[0];
          }
          $sql4 = "SELECT * from obrazki order by id_newsa"; // 2
          $query4 = @$polaczenie->query($sql4);
          $a=0;
          $current_id_newsa=-1;
          while($rekord4 = mysqli_fetch_array($query4))
          {
            if($a==0){
              $current_id_newsa=$rekord4[4];
              if ($rekord4[4]==$current_id){
                echo '<img src="'.$rekord4[3].'" alt="Fotka probna" /></a>';
                $a+=1;
              }
            }
          }
          if($current_id_newsa!=$current_id){
            echo '<img src="img/logo.jpg" alt="Fotka probna" /></a>';
          }
          ?>

        </div>
        <div class="col-half">
          <a href="#">
            <?php
            $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
            $sql = "SELECT * from newsy where rodzaj=3 order by id desc limit 1,1"; // 2
            $query = @$polaczenie->query($sql);
            while($rekord = mysqli_fetch_array($query))
            {
            echo '<a href="news.php?id='.$rekord[0].'">';
            echo '<h3>'.$rekord[1].'</h3>Autor: '.$rekord[2].'<br/>Data: '.$rekord[3].'<br/><br/><div class="aktual-text">'.nl2br(substr($rekord[4], 0, 50).'...<br/>Czytaj wiecej...').'</div>';
            }
            ?></a>
        </div>
      </td>
      <td class="wpisy">
        <div class="col-half image-aktual-kategorie">
          <?php
          $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
          $sql = "SELECT * from newsy where rodzaj=3 order by id desc limit 2,1"; // 2
          $query = @$polaczenie->query($sql);
          while($rekord = mysqli_fetch_array($query))
          {
            echo '<a href="news.php?id='.$rekord[0].'">';
            $current_id=$rekord[0];
          }
          $sql4 = "SELECT * from obrazki order by id_newsa"; // 2
          $query4 = @$polaczenie->query($sql4);
          $a=0;
          $current_id_newsa=-1;
          while($rekord4 = mysqli_fetch_array($query4))
          {
            if($a==0){
              $current_id_newsa=$rekord4[4];
              if ($rekord4[4]==$current_id){
                echo '<img src="'.$rekord4[3].'" alt="Fotka probna" /></a>';
                $a+=1;
              }
            }
          }
          if($current_id_newsa!=$current_id){
            echo '<img src="img/logo.jpg" alt="Fotka probna" /></a>';
          }
          ?>

        </div>
        <div class="col-half">
          <a href="#">
            <?php
            $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
            $sql = "SELECT * from newsy where rodzaj=3 order by id desc limit 2,1"; // 2
            $query = @$polaczenie->query($sql);
            while($rekord = mysqli_fetch_array($query))
            {
            echo '<a href="news.php?id='.$rekord[0].'">';
            echo '<h3>'.$rekord[1].'</h3>Autor: '.$rekord[2].'<br/>Data: '.$rekord[3].'<br/><br/><div class="aktual-text">'.nl2br(substr($rekord[4], 0, 50).'...<br/>Czytaj wiecej...').'</div>';
            }
            ?></a>
        </div>
      </td>
    </tr>
  </table>
</div>
<div class="clear">

</div>
<br><br>
<div class="container">
  <div class="archiwum">
    <a href="archiwum.php">Wejdz do archiwum, jesli chcesz zobaczyc starsze wpisy</a>
  </div>
</div>
<br><br>
<?php
//session_start();
/*
if (!isset($_SESSION['zalogowany']) || $_SESSION['user']!='admin')
{
    echo ' ';
}
else{
  echo '<div class="news-block" id="news-form">
    <h2>Chcesz dodac swojego newsa?</h2>
    <form action="" method="post" class="add-news">
    tytuł: <input type="text" name="tytul">
    <br/>autor <input type="text" name="autor">
    <br/>treść <textarea name="tresc" rows="20" cols="50"></textarea>
    <br/><input type="submit" value="Dodaj"></form>
  </div>';
  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
  $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
  $sql = "INSERT INTO newsy values('','".$_POST['tytul']."','".$_POST['autor']."',now(),'".$_POST['tresc']."')";
  $query = $polaczenie->query($sql);
  }
  $sql2 = "SELECT * from newsy"; // 2
  $query2 = @$polaczenie->query($sql2);
  while($rekord = mysqli_fetch_array($query2))
  {
  $tekst .=  '<option value="'.$rekord[0].'">ID: '.$rekord[0].'  '.'Tytul: '.$rekord[1].'<br>';

  }
  $sql5 = "SELECT * from oldgallery"; // 2
  $query5 = @$polaczenie->query($sql5);
  while($rekord5 = mysqli_fetch_array($query5))
  {
  $tekst1 .=  '<option value="'.$rekord5[0].'">ID: '.$rekord5[0].'  '.'Tytul: '.$rekord5[1].'<br>';

  }
  echo '<h1>Wysyłanie plików na serwer </h1>';
  echo '<form action="dodaj.php" method="post" enctype="multipart/form-data"  name="form1" class="add-photo">
        <input name="plik" type="file" size="50"/>
        <input name="max_file_size" type="hidden" value="1048576" />
        <select name="id">';
         echo $tekst;
         echo'<option value="0">ID: 0 Jesli nie chcesz dodawac obrazka do newsa';
    echo' </select>
    <select name="idoldgallery">';
     echo $tekst1;
     echo'<option value="0">ID: 0 Jesli nie chcesz dodawac obrazka do starej galerii';
echo' </select>
<input value="Wyślij plik" type="submit" /></form>';

  echo '<br/><br/><div class="light-button"><a href="usun.php">USUN NEWSA</a></div>';


echo '<h2>Usuwanie obrazka</h2>';
$sql6 = "SELECT * from obrazki"; // 2
$query6 = @$polaczenie->query($sql6);
while($rekord6 = mysqli_fetch_array($query6))
{
$tekst2 .=  '<option value="'.$rekord6[0].'">ID: '.$rekord6[0].'  '.'Nazwa pliku: '.$rekord6[3].'<br>';
}
echo '<form class="add-photo" action="usun-obrazek.php" method="post">
<select name="id">'
  .$tekst2.
'</select>
<input type="submit" value="USUŃ"/>
</form>';

} */
  ?>

  <BR><BR><BR>


<?php require_once("stopka.php"); ?>
