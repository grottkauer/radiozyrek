<?php include('naglowek.php');
include("connect.php");
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
$wartosc = $_GET['id'];
$sql = "SELECT * from utwory where id=$wartosc"; // 2
$query = $polaczenie->query($sql);
$rekord = mysqli_fetch_array($query);
$nazwa_utworu = $rekord[2];
$wykonawca = $rekord[3];
$sql2 = "SELECT * from notowania where id_utworu=$wartosc order by data asc"; // 2
$query2 = $polaczenie->query($sql2);
$rekord2 = mysqli_fetch_array($query2);
$data = $rekord2[1];
$nr_first = $rekord2[2];
$liczTyg = mysqli_num_rows($query2);
//echo $data;


?>

<h1>NOTOWANIA NA MOJEJ LP</h1>
<div class="historia-utworu">
  <table class="table-calendar">
    <caption> <?php // Dodawanie fotek obok utworów
    $sql6 = "SELECT * from obrazki WHERE id_utworu = $wartosc";
    $query6 = $polaczenie->query($sql6);
    if($utwory = mysqli_fetch_array($query6))
    {
      echo '<div class="notowanie-top"><div class="col-one-third"><a href="utwory.php?id='.$wartosc.'"><img src="'.$utwory[3].'" alt="Fotka probna" /></a></div>';
      echo '<div class="col-two-third">Historia utworu: <br>'.$nazwa_utworu.' - <a href="wykonawcy.php?id='.$wartosc.'">'.$wykonawca.'</a></div></div>';
    }
    else {
      echo '<div class="notowanie-top"><div class="col-one-third"><a href="utwory.php?id='.$wartosc.'"><img src="img/logo.jpg" alt="Fotka probna" /></a></div>';
      echo '<div class="col-two-third">Historia utworu: <br>'.$nazwa_utworu.' - <a href="wykonawcy.php?id='.$wartosc.'">'.$wykonawca.'</a></div></div>';
    } ?> </caption>
    <tr class="col-calendar">
      <th colspan="4">
        DATA WEJŚCIA NA LISTĘ <?php echo $data; ?> - LICZBA TYGODNI <?php echo $liczTyg; ?> - MAX POS
        <?php
        // Obliczanie maksymalnej pozycji każdego utworu
        $sql5 = "SELECT MIN(miejsce) AS max_poz FROM notowania WHERE id_utworu=$wartosc";
        $query5 = @$polaczenie->query($sql5);
        $wynik = mysqli_fetch_array($query5);
        $max_poz = $wynik['max_poz'];
        echo $max_poz;
         ?>
      </th>
    </tr>
    <tr class="col-calendar">
      <td class="lp">
        Nr. not
      </td>
      <td class="date">
        Miejsce
      </td>
      <td class="lp">
        Zmiana
      </td>
    </tr>
<?php
$tresc="";
$sql3 = "SELECT * from notowania where id_utworu=$wartosc order by data"; // 2
$query3 = $polaczenie->query($sql3);
//$ostatni=0;
while ($rekord3 = mysqli_fetch_array($query3)) {
  $nr_not = $rekord3[2];
  $miejsce = $rekord3[5];
  if ($liczTyg==1 || $nr_not==$nr_first) {
    $zmiana="N";
  }
  else {
    $sql5 = "SELECT * from notowania WHERE numer_not = $nr_not-1 AND id_utworu = $rekord3[4]";
    $query5 = $polaczenie->query($sql5);
    $utworek = mysqli_fetch_array($query5);
    $ostatni = $utworek[5];
    if ($ostatni==0) {
      $zmiana = "RE";
    }
    else if (($zmiana=$ostatni-$miejsce) > 0) {
      $zmiana = "+$zmiana";
    }
  }

  $tresc.='<tr class="col-calendar">
    <td class="lp"><a href="notowanie.php?id='.$nr_not.'">'.$nr_not.'</a></td>
    <td class="date">'.$miejsce.'</td>
    <td class="lp">'.$zmiana.'</td>
  </tr>';
}
echo $tresc;

 ?>
 </table></div>



  <div id="barchart_values" style="width: 900px; height: 300px;"></div>
<h1></h1>
<div class="clear">

</div>
<?php include('stopka.php'); ?>
