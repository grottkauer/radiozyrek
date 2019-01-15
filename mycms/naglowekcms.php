<?php session_start();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="google-site-verification" content="Qlf1DDdP7bYxJ7-97hP7Xm1MeeYGtUgA8GVlWf9d9F8" />
        <title>Grodkowiacy - zespoł</title>
        <link rel="stylesheet" href="stail.css">
        <link rel="stylesheet" href="css/fontello.css" type="text/css" />
        <link rel="stylesheet" href="SlickNav/dist/slicknav.css" />
        <link rel="stylesheet" href="jquery-modal-master/jquery.modal.css" type="text/css" media="screen" />
        <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>
<link rel="stylesheet" href="pickadate.js/lib/themes/default.css">
<link rel="stylesheet" href="pickadate.js/lib/themes/default.date.css">
<link href="https://fonts.googleapis.com/css?family=Raleway:500i" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
 <script src="jquery-modal-master/jquery.modal.js" type="text/javascript" charset="utf-8"></script>
<script>
$(document).ready(function(){
    $("#flip").click(function(){
        $("#panel").slideToggle("slow");
    });
    $("#flip1").click(function(){
        $("#panel1").slideToggle("slow");
    });
    $("#flip2").click(function(){
        $("#panel2").slideToggle("slow");
    });
    $("#flip3").click(function(){
        $("#panel3").slideToggle("slow");
    });
});
</script>
    </head>
    <body>
        <!-- Naglowek strony -->
        <section class="top" id="pasek">
          <div class="container">
              <a href="index.php"><div class="logo">
                  CMS-PROJEKT
              </div></a>
              <div class="cms-top">
                  <a href="#"><div class="cms-block" >
                    <div id="flip">
                      AKTUALNOŚCI <br>I HISTORIA
                    </div></div>
                    <div id="panel">
                        <a href="add-news.php"><div class="cms-under-block">
                          Dodawanie newsa
                        </div></a>
                        <a href="delete-news.php"><div class="cms-under-block">
                          Usuwanie newsa
                        </div></a>
                        <a href="add-history.php"><div class="cms-under-block">
                          //Dodawanie wydarzenia do historii
                        </div></a>
                        <a href="delete-history.php"><div class="cms-under-block">
                          //Usuwanie wydarzenia z historii
                        </div></a>
                  </div>
                  </a>
                  <a href="#"><div class="cms-block" >
                    <div id="flip1">
                      UTWORY <br>I NOTOWANIA
                    </div></div>
                    <div id="panel1">
                      <a href="add-plan.php"><div class="cms-under-block">
                      Dodawanie utworu
                    </div></a>
                    <a href="delete-plan.php"><div class="cms-under-block">
                      Usuwanie utworu z obecnych
                    </div></a>
                    <a href="add-event.php"><div class="cms-under-block">
                      Dodawanie notowanie
                    </div></a>
                    <a href="delete-event.php"><div class="cms-under-block">
                      //Usuń notowanie
                    </div></a>
                    <a href="add-topka.php"><div class="cms-under-block">
                      Dodawanie samego TOP30
                    </div></a>
                    <a href="add-wszechczas.php"><div class="cms-under-block">
                      Dodawanie TOPU Wszechczasów
                    </div></a>
                  </div>
                  </a>
                  <a href="#"><div class="cms-block" >
                    <div id="flip2">
                      ZDJĘCIA <br>I GALERIE
                    </div></div>
                    <div id="panel2">
                      <a href="add-photo.php"><div class="cms-under-block">
                    Dodawanie zdjęć
                  </div></a>
                  <a href="delete-photo.php"><div class="cms-under-block">
                    Usuwanie zdjęć
                  </div></a>
                  <a href="add-oldgallery.php"><div class="cms-under-block">
                    Dodawanie starej galerii
                  </div></a>
                  <a href="delete-oldgallery.php"><div class="cms-under-block">
                    Usuwanie starej galerii
                  </div></a>
                </div>
                  </a>
                  <a href="#"><div class="cms-block" >
                    <div id="flip3">
                      MENU
                    </div></div>
                    <div id="panel3">
                      <a href="../logout.php"><div class="cms-under-block">
                    Wyloguj się
                  </div></a>
                  <a href="../index.php"><div class="cms-under-block">
                    Podgląd strony
                  </div></a>
                  <a href="#"><div class="cms-under-block">
                    Twoje dane
                  </div></a>
                </div>
                  </a>
              </div>

          </div>
        </section>


        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script src="SlickNav/dist/jquery.slicknav.js"></script>
        <script type="text/javascript">
        $(document).ready(function(){
          $('#menu').slicknav();
        });
        </script>
