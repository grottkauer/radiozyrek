<?php include('naglowek.php');
include("connect.php");
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
$wartosc = $_GET['id'];
// Notowania od 3 przed do bieżącego notowania i ostatniego notowania
$sql10 = "SELECT * from notowania order by numer_not desc limit 1"; // 2
$query10 = $polaczenie->query($sql10);
$rekordzista = mysqli_fetch_array($query10);
$ostatni = $rekordzista[2];

if ($ostatni>3) {
  $lp = $wartosc - 3;
  echo '<div class="slider">
		<a href="#" class="prev"></a>
		<div class="wrapper">
			<ul class="wrapper_list">';

      while ($lp<=$ostatni) {
        if ($lp == $wartosc) {
          echo '<li class= "current-not"><h3><a href="notowanie.php?id='.$lp.'">'.$lp.'</a></h3></li>';
        }
        else {
          echo '<li><h3><a href="notowanie.php?id='.$lp.'">'.$lp.'</a></h3></li>';
        }

        $lp++;
      }
      echo '</ul>
		</div>
		<a href="#" class="next"></a>

	</div>';
}
else {
  $lp = 1;
  echo '<div class="slider">
		<a href="#" class="prev"></a>
		<div class="wrapper">
			<ul class="wrapper_list">';

      while ($lp<=($wartosc+3)) {
        echo '<li><a href="notowanie.php?id='.$lp.'">'.$lp.'</a></li>';
        $lp++;
      }
      echo '</ul>
		</div>
		<a href="#" class="next"></a>
		<div class="img_zoom"></div>
	</div>';
}

$sql10 = "SELECT * from notowania where numer_not=$wartosc order by miejsce asc"; // 2
$query10 = $polaczenie->query($sql10);
$rekordzista = mysqli_fetch_array($query10);
$data = $rekordzista[1];
$tekst= '<div class="terminarz">
  <table class="table-calendar">
    <caption>NOTOWANIE NR: '.$wartosc.'</caption>';
$tekst.='<tr class="col-calendar">
      <th colspan="7">'.
      $data.'
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
        Ostatnio
      </td>
      <td class="lp">
        Zmiana
      </td>
      <td class="lp">
        L. tyg.
      </td>
    </tr>';
