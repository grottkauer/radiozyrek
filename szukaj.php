<?php
require_once("connect.php");
require_once("naglowek.php");
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
echo "<br><br><br>";
echo '<h1>WYNIKI WYSZUKIWANIA</h1>';

$rodzaj = $_POST['rodzaj'];
$wyszukiwanie = $_POST['wartosc_wysz'];
switch ($rodzaj) {
  case 'Notowanie':
    header("Location: notowanie.php?id={$wyszukiwanie}");
    break;
  case 'Wykonawca':
  $lp=1;
  $tresc='<table class="table-calendar">';
  $sql2 = "SELECT * from utwory where wykonawca LIKE '%$wyszukiwanie%' order by wykonawca  asc"; // 2
  $query2 = $polaczenie->query($sql2);
  while($rekord2 = mysqli_fetch_array($query2))
  {
    $wykonawca = $rekord2[3];
    $utwor = $rekord2[2];

    $tresc.='<tr class="col-calendar">
      <td class="lp">'.$lp.'</td>
      <td class="date">'.$wykonawca.'</td>
      <td class="date"><a href="utwory.php?id='.$rekord2[0].'">'.$utwor.'</a></td>
    </tr>';
    $lp++;
  }
  $tresc.='</table>';
  echo $tresc;
    break;
  case 'Utwor':
  $lp=1;
  $tresc='<table class="table-calendar">';
  $sql2 = "SELECT * from utwory where tytul LIKE '%$wyszukiwanie%' order by tytul asc"; // 2
  $query2 = $polaczenie->query($sql2);
  while($rekord2 = mysqli_fetch_array($query2))
  {
    $wykonawca = $rekord2[3];
    $utwor = $rekord2[2];

    $tresc.='<tr class="col-calendar">
      <td class="lp">'.$lp.'</td>
      <td class="date">'.$wykonawca.'</td>
      <td class="date"><a href="utwory.php?id='.$rekord2[0].'">'.$utwor.'</a></td>
    </tr>';
    $lp++;
  }
  $tresc.='</table>';
  echo $tresc;
    break;

  default:
    echo "Podano złe wyszukiwanie";
    break;
}
?>
