<?php include('naglowek.php');
include("connect.php");
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
$wartosc = $_GET['id'];
$sql = "SELECT * from utwory where id=$wartosc"; // 2
$query = $polaczenie->query($sql);
$rekord = mysqli_fetch_array($query);
$wykonawca = $rekord[3];

//echo $wykonawca;

?>
<h1> <?php $wykonawca ?> NA MOJEJ LP</h1>
<div class="historia-utworu">
  <table class="table-calendar">
    <caption>Utwory wykonawcy <?php echo $wykonawca; ?>: </caption>
    <tr class="col-calendar">
      <td class="lp">
        Lp.
      </td>
      <td class="date">
        Autor
      </td>
      <td class="date">
        Tytuł
      </td>
    </tr>

    <?php
    $sql2 = "SELECT * from utwory where wykonawca LIKE '%$wykonawca%' order by wykonawca  asc"; // 2
    $query2 = $polaczenie->query($sql2);
    $tresc="";
    $lp=1;
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
    $tresc.='</table></div>';
    echo $tresc;
     ?>
     <?php
     require_once("stopka.php");
      ?>
