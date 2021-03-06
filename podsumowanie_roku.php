<?php include('naglowek.php');
require_once("connect.php"); // 1
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);



//echo $najstarszy_numer;

// Notowania od 3 przed do bieżącego notowania i ostatniego notowania
$sql10 = "SELECT * from notowania order by numer_not desc limit 1"; // 2
$query10 = $polaczenie->query($sql10);
$rekordzista = mysqli_fetch_array($query10);
$current_year = date('Y', strtotime(''.$rekordzista[1].''));
if (isset($_GET['id'])) {
  $used_year = $_GET['id'];
}
else $used_year = $current_year;

// Lista lat podsumowania
if ($used_year>2014) {
  $lp = $used_year - 3;
  // LATA
  echo '<div class="slider">
		<a href="#" class="prev"></a>
		<div class="wrapper">
			<ul class="wrapper_list">';

      if ($lp<2015) $lp=2015;
      while ($lp<=$current_year) {
        if ($lp == $used_year) {
          echo '<li class= "current-not"><h3><a href="podsumowanie_roku.php?id='.$lp.'">'.$lp.'</a></h3></li>';
        }
        else {
          echo '<li><h3><a href="podsumowanie_roku.php?id='.$lp.'">'.$lp.'</a></h3></li>';
        }

        $lp++;
      }
      echo '</ul>
		</div>
		<a href="#" class="next"></a>

	</div>
  ';
}
 ?>
