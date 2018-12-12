<?php
//session_start();
require_once("naglowek.php");
require_once("connect.php");

if($_SERVER['REQUEST_METHOD'] == 'POST')
{

  if ($_POST['kod']==$_SESSION['captcha'])
  {
  	echo "Wpisałeś poprawny kod.";
  	//reszta skryptu
    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
    $sql = "INSERT INTO komentarze values('','".$_POST['autor']."','".$_POST['tresc']."',now(),'".$_SESSION['id_newsa']."')";
    $query = $polaczenie->query($sql);
    header('Location: aktual.php');
  }
  else
  {
    echo '<br/><br/><br/><h1>Wpisany kod jest niepoprawny.</h1><br/><a href="aktual.php"><h2>Wracaj do aktualnosci</h2></a>';
  }


}

 ?>
