<?php include('naglowek.php');
require_once("connect.php"); // 1
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
$wartosc=0;
if (isset($_GET['id'])) {
  $wartosc = $_GET['id'];
  if ($wartosc>0) {
    $wartosc--;
  }

}

function tresc_pasek($l_odp,$l_odp_nastronie,$l_odp_napasku,$a) { //funkcja tworząca nawigację
  //  l_odp - ilość rekordów, l_odp_nastronie - ile machniemy rekordów na jedną stronę,
  // l_odp_napasku - rozmiar paska podzielony przez dwa + aktywna strona, a - numer bieżącej strony
   $l_odp_podz = intval($l_odp/$l_odp_nastronie)+1;
   $l_odp_podz_mod = $l_odp%$l_odp_nastronie;
   if($l_odp_podz_mod>0){++$l_odp_podz;}
   if($a>=$l_odp_podz){$a=$l_odp_podz-1;}
   if($a>1){$tablica['prev']=$a-1;}else {$tablica['prev']=0;}
   if($a<=$l_odp_napasku){$koniec=$l_odp_napasku*2+2;}else{$koniec=$a+$l_odp_napasku+1;}
   if($a<=$koniec-$l_odp_napasku){$star=$a-$l_odp_napasku;}
   if($a>=$l_odp_podz-$l_odp_napasku){$star=$l_odp_podz-$l_odp_napasku*2-1;}
   if($koniec>$l_odp_podz){$koniec=$l_odp_podz;}
   if($star<1){$star=1;}
   for($i=$star;$i<$koniec;++$i){
      if($i<$a){$tablica[]=$i;}
      if($i==$a){$tablica['active'] = $i;}
      if($i>$a){$tablica[]=$i;}
   }
   if($a<$l_odp_podz-1){$tablica['next']=$a+1;}else{$tablica['next']=0;}
   return $tablica;
}
 ?>
<h1></h1>
<div class="terminarz">
  <table class="table-calendar">
    <caption>Podsumowanie TOP 30:</caption>
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
    $tresc="";
    $przerwa=" ___ ";


    // Sumowanie poprzed kwerendę punktów i ich sortowanie w TOP30

    echo '<tr class="col-calendar"><th colspan="3">RANKING TOPKA</th></tr>';
    $lp = 1+(15*$wartosc);
    $max = $lp+15;
    $i=1;
    //echo $wartosc;
        $sql4 = "SELECT id_utworu, SUM(31-miejsce) AS zabawa from notowania where miejsce<31 group by id_utworu order by SUM(31-miejsce) DESC "; // 2
        $query4 = @$polaczenie->query($sql4);
        $liczba_rekordow = mysqli_num_rows($query4);

        $tresc .= '<div class="navigation-box">';
        $nawigacja = tresc_pasek($liczba_rekordow ,15,3,$wartosc+1);
        foreach($nawigacja as $klucz => $wartosc){
         if(is_numeric($klucz)){
            $tresc .= ' <div class="navigation"><a href="ranking_topka.php?id='.$wartosc.'">'.$wartosc.$przerwa.'</a></div>' ;
         }else{
            if($klucz == 'prev'){$tresc .= ' <div class="navigation"><a href="ranking_topka.php?id='.($wartosc).'">poprzednia'.$przerwa.'</a></div> ';}
            if($klucz == 'next'){$tresc .= ' <div class="navigation"><a href="ranking_topka.php?id='.($wartosc).'">następna'.$przerwa.'</a></div> ';}
            if($klucz == 'active'){$tresc .= ' <div class="navigation active_nav"><a href="ranking_topka.php?id='.$wartosc.'"><strong>'.$wartosc.'</strong>'.$przerwa.'</a></div> ';}
         }
      }
      $tresc .= '</div>';


        while ($utwory = mysqli_fetch_array($query4)){
          if ($i>=$lp && $lp<$max) {
            $id_utworu = $utwory['id_utworu'];
            // Obliczanie maksymalnej pozycji każdego utworu
            $sql5 = "SELECT MIN(miejsce) AS max_poz FROM notowania WHERE id_utworu=$id_utworu";
            $query5 = @$polaczenie->query($sql5);
            $wynik = mysqli_fetch_array($query5);
            $max_poz = $wynik['max_poz'];

            // Obliczanie liczby tygodni każdego utworku
            $sql7 = "SELECT * FROM notowania WHERE id_utworu=$id_utworu AND miejsce<31";
            $query7 = $polaczenie->query($sql7);
            $lTyg = mysqli_num_rows($query7);
            // Wczytanie nazwy utworu z bazy
            $sql2 = "SELECT * from utwory where id=$id_utworu"; // 2
            $query2 = @$polaczenie->query($sql2);
            $utwory2 = mysqli_fetch_array($query2);

            $nazwa_utworu = $utwory2[2];
            $wykonawca = $utwory2[3];

            /*echo '<tr class="col-calendar">
              <td class="lp">'.$lp.'</td>
              <td class="date">'.$nazwa_utworu.'</td>
              <td class="event-name">'.$wykonawca.'</td>
              <td class="lp">'.$utwory['zabawa'].'</td>
            </tr>'; */

            // Dodawanie fotek obok utworów
            $sql6 = "SELECT * from obrazki WHERE id_utworu = $id_utworu";
            $query6 = $polaczenie->query($sql6);
            if($utworki = mysqli_fetch_array($query6))
            {

            $tresc.='<tr class="col-calendar">
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
            $tresc.='<tr class="col-calendar">
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
          $i++;
        }

      echo $tresc;
     ?>
  </table></div>

<?php include('stopka.php'); ?>
