<?php

/* --- OPERACJA NA CIASTECZKACH, DODAJEMY WARTOŚCI */
/* warunek: jeżeli nie ma ciasteczka w pamięci przeglądarki o nazwie licznik_cook, z wartością 1 to: */
if(!$_COOKIE['LicznikCook']){

/* jeżeli plik z bazą danych (licznik.db) istnieje i jest zapisywalny (chmod: 666), to: */
if(file_exists("licznik.db")){
	if(is_writeable('licznik.db')){

	/* pobieramy zawartość tego pliku i podwyższamy jego wartość, np. z 34 na 35 */
	$bdpobierz = file_get_contents("licznik.db") + "1";

	/* otwieramy plik licznik.db - bazę danych */
	$bdzapisz = fopen("licznik.db", "w");

	/* nadpisujemy istniejącą wartość na tą ze zmiennej $bdpobierz, następnie zamykamy */
	fwrite($bdzapisz, $bdpobierz);
	fclose($bdzapisz);
	}
}

/* wysyłamy przeglądarce ciasteczko o nazwie licznik_cook, z wartością 1 (przykładowa wartość) oraz ustawiamy jego ważność na 24 godziny */
setcookie("LicznikCook", '1', time()+60);
}
  /* --- WYŚWIETLAMY ILOŚĆ ODWIEDZIN */
/* sprawdzamy, czy plik bazy danych istnieje */
if(file_exists("licznik.db")){

	/* sprawdzamy, czy plik bazy danych jest zapisywalny (666) */
	if(is_writeable('licznik.db')){

		/* pobieramy plik */
		$bdpokaz = file_get_contents("licznik.db");

		/* wyświetlamy zawartość, czyli ilość odwiedzin */
		echo "<div class='licznik'>Licznik odwiedzin: $bdpokaz".'.</div>';

		/* jeżeli plik nie jest zapisywalny wyświetlamy komunikat o błędzie: */
		}else{echo "Plik nie jest zapisywalny. Ustaw chmody na 666.";}

}else{echo "Plik nie istnieje. Utwórz plik licznik.db i wgraj go na serwer.";}
?>