$sql = "SELECT * from notowania where numer_not=$wartosc order by miejsce asc"; // 2
$query = $polaczenie->query($sql);
while($rekord = mysqli_fetch_array($query))
{
  $lp = $rekord[5];
  $id_utworu = $rekord[4];
  // Obliczanie liczby tygodni każdego utworku

  // dla TOP 30 i POCZEKALNI
  if ($rekord[5]<=30) {
    $sql7 = "SELECT * FROM notowania WHERE id_utworu=$id_utworu AND miejsce<=30 AND numer_not<=$rekord[2]";
    $query7 = $polaczenie->query($sql7);
    $lTyg = mysqli_num_rows($query7);
  }
  else {
    $sql7 = "SELECT * FROM notowania WHERE id_utworu=$id_utworu AND miejsce>30 AND numer_not<=$rekord[2]";
    $query7 = $polaczenie->query($sql7);
    $lTyg = mysqli_num_rows($query7);
  }

  // Obliczanie zmiany miejsca i jego ostatniej pozycji
  $nr_not = $wartosc;
  $miejsce = $rekord[5];
  if ($miejsce==31) {
    $tekst.='<tr class="col-calendar">
      <th colspan="7">
        <h2>POCZEKALNIA</h2>
      </th>
    </tr>';
  }
  if ($lTyg==1) {
    $zmiana="N";
    $ostatni="N";
  }
  else {
    $ostatni = 0;
    $sql5 = "SELECT * from notowania WHERE numer_not = $nr_not-1 AND id_utworu = $id_utworu";
    $query5 = $polaczenie->query($sql5);
    $utworek = mysqli_fetch_array($query5);
    $ostatni = $utworek[5];
    if (($zmiana=$ostatni-$miejsce) > 0) {
      $zmiana = "+$zmiana";
    }
    if (($ostatni>30 && $miejsce<=30) || $ostatni==0) {
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
<script type="text/javascript">
// Script: Simple Slider 1.0. Require jQuery.
// Author: Ireneusz Sekula, http://secom.pl, 2012-08-10
// Free to use and abuse under the MIT license.

$(function() {
// Opcje konfiguracyjne
    var settings = {
        Speed:   200,
        Opac_E:   60,
        Opac_M:  0.6
    };
// Obsluga Slidera
    var sliders = $('div.slider');
    sliders.each(function() {
// Zmienne
        var _Slider = $(this); // wskazanie na aktualny Slider
        var _Wrapper = $('div.wrapper', _Slider);
        var _List = $('ul.wrapper_list', _Slider);
        var _Item = $('li', _List);
        var _ImgZoom = $('div.img_zoom', _Slider);
        var AllItems = _Item.length;
        var ItemWidth = parseInt(_Item.eq(0).outerWidth());
        var ListWidth = ItemWidth*AllItems;
        var WrapperWidth = parseInt(_Wrapper.eq(0).width());
        var VisibleItems = parseInt(WrapperWidth/ItemWidth);
        var Offset = parseInt(_Item.eq(0).outerWidth(true));
        //var Offset = ItemWidth + parseInt(_Item.eq(0).css('margin-left')) + parseInt(_Item.eq(0).css('margin-right'));
        var PrevClickedItem = -1;
        $(_List).css('width',ListWidth);
        $(_Item).show();
// Obsluga przewijania w lewo, w prawo (klikniecia przycisków Poprzedni, Nastepny)
        if (ListWidth > WrapperWidth) {
            var maxOffsetLeft = Offset * AllItems - Offset * VisibleItems;
            // Przewijanie w lewo (przycisk Nastepny)
            var Next = $('a.next', _Slider).click(function() {
                if (_List.position().left > -maxOffsetLeft) { $(_List).not(':animated').animate({ 'left' : '-='+Offset },settings.Speed); };
                return false;
            });
            // Przewijanie w prawo (przycisk Poprzedni)
            var Prev = $('a.prev', _Slider).click(function() {
                if (_List.position().left<0) { $(_List).not(':animated').animate({ 'left' : '+='+Offset },settings.Speed); };
                return false;
            });
        }
        // Pomijanie przewijania w lewo, w prawo, jezeli na liscie wsywietlane sa jednoczesnie wszystkie jej elementy
        else {
            $('a.next, a.prev', _Slider).click(function() { return false; });
        };
// Obsluga klikniecia miniatury obrazka
        var ItemClick = $(_Item).click(function() {
            var ClickedItem = _Item.index(this);
            CheckClick();
            if (PrevClickedItem != ClickedItem) {
                // Ustawienie przezroczystosci miniatury i wyswietlenie oryginalnego obrazka wedlug wartosci atrybutu src miniatury
                _Item[ClickedItem].style.opacity = settings.Opac_M;
                _Item[ClickedItem].style.filter = 'Alpha(Opacity='+settings.Opac_E+')';
                var ImgSrc = $('img', _Item[ClickedItem]).attr('src');
                $(_ImgZoom).append('<img src="'+ImgSrc+'" title="Click to close Image" />');
                PrevClickedItem = ClickedItem;
            }
            else { PrevClickedItem = -1; }
        });
// Obsluga klikniecia oryginalnego obrazka
        var ImageClick = $('div.img_zoom', _Slider).click(function() {
            CheckClick();
            PrevClickedItem = -1;
        });
// Sprawdzenie stanu Slidera po kliknieciu na miniature lub oryginalny obrazek
        var CheckClick = (function() {
		   // Usuniecie przezroczystosci dla wszystkich obrazkow
		   for (i=0; i<AllItems; i++) {
               _Item[i].style.opacity = 1.0; // z wyjatkiem IE
               _Item[i].style.filter = 'Alpha(Opacity=100)'; // IE
           };
           // Usuniecie oryginalnego obrazka (dokladnie: wszystkich potomkow warstwy rodzica)
           if(_ImgZoom.children().length > 0) { _ImgZoom.children().remove(); };
           return true;
        });
    });
});
</script>
<?php
require_once("stopka.php");
 ?>