<h1>PODSUMOWANIE ROKU <?php echo $used_year; // 2018  ?></h1>
<div class="terminarz">
  <table class="table-calendar">
    <caption>Podsumowanie TOP 30:</caption>
    <tr class="col-calendar">
      <th colspan="7">
        <?php echo $used_year;  ?></h1>
      </th>
    </tr>
    <tr class="col-calendar">
      <td class="event-name">
        Fota
      </td>
      <td class="lp">
        Lp.
      </td>
      <td class="date">
        Tytuł
      </td>
      <td class="autor">
        Autor
      </td>
      <td class="lp">
        Punkty
      </td>
      <td class="lp">
        Max. poz.
      </td>
      <td class="lp">
        L. tyg.
      </td>
    </tr>
    <?php

    // Pobranie utworów z 2018 roku
    $sql = 'SELECT * from notowania where data>=STR_TO_DATE("'.$used_year.'-01-01","%Y-%m-%d")
        order by numer_not ASC'; // 2
    $query = @$polaczenie->query($sql);
    $rekord = mysqli_fetch_array($query);
    $najstarszy_numer = $rekord[2];
    // Najnowszy numer
    $sql = 'SELECT * from notowania where data<=STR_TO_DATE("'.$used_year.'-12-31","%Y-%m-%d") order by numer_not DESC LIMIT 1'; // 2
    $query = @$polaczenie->query($sql);
    $rekord = mysqli_fetch_array($query);
    $najnowszy_numer = $rekord[2];

    // Sumowanie poprzed kwerendę punktów i ich sortowanie w TOP30

    echo '<tr class="col-calendar"><th colspan="3">PODSUMOWANIE ROKU</th></tr>';
    $lp = 1;
        $sql4 = "SELECT id_utworu, SUM(31-miejsce) AS zabawa from notowania where (numer_not BETWEEN $najstarszy_numer AND $najnowszy_numer) AND miejsce<31 group by id_utworu order by SUM(31-miejsce) DESC LIMIT 50"; // 2
        $query4 = @$polaczenie->query($sql4);

        while ($utwory = mysqli_fetch_array($query4)){
          $id_utworu = $utwory['id_utworu'];

          // Obliczanie maksymalnej pozycji każdego utworu
          $sql5 = "SELECT MIN(miejsce) AS max_poz FROM notowania WHERE id_utworu=$id_utworu AND (numer_not BETWEEN $najstarszy_numer AND $najnowszy_numer)";
          $query5 = @$polaczenie->query($sql5);
          $wynik = mysqli_fetch_array($query5);
          $max_poz = $wynik['max_poz'];

          // Obliczanie liczby tygodni każdego utworku
          $sql7 = "SELECT * FROM notowania WHERE id_utworu=$id_utworu AND miejsce<31 AND (numer_not BETWEEN $najstarszy_numer AND $najnowszy_numer)";
          $query7 = $polaczenie->query($sql7);
          $lTyg = mysqli_num_rows($query7);
          // Wczytanie nazwy utworu z bazy
          $sql2 = "SELECT * from utwory where id=$id_utworu"; // 2
          $query2 = @$polaczenie->query($sql2);
          $utwory2 = mysqli_fetch_array($query2);

          $nazwa_utworu = $utwory2[2];
          $wykonawca = $utwory2[3];

          // Dodawanie fotek obok utworów
          $sql6 = "SELECT * from obrazki WHERE id_utworu = $id_utworu";
          $query6 = $polaczenie->query($sql6);
          if($utworki = mysqli_fetch_array($query6))
          {
            echo '<tr class="col-calendar">
              <td class="event-name"><a href="utwory.php?id='.$id_utworu.'"><img src="'.$utworki[3].' " alt="Fotka probna"/></a></td>
              <td class="lp">'.$lp.'</td>
              <td class="date"><a href="utwory.php?id='.$utwory2[0].'">'.$nazwa_utworu.'</a></td>
              <td class="autor"><a href="wykonawcy.php?id='.$utwory2[0].'">'.$wykonawca.'</a></td>
              <td class="lp">'.$utwory['zabawa'].'</td>
              <td class="lp">'.$max_poz.'</td>
              <td class="lp">'.$lTyg.'</td>
              </tr>';
          }
          else{
          echo '<tr class="col-calendar">
            <td class="event-name"><a href="utwory.php?id='.$id_utworu.'"><img src="img/logo.jpg " alt="Fotka probna" width=120px; height=95px;/></a></td>
            <td class="lp">'.$lp.'</td>
            <td class="date"><a href="utwory.php?id='.$utwory2[0].'">'.$nazwa_utworu.'</a></td>
            <td class="autor"><a href="wykonawcy.php?id='.$utwory2[0].'">'.$wykonawca.'</a></td>
            <td class="lp">'.$utwory['zabawa'].'</td>
            <td class="lp">'.$max_poz.'</td>
            <td class="lp">'.$lTyg.'</td>
          </tr>';
        }
          //echo 'Utwór: '.$nazwa_utworu.' '.$utwory['zabawa'].'<br>';
          $lp++;
        }

     ?>
  </table>



  <div class="terminarz">
    <table class="table-calendar">
      <caption>Podsumowanie POCZEKALNI:</caption>
      <tr class="col-calendar">
        <th colspan="4">
          <?php echo $used_year;  ?>
        </th>
      </tr>
      <tr class="col-calendar">
        <td class="lp">
          Lp.
        </td>
        <td class="date">
          Tytuł
        </td>
        <td class="event-name">
          Autor
        </td>
        <td class="lp">
          Punkty
        </td>
        <td class="lp">
          Max. poz.
        </td>
        <td class="lp">
          L. tyg.
        </td>
      </tr>
      <?php


      // Sumowanie poprzed kwerendę punktów i ich sortowanie w POCZEKALNI

      echo '<tr class="col-calendar"><th colspan="3">PODSUMOWANIE ROKU</th></tr>';
      $lp = 1;
          $sql4 = "SELECT id_utworu, SUM(51-miejsce) AS zabawa from notowania where (numer_not BETWEEN $najstarszy_numer AND $najnowszy_numer) AND miejsce>30 group by id_utworu order by SUM(51-miejsce) DESC LIMIT 30"; // 2
          $query4 = @$polaczenie->query($sql4);
          while ($utwory = mysqli_fetch_array($query4)){
            $id_utworu = $utwory['id_utworu'];
            // Obliczanie maksymalnej pozycji każdego utworu
            $sql5 = "SELECT MIN(miejsce) AS max_poz FROM notowania WHERE id_utworu=$id_utworu AND miejsce>30 AND (numer_not BETWEEN $najstarszy_numer AND $najnowszy_numer)";
            $query5 = @$polaczenie->query($sql5);
            $wynik = mysqli_fetch_array($query5);
            $max_poz = $wynik['max_poz'];
            // Obliczanie liczby tygodni każdego utworku
            $sql7 = "SELECT * FROM notowania WHERE id_utworu=$id_utworu AND miejsce>30 AND (numer_not BETWEEN $najstarszy_numer AND $najnowszy_numer)";
            $query7 = $polaczenie->query($sql7);
            $lTyg = mysqli_num_rows($query7);
            // Wczytanie nazwy utworu z bazy
            $sql2 = "SELECT * from utwory where id=$id_utworu"; // 2
            $query2 = @$polaczenie->query($sql2);
            $utwory2 = mysqli_fetch_array($query2);

            $nazwa_utworu = $utwory2[2];
            $wykonawca = $utwory2[3];

            echo '<tr class="col-calendar">
              <td class="lp">'.$lp.'</td>
              <td class="date"><a href="utwory.php?id='.$utwory2[0].'">'.$nazwa_utworu.'<a/></td>
              <td class="autor"><a href="wykonawcy.php?id='.$utwory2[0].'">'.$wykonawca.'</a></td>
              <td class="lp">'.$utwory['zabawa'].'</td>
              <td class="lp">'.$max_poz.'</td>
              <td class="lp">'.$lTyg.'</td>
            </tr>';
            //echo 'Utwór: '.$nazwa_utworu.' '.$utwory['zabawa'].'<br>';
            $lp++;
          }

       ?>
    </table>
<?php include('stopka.php'); ?>
