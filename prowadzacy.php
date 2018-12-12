<?php include('naglowek.php'); ?>
<h1>KTO NAJCZĘŚCIEJ PROWADZIŁ POCZEKALNIĘ?</h1>
<?php

 ?>
 <div class="container">
   <div class="col-half">
     <a href="#"><div id="flip">JAN ŻYREK</div></a>
     <div id="panel">Od początku z radiem - listę przebojów orginuję od sierpnia 2015 roku.<br>
       Przyznać muszę, że lista jest oczywiście subiektywna, bo to ja wybieram utwory i je układam w kolejności.<br>
       Pasuje tu do mnie zasada - DZIEL I RZĄDŹ
     </div>
   </div>
 </div>
 <div class="clear">

 </div>
 <script type='text/javascript'>
 $(document).ready(function(){
    $("#flip").click(function(){
        $("#panel").slideToggle("slow");
    });
    $("#flip_2").click(function(){
        $("#panel_2").slideToggle("slow");
    });
});

 </script>
<?php include('stopka.php'); ?>
