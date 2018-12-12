<?php
  require_once("naglowek.php");
  require_once("connect.php"); // 1
  $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
 ?>
 <br><br><br><br><br>
<h1>Galerie zdjec</h1>
<div class="container">
  <div class="col-half">
    <h2>Galerie z nowych wystepow: </h2>
    <?php

    $sql = "SELECT * from newsy order by data desc"; // 2
    $query = @$polaczenie->query($sql);
    while ($rekord = mysqli_fetch_array($query)) {
      $a=0;
      $sql2 = "SELECT * from obrazki order by id_newsa"; // 2
      $query2 = @$polaczenie->query($sql2);
      while($rekord2 = $query2->fetch_array(MYSQLI_NUM)) {
        if ($rekord2[4]==$rekord[0] && $a==0) {
          echo '<a href="photos.php?id='.$rekord[0].'" class="gallery-href"> Tytul: '.$rekord[1].'<br/>Data: '.$rekord[3].'</a>';
          $a+=1;
        }
        else{
          echo '';
        }
      }
    }
     ?>
  </div>
  <div class="col-half">
    <h2>Starsze galerie zdjęć: </h2>
    <?php
    $sql3 = "SELECT * from oldgallery order by data"; // 2
    $query3 = @$polaczenie->query($sql3);
    while ($rekord3 = mysqli_fetch_array($query3)) {
        echo '<a href="old-photos.php?id='.$rekord3[0].'" class="gallery-href"> Tytul: '.$rekord3[1].'<br/>Data: '.$rekord3[2].'</a>';
      }
     ?>
  </div>
</div>
<div class="clear">

</div>
<br>
<?php
/*if (!isset($_SESSION['zalogowany']) || $_SESSION['user']!='admin')
{
    echo ' ';
}
else{
  //Dodawanie galerii
  echo '<div class="news-block">
    <h2>Chcesz dodać starą galerię?</h2>
    <form action="" method="post" class="add-event">
    tytuł: <input type="text" name="tytul">
    <br/>data: <input type="data" name="data" id="input_01"
                    class="datepicker" autofocuss
                    value="2014-08-02"
                    data-valuee="2014-08-08">>
    <br/><input type="submit" value="Dodaj"></form>
  </div>';
  echo '<br><br>

        <div id="container"></div>';
  if(($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_POST['tytul'])))
  {
  $sql5 = "INSERT INTO oldgallery values('','".$_POST['tytul']."','".$_POST['data']."')";
  $query5 = $polaczenie->query($sql5);
  }
  //Usuwanie galerii
  echo '<br><br>

        <div id="container"></div>';
  $sql6 = "SELECT * from oldgallery order by data"; // 2
  $query6 = @$polaczenie->query($sql6);
  echo '<div class="container">
    <br><br>
    <h2>Usun plan zajec</h2>
    <form class="add-event" action="delete-oldgallery.php" method="post">
      <select name="id" >';
      while($rekord6 = mysqli_fetch_array($query6))
      {
      echo '<option value="'.$rekord6[0].'">Data: '.$rekord6[2].'  '.'Tytuł: '.$rekord6[1].'<br>';
      }
      echo '</select><input type="submit" value="Usuń">
    </form>
  </div>';
}*/
 ?>
<br>
<script src="pickadate.js/jquery.1.7.0.js"></script>
<script src="pickadate.js/lib/picker.js"></script>
    <script src="pickadate.js/lib/picker.date.js"></script>
    <script src="pickadate.js/lib/legacy.js"></script>

    <script type="text/javascript">

        var $input = $( '.datepicker' ).pickadate({
            formatSubmit: 'yyyy-mm-dd',
            // min: [2015, 7, 14],
            container: '#container',
            // editable: true,
            closeOnSelect: false,
            closeOnClear: false,
        })

        var picker = $input.pickadate('picker')
        // picker.set('select', '14 October, 2014')
        // picker.open()

        // $('button').on('click', function() {
        //     picker.set('disable', true);
        // });

    </script>
<?php
  require_once("stopka.php");
 ?>
