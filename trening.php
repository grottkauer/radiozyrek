
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml" lang="pl-PL">
<head>
  <meta name="description" content="SECOM - sieci, serwery, strony www, serwis, naprawa, komputery" />
  <meta name="keywords" content="sieci, serwery, strony www, serwis, naprawa, komputery" />
  <meta name="robots" content="index,follow" />
  <meta name="copyright" content="Copyright 1999-2012 secom.pl  - All rights reserved" />
  <meta name="revisit after" content="7 days" />
  <meta name="author" content="I.Sekuła" />
  <meta name="generator" content="MShtml 6.00.2600.0" />
  <link href="favicon.ico" rel="shortcut icon" />
  <title>SECOM - Prosty Slider. Demo. Skypty JavaScript.</title>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <style type="text/css">
    body 		{margin:20px; padding:0; }
    h3			{ padding-top:10px; }
    h3 a 		{ color:#000; text-decoration:none; }
    h3 a:hover	{ color:#000; text-decoration:underline; }
    hr 			{ height:0px; line-height:0px; font-size:0px; border-style:solid; border-width:0px; border-top-width:1px; border-color:#222; }
    /*S L I D E R*/
    .slider				{ width:916px; overflow:hidden; clear:both; margin:0; padding:0; border-width:1px; border-style:solid; border-color:#d4d4d4; }
    .wrapper			{ width:816px; height:80px; float:left; position:relative; overflow:hidden; margin:0 auto; padding:20px 0; }
    .wrapper_list 		{ position:absolute; overflow:hidden; margin:0; padding:0; list-style-type:none; }
    .wrapper_list li	{ width:200px; display:none; float:left; margin:0; padding:0 2px; cursor:pointer; }
    .wrapper_list li img{ width:200px; }
    .slider .prev 		{ width:32px; height:80px; float:left; padding:0; margin:20px 18px 0 0; cursor:pointer; display:block; background: url('prev.png') no-repeat top left; /*outerWidth:50px*/}
    .slider .next 		{ width:32px; height:80px; float:left; padding:0; margin:20px 0 0 18px; cursor:pointer; display:block; background: url('next.png') no-repeat top left; /*outerWidth:50px*/}
    .img_zoom			{ clear:both; text-align:center; margin:0; cursor:pointer; }
    .img_zoom img		{ margin:0 0 20px 0; }
</style>
</head>
<body>
	<h2>Prosty Slider. Demo.</h2>
	<hr />
	<h3 style="">Simple 1.0. Wersja demonstracyjna. Copyright <a href="http://secom.pl/">secom.pl</a></h3>
	<p style="padding-bottom:10px">Poniższe obrazki są własnością Nivo Slider. Wykorzystano je tylko w celach pokazowo-edukacyjnych.
	<br />Kliknij na miniaturę, aby wyświetlić oryginalny obrazek. Kliknij na Następny, Poprzedni, aby przewinąć obrazki w lewo lub w prawo.</p>
	<div class="slider">
		<a href="#" class="prev"></a>
		<div class="wrapper">
			<ul class="wrapper_list">
				<li>1</li>
				<li><img src="2.jpg" /></li>
				<li><img src="3.jpg" /></li>
				<li><img src="4.jpg" /></li>
				<li><img src="5.jpg" /></li>
				<li><img src="6.jpg" /></li>
				<li><img src="7.jpg" /></li>
				<li><img src="8.jpg" /></li>
			</ul>
		</div>
		<a href="#" class="next"></a>
		<div class="img_zoom"></div>
	</div>
	<br />
	<div class="slider" style="background:#000;">
		<a href="#" class="prev"></a>
		<div class="wrapper" style="height:133px;">
			<ul class="wrapper_list">
				<li><img src="01.jpg" /></li>
				<li><img src="02.jpg" /></li>
				<li><img src="03.jpg" /></li>
				<li><img src="04.jpg" /></li>
				<li><img src="05.jpg" /></li>
				<li><img src="06.jpg" /></li>
				<li><img src="07.jpg" /></li>
				<li><img src="08.jpg" /></li>
			</ul>
		</div>
		<a href="#" class="next"></a>
		<div class="img_zoom"></div>
	</div>


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
</body></html>
