<?php
require_once("connect.php"); // 1
require_once("naglowek.php");
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
$sql = "SELECT * from newsy order by data desc limit 50"; // 2
$query = @$polaczenie->query($sql);
echo'<br/><br/><br/><br/><br/><br/><div class="container"><table class="table-calendar">
  <caption>Archiwum wpisow:</caption>
  <tr class="col-calendar">
    <th colspan="4">
      2017/2018
    </th>
  </tr>
  <tr class="col-calendar">
    <td class="lp">
      Lp.
    </td>
    <td class="date">
      Data
    </td>
    <td class="event-name">
      Tytuł:
    </td>
    <td class="date">
      Kategoria
    </td>
  </tr>';
  $lp=1;
while($rekord = mysqli_fetch_array($query))
{
  $sql2 = "SELECT * from rodzaj_newsa where id=$rekord[5]"; // 2
  $query2 = @$polaczenie->query($sql2);
  $rekord2 = mysqli_fetch_array($query2);
echo '<tr class="col-calendar">
  <td class="lp">'.$lp.'</td>
  <td class="date">'.$rekord[3].'</td>
  <td class="event-name"><a href="news.php?id='.$rekord[0].'">'.$rekord[1].'</a></td>
  <td class="date">'.$rekord2[1].'</td>
</tr>'; // 3
$lp+=1;
}
echo'</table></div><br/><br/>';
require_once("stopka.php");
?>
