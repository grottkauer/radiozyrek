<?php

	session_start();

	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: index.php');
		exit();
	}

	require_once("nagloweklog.php");
?>


	<h1>Ekran logowania do systemu</h1><br /><br />

	<form action="zaloguj.php" method="post" class="login">

		Login: <br /> <input type="text" name="login" /> <br />
		Hasło: <br /> <input type="password" name="haslo" /> <br /><br />
		<input type="submit" value="Zaloguj się" />

	</form>

<?php
	if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
	require_once("stopka.php");
?>

</body>
</html>
