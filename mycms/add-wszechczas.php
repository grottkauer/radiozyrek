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
 $miejsca = array();
 echo '<div class="container">
   <br><br>
   <h2>Dodaj TOP Wszechczasów - 100 najlepszych utworów roku!</h2><br/><br/>
   <form class="add-event" action="" method="post">
     Data notowania: <input type="text" name="data" id="input_01"
                     class="datepicker" autofocuss
                     value='.date("Y-m-d").'
                     data-valuee="2016-09-08"><br>
     Numer notowania: <input type="number" name="number" class="event-input"><br>';

     ;
     for ($i=1; $i <= 100; $i++) {
      $j=$i-1;
      $sql = "SELECT * from utwory where obecnie=2 order by wykonawca"; // 2
      $query = @$polaczenie->query($sql);
       echo $i.'. ';
      echo "<select name=id$j>";
       while($rekord = mysqli_fetch_array($query))
       {
       echo '<option value='.$rekord[0].'">  '.$rekord[3].'  - '.$rekord[2].' ID: '.$rekord[0].'<br>';
       }
       echo '</select>';
       //$miejsca[$i-1] = $_POST['id'];
       echo "<br>";
     }

     echo '

     <input type="submit" value="Dodaj">
   </form>

 </div><br><br> <div id="container"></div>';
 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
   for ($ile=0; $ile < 100; $ile++) {
     $i = $ile+1;
     $sql = "INSERT INTO notowania_top values('','".$_POST['data']."','".$_POST['number']."','".$_POST['id'.$ile.'']."','".$i."')";
     $query = $polaczenie->query($sql);
   }


 header("Location: index.php");
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
