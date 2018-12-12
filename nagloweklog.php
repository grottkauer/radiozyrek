<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Pierwsza strona</title>
        <link rel="stylesheet" href="stajl.css">
        <link rel="stylesheet" href="css/fontello.css" type="text/css" />
        <link rel="stylesheet" href="SlickNav/dist/slicknav.css" />
        <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>
    </head>
    <body>
        <!-- Naglowek strony  -->
        <header class="top row" id="pasek">
          <div class="container">
              <div class="logo">
                  <a href="index.php"><img src="img/logo.jpg" alt="RADIO ŻYREK"></a>
              </div>
                  <ul class="main-menu list-inline" id="menu">
                       <li class="list-inline-item"><a href="index.php">Strona główna</a></li>
                       <li class="list-inline-item"><a href="aktual.php">Aktualności radia</a></li>
                       <li class="list-inline-item"><a href="notowania.php">Notowania</a></li>
                       <li class="list-inline-item"><a href="#">Statystyki</a>
                            <ul class="o-zespole list-inline">
                                 <li class="list-inline-item"><a href="podsumowanie_roku.php">Podsumowanie Roku</a></li>
                                 <li class="list-inline-item"><a href="ranking_topka.php">Ranking utworów TOP30</a></li>
                                 <li class="list-inline-item"><a href="ranking_poczekalnia.php">Ranking Poczekalni</a></li>
                                 <li class="list-inline-item"><a href="prowadzacy.php">Prowadzący listę</a></li>
                            </ul>
                       </li>
                        <li class="list-inline-item"><a href="top.php">Top Wszechczasów</a></li>
                        <li class="list-inline-item"><a href="logowanie.php">Logowanie</a></li>
                  </ul>
              </div>
        </header>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script src="SlickNav/dist/jquery.slicknav.js"></script>
        <script type="text/javascript">
        $(document).ready(function(){
          $('#menu').slicknav();
        });
        </script>
