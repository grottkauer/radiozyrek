<?php
include("connect.php");
require_once("naglowek.php");
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
$wartosc = $_GET['id'];
$sql = "SELECT * from newsy where id=$wartosc"; // 2
$query = $polaczenie->query($sql);
$rekord = mysqli_fetch_array($query);
$sql2 = "SELECT * from rodzaj_newsa where id=$rekord[5]"; // 2
$query2 = $polaczenie->query($sql2);
$rekord2 = mysqli_fetch_array($query2);
echo '<div class="container"><h1>'.$rekord[1].'</h1><h3>Autor: '.$rekord[2].'<br/>Data: '.$rekord[3].'<br/>Rodzaj artykułu: '.$rekord2[1].'</h3><br/><br/><div class="news-text">'.nl2br($rekord[4]).'</div></div>'; // 2
$_SESSION['id_newsa']=$rekord[0];
?>
<br><br>
<div class="container">
    <div class="photos">
        <?php //galeria zdjec
          $sql4= "SELECT * from obrazki where id_newsa=$wartosc";
          $query4 = $polaczenie->query($sql4);
          $seria = 0;
          while ($rekord4 = mysqli_fetch_array($query4)){
            if ($rekord4[4]==$wartosc){
              $seria+=1;
            }
            if($seria==1)
             {
              $sql3= "SELECT * from obrazki where id_newsa=$wartosc";
              $query3 = $polaczenie->query($sql3);
              $id_zdjecia=1;
              echo '<div class="css_anchor_gallery">
                  <ul class="pictures_">';
              while ($rekord3 = mysqli_fetch_array($query3)){
                echo '<li class="fota" id="z'.$id_zdjecia.'">
                            <img src="'.$rekord3[3].'" alt="Tekst alternatywny" />
                            <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            </p>
                        </li>';
                        $rekord4[$id_zdjecia-1]=$rekord3[3];
                        $id_zdjecia=$id_zdjecia+1;
                      }
                    $suma=$id_zdjecia;
                    echo '</ul>

                    <ul class="thumbnails_">';
                    $id_zdjecia=1;
                    while ($id_zdjecia<$suma){
                      echo '<li class="fota"><a href="#z'.$id_zdjecia.'"><img src="'.$rekord4[$id_zdjecia-1].'" alt="Tekst alternatywny" /></a></li>';
                      $id_zdjecia=$id_zdjecia+1;
                    }
                  echo' </ul>
                </div>';
            }
            else{
                echo '';
            }
          }
         ?>
    </div>
</div>
<div class="clear">

</div>
<br><br>
  <div class="container">
    <div class="comments">
      <h3>Komentarze:</h3>
      <?php
        $sql2 = "SELECT * from komentarze where id_newsa=$wartosc"; // 2
        $query2 = $polaczenie->query($sql2);
        while ($rekord2 = mysqli_fetch_array($query2)) {
          echo '<div class="container comment-block"><h3>Autor: '.$rekord2[1].' Data: '.$rekord2[3].'</h3><br/><div class="news-text">'.nl2br($rekord2[2]).'</div></div>'; // 2
        }
       ?>
    </div>
    <form class="add-comment" action="dodaj-komentarz.php" method="post">
      <h3>Dodaj swoj komentarz: </h3>
      <br/>autor <input type="text" name="autor">
      <br/>treść <textarea name="tresc" rows="10" cols="50"></textarea>
      <br/><img src="captcha.php" alt="captcha" /> Przepisz kod z obrazka: <input type="text" name="kod">
      <br><br><input type="submit" value="Dodaj"></form>
    </form>
  </div>
  <br>
<?php require_once("stopka.php"); ?>
