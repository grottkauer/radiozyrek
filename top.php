<?php include('naglowek.php');
require_once("connect.php"); // 1
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);



//echo $najstarszy_numer;

// Notowania od 3 przed do bieżącego notowania i ostatniego notowania
$sql10 = "SELECT * from notowania_top order by numer_not desc limit 1"; // 2
$query10 = $polaczenie->query($sql10);
$rekordzista = mysqli_fetch_array($query10);
$current_year = date('Y', strtotime(''.$rekordzista[1].''));
if (isset($_GET['id'])) {
  $used_year = $_GET['id'];
}
else $used_year = $current_year;
// Numer notowania
$wartosc = $used_year - 2014;

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
          echo '<li class= "current-not"><h3><a href="top.php?id='.$lp.'">'.$lp.'</a></h3></li>';
        }
        else {
          echo '<li><h3><a href="top.php?id='.$lp.'">'.$lp.'</a></h3></li>';
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
<h1>TOP WSZECHCZASÓW <?php echo $used_year; // 2018  ?></h1>
<div class="terminarz">
  <table class="table-calendar">
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
    $sql = 'SELECT * from notowania_top where data>=STR_TO_DATE("'.$used_year.'-01-01","%Y-%m-%d")
        order by numer_not ASC'; // 2
    $query = @$polaczenie->query($sql);
    $rekord = mysqli_fetch_array($query);
    $najstarszy_numer = $rekord[2];
    // Najnowszy numer
    $sql = 'SELECT * from notowania_top where data<=STR_TO_DATE("'.$used_year.'-12-31","%Y-%m-%d") order by numer_not DESC LIMIT 1'; // 2
    $query = @$polaczenie->query($sql);
    $rekord = mysqli_fetch_array($query);
    $najnowszy_numer = $rekord[2];

    $tekst = ' ';
    $sql = "SELECT * from notowania_top where numer_not=$wartosc order by pozycja asc"; // 2
    $query = $polaczenie->query($sql);
    while($rekord = mysqli_fetch_array($query))
    {
      $lp = $rekord[4];
      $id_utworu = $rekord[3];
      // Obliczanie liczby tygodni każdego utworku

      // dla TOP 30 i POCZEKALNI
      if ($rekord[4]<=100) {
        $sql7 = "SELECT * FROM notowania_top WHERE id_utworu=$id_utworu AND pozycja<=100 AND numer_not<=$rekord[2]";
        $query7 = $polaczenie->query($sql7);
        $lTyg = mysqli_num_rows($query7);
      }
      else {
        $sql7 = "SELECT * FROM notowania WHERE id_utworu=$id_utworu AND pozycja>100 AND numer_not<=$rekord[2]";
        $query7 = $polaczenie->query($sql7);
        $lTyg = mysqli_num_rows($query7);
      }

      // Obliczanie zmiany miejsca i jego ostatniej pozycji
      $nr_not = $wartosc;
      $miejsce = $rekord[4];
      if ($lTyg==1) {
        $zmiana="N";
        $ostatni="N";
      }
      else {
        $ostatni = 0;
        $sql5 = "SELECT * from notowania_top WHERE numer_not = $nr_not-1 AND id_utworu = $id_utworu";
        $query5 = $polaczenie->query($sql5);
        $utworek = mysqli_fetch_array($query5);
        $ostatni = $utworek[4];
        if (($zmiana=$ostatni-$miejsce) > 0) {
          $zmiana = "+$zmiana";
        }
        if (($ostatni>100 && $miejsce<=100) || $ostatni==0) {
          if ($ostatni==0) {
            $ostatni = "RE";
            $zmiana = "RE";
          }
          else{
            $zmiana = "N";
          }
        }
      }


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
      $tekst.= '<tr class="col-calendar">
        <td class="event-name"><a href="utwory.php?id='.$id_utworu.'"><img src="'.$utworki[3].' " alt="Fotka probna"/></a></td>
        <td class="lp">'.$lp.'</td>
        <td class="date"><a href="utwory.php?id='.$utwory2[0].'">'.$nazwa_utworu.'</a></td>
        <td class="autor"><a href="wykonawcy.php?id='.$utwory2[0].'">'.$wykonawca.'</a></td>
        <td class="lp">'.$ostatni.'</td>
        <td class="lp">'.$zmiana.'</td>
        <td class="lp">'.$lTyg.'</td>
      </tr>';
      }
      else {
        $tekst.= '<tr class="col-calendar">
          <td class="event-name"><a href="utwory.php?id='.$id_utworu.'"><img src="img/logo.jpg" alt="Fotka probna"/></a></td>
          <td class="lp">'.$lp.'</td>
          <td class="date"><a href="utwory.php?id='.$utwory2[0].'">'.$nazwa_utworu.'</a></td>
          <td class="autor"><a href="wykonawcy.php?id='.$utwory2[0].'">'.$wykonawca.'</a></td>
          <td class="lp">'.$ostatni.'</td>
          <td class="lp">'.$zmiana.'</td>
          <td class="lp">'.$lTyg.'</td>
        </tr>';
      }



    }
    $tekst .= '</table></div>';
    echo $tekst;

     ?>
  </table>

<?php include('stopka.php'); ?>
