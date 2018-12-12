<?php
require_once("naglowek.php");
require_once("connect.php");
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
$sql = "SELECT * from newsy"; // 2
$query = @$polaczenie->query($sql);
while($rekord = mysqli_fetch_array($query))
{
$tekst .=  '<option value="'.$rekord[0].'">ID: '.$rekord[0].'  '.'Tytul: '.$rekord[1].'<br>';
}
echo '<h1>Ekran usuwania newsa</h1>';
echo '<div class="container usuwanie"><h2>Wybierz newsa, ktorego chcesz usunac</h2></div>';
echo '<form action="delete.php" method="post" class="delete-news">';
echo '<select name="id" >';
echo $tekst;
echo '</select>';
echo '<input type="submit" value="USUŃ"/>';
echo '</form>';
?>
