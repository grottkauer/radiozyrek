<?php include('naglowek.php');
require_once("connect.php"); // 1
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

 ?>
<h1></h1>
  <div class="terminarz">
    <table class="table-calendar">
      <caption>Podsumowanie POCZEKALNI:</caption>
      <tr class="col-calendar">
        <th colspan="4">
          CAŁOŚĆ
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
      // Sumowanie poprzed kwerendę punktów i ich sortowanie w TOP30

    //  echo '<tr class="col-calendar"><th colspan="3">PODSUMOWANIE ROKU</th></tr>';
      $lp = 1;
          $sql4 = "SELECT id_utworu, SUM(51-miejsce) AS zabawa from notowania where miejsce>30 group by id_utworu order by SUM(51-miejsce) DESC LIMIT 50"; // 2
          $query4 = @$polaczenie->query($sql4);
          while ($utwory = mysqli_fetch_array($query4)){
            $id_utworu = $utwory['id_utworu'];
            // Obliczanie maksymalnej pozycji każdego utworu
            $sql5 = "SELECT MIN(miejsce) AS max_poz FROM notowania WHERE id_utworu=$id_utworu AND miejsce>30";
            $query5 = @$polaczenie->query($sql5);
            $wynik = mysqli_fetch_array($query5);
            $max_poz = $wynik['max_poz'];

            // Obliczanie liczby tygodni każdego utworku
            $sql7 = "SELECT * FROM notowania WHERE id_utworu=$id_utworu AND miejsce>30";
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
              <td class="event-name"><a href="utwory.php?id='.$utwory2[0].'"><img src="'.$utworki[3].' " alt="Fotka probna" width=120px; height=95px;/></a></td>
              <td class="lp">'.$lp.'</td>
              <td class="date"><a href="utwory.php?id='.$utwory2[0].'">'.$nazwa_utworu.'</a></td>
              <td class="autor"><a href="wykonawcy.php?id='.$utwory2[0].'">'.$wykonawca.'</a></td>
              <td class="lp">'.$utwory['zabawa'].'</td>
              <td class="lp">'.$max_poz.'</td>
              <td class="lp">'.$lTyg.'</td>
            </tr>';
          }
          else {
            echo '<tr class="col-calendar">
              <td class="event-name"><a href="utwory.php?id='.$utwory2[0].'"><img src="img/logo.jpg" alt="Fotka probna" width=120px; height=95px;/></a></td>
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
    </table></div>
<?php include('stopka.php'); ?>
