
<?php include('naglowek.php'); ?>

<!-- BANNER-->
		<div class="banner">
		</div>
<!-- NOTOWANIE -->
				<div class="notowanie">

						<?php
						require_once("connect.php"); // 1
						$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
						$sql1 = "SELECT * from notowania ORDER BY numer_not DESC LIMIT 1 ";
			      $query = $polaczenie->query($sql1);

						$rekord = mysqli_fetch_array($query);
						$numer_notowania = $rekord[2];
						$data = $rekord[1];

						$sql2 = "SELECT * from notowania WHERE numer_not = $numer_notowania ORDER BY miejsce ASC";
			      $query = $polaczenie->query($sql2);

						$ile = 1;
						echo '<a href="notowanie.php?id='.$numer_notowania.'"><h2>NUMER NOTOWANIA: '.$numer_notowania.'   DATA: '.$data.'</h2></a><br>';
						while($rekord = mysqli_fetch_array($query))
			      {
							$sql3 = "SELECT * from utwory WHERE id = $rekord[4] ";
				      $query2 = $polaczenie->query($sql3);
							$utwor = mysqli_fetch_array($query2);


							// Obliczanie liczby tygodni danego utworu
							if ($ile<=30) {
								$sql4 = "SELECT * from notowania WHERE id_utworu = $rekord[4] AND miejsce<31";
							}
							else {
								$sql4 = "SELECT * from notowania WHERE id_utworu = $rekord[4] AND miejsce>30";
							}

							$query3 = $polaczenie->query($sql4);
							$liczTyg = mysqli_num_rows($query3);

							if ($liczTyg==1) {
								$ostatni = "N";
								$zmiana = "N";
							}
							else {
								$sql5 = "SELECT * from notowania WHERE numer_not = $numer_notowania-1 AND id_utworu = $rekord[4]";
					      $query5 = $polaczenie->query($sql5);
								$utworek = mysqli_fetch_array($query5);
								$ostatni = $utworek[5];
								if ($ostatni==0) {
									$ostatni = "RE";
									$zmiana = "RE";
								}
								else if (($zmiana=$ostatni-$rekord[5]) > 0) {
									$zmiana = "+$zmiana";
								}
							}

							if ($ile == 31) {
								echo "<h2>POCZEKALNIA</h2><BR>";
							}

							// Dodawanie fotek obok utworów
							$sql6 = "SELECT * from obrazki WHERE id_utworu = $rekord[4]";
							$query6 = $polaczenie->query($sql6);
							if($utwory = mysqli_fetch_array($query6))
							{
								echo '<div class="notowanie-top"><div class="col-one-third"><a href="utwory.php?id='.$rekord[4].'"><img src="'.$utwory[3].'" alt="Fotka probna" /></a></div><div class="col-two-third"><h3><a href="utwory.php?id='.$rekord[4].'">'.$ile.'. | '.$liczTyg.' tyg | '.$ostatni.' | '.$zmiana.' | '.$utwor[2].' - '.$utwor[3].'</a></h3></div></div><br>';
							}
							else {
								echo '<div class="notowanie-top"><div class="col-one-third"><a href="utwory.php?id='.$rekord[4].'"><img src="img/logo.jpg" alt="Fotka probna" /></a></div><div class="col-two-third"><h3><a href="utwory.php?id='.$rekord[4].'">'.$ile.'. | '.$liczTyg.' tyg | '.$ostatni.' | '.$zmiana.' | '.$utwor[2].' - '.$utwor[3].'</a></h3></div></div><br>';
							}
										//printf("%d. %s - %s\n",$ile, $utwor[2], $utwor[3]);
								$ile++;

						}
						 ?>
				</div>

					<div class="notowanie-szukaj">
						<div class="szukaj-glowne">
							<h2>Szukaj</h2>
							<form class="" action="szukaj.php" method="post">
								<select name="rodzaj">
									<option value="Notowanie">Notowanie</option>
									<option value="Wykonawca">Wykonawca</option>
									<option value="Utwor">Utwór</option>
								</select>
								<input type="text" name="wartosc_wysz">
								<input value="Szukaj" type="submit" />
							</form>
						</div>

						<div class="najnowsze-utwory">
							<h2>10 najnowszych utworów na LPRŻ</h2>
							<?php

							$sql7 = "SELECT * from utwory where obecnie=1 order by id desc limit 10"; // 2
							$query7 = $polaczenie->query($sql7);
							$lp = 1;
							while($rekord7 = mysqli_fetch_array($query7))
							{
								echo '<div class="top-nowosci">';
									echo '<div class="top-lp">'.$lp.'</div>';
									echo '<a href="wykonawcy.php?id='.$rekord7[0].'"><div class="top-autor">'.$rekord7[3].'</div></a>';
									echo '<a href="utwory.php?id='.$rekord7[0].'"><div class="top-utwor">'.$rekord7[2].'</div></a>';
								echo '</div>';

								echo '<div class="clear">

								</div>';
								$lp++;
							}
							 ?>
						</div>

						<div class="losowe-notowanie">
							<?php
							$sql8 = "SELECT * from notowania order by numer_not desc limit 1"; // 2
							$query8 = $polaczenie->query($sql8);
							$rekordzista1 = mysqli_fetch_array($query8);
							$ostatnie_not = $rekordzista1[2];
							//echo $ostatnie_not;
								$losowy_nr = rand(1,$ostatnie_not);
								$sql20 = "SELECT * from notowania where numer_not=$losowy_nr order by miejsce asc"; // 2
								$query20 = $polaczenie->query($sql20);
								$rekordzista2 = mysqli_fetch_array($query20);
								$data = $rekordzista2[1];
							 ?>
							<h2>TOP 10 Notowania <?php echo $losowy_nr; ?> </h2>
							<h3>Data: <?php echo $data; ?> </h3>
							<?php
							$sql9 = "SELECT * from notowania where numer_not=$losowy_nr order by miejsce asc limit 10"; // 2
							$query9 = $polaczenie->query($sql9);
							$lp = 1;
							while($rekord9 = mysqli_fetch_array($query9))
							{
								// Wczytanie nazwy utworu z bazy
							  $sql12 = "SELECT * from utwory where id=$rekord9[4]"; // 2
							  $query12 = @$polaczenie->query($sql12);
							  $utwory12 = mysqli_fetch_array($query12);

							  $nazwa_utworu = $utwory12[2];
							  $wykonawca = $utwory12[3];

								echo '<div class="top-nowosci">';
									echo '<div class="top-lp">'.$lp.'</div>';
									echo '<a href="wykonawcy.php?id='.$utwory12[0].'"><div class="top-autor">'.$wykonawca.'</div></a>';
									echo '<a href="utwory.php?id='.$utwory12[0].'"><div class="top-utwor">'.$nazwa_utworu.'</div></a>';
								echo '</div>';

								echo '<div class="clear">

								</div>';
								$lp++;
							}
							 ?>
						</div>
					</div>

				<div class="clear">

				</div>

<?php include('stopka.php'); ?>
