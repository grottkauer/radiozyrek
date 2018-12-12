<?php
ob_start();
require_once("naglowekcms.php");
require_once("connect.php"); // 1
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
if (!isset($_SESSION['zalogowany']))
{
  header("Location: ../index.php");
}
 ?>

 <?php

 echo '<div class="container">
   <br><br>
   <h1>Dodaj utwór</h1><br/><br/>
   <form class="add-event" action="" method="post">
     Data dodania: <input type="text" name="data" id="input_01"
                     class="datepicker" autofocuss
                     value='.date("Y-m-d").'
                     data-valuee="2014-08-08"><br>
     Tytuł: <input type="text" name="tytul" class="event-input"><br>
     Wykonawca: <input type="text" name="wykonawca" class="event-input"><br>
     Obecnie na liście? 1 - TAK, 0 - NIE <input type="number" name="obecnie" class="event-input"><br>
     <input type="submit" value="Dodaj">
   </form>

 </div><br><br> <div id="container"></div>';
 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
   $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
   $title = $polaczenie->real_escape_string($_POST['tytul']);
   //echo $city;

   $sql = "INSERT INTO utwory values('','".$_POST['data']."','".$title."','".$polaczenie->real_escape_string($_POST['wykonawca'])."','".$_POST['obecnie']."')";
   if ($query = $polaczenie->query($sql)) {
     header("Location: index.php");
   }
   else {
     echo '<h2>Coś zostało podane źle i utwór nie został dodany</h2>';
   }
 }
 ?>
 <script src="pickadate.js/jquery.1.7.0.js"></script>
 <script src="pickadate.js/lib/picker.js"></script>
     <script src="pickadate.js/lib/picker.date.js"></script>
     <script src="pickadate.js/lib/legacy.js"></script>

     <script type="text/javascript">

         var $input = $( '.datepicker' ).pickadate({
             formatSubmit: 'yyyy-mm-dd',
             // min: [2015, 7, 14],
             container: '#container',
             // editable: true,
             closeOnSelect: false,
             closeOnClear: false,
         })

         var picker = $input.pickadate('picker')
         // picker.set('select', '14 October, 2014')
         // picker.open()

         // $('button').on('click', function() {
         //     picker.set('disable', true);
         // });

     </script>
     <?php
 require_once("stopka.php");
 ob_end_flush();
  ?>
