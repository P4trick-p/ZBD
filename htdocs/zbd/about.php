<?php session_start(); ?>
    <!DOCTYPE HTML>
    <html lang="pl">

    <head>
        <style type="text/css">
            a {
                text-decoration: none
            }

        </style>
        <link rel="stylesheet" type="text/css" href="main.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&amp;subset=latin-ext" rel="stylesheet">
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="description" content="System do obsługi turniejów sportowych"/>
        <meta name="keywords" content="sport, turniej, zawody" />
        <title>O nas</title>
        <link rel="stylesheet" href="fonts/fontello1/css/fontello.css" type="text/css" />
        <script type="text/javascript" src="JavaScript/clock.js"></script>
    </head>

    <body onload="clock();">
        <div id="wrapper">
            <div id="logo">
                <h1><span style="color:rgb(196, 208, 252)">System obsługi turniejów sportowych</span></h1>
            </div>



            <nav id="menu">
                <a class="men" href="strona-glowna">Strona główna</a>
                <a class="men" href="spis-turniejow">Turnieje</a>
                <a class="men" href="dodaj">Dodaj</a>
                <a class="men_active" href="o-nas">O nas</a>
                <a class="men" href="kontakt">Kontakt</a>
            </nav>

            <div id="core">
            <div id="sidebar">
                <div style="background:black;border-radius:15px;height:25px">
                <div id="clock" style="font-size:20px"></div></div></br>
                <div id="login">
				<?php 
                    if ((isset($_SESSION['user'])) || (isset($_SESSION['pass'])))
                    {
                        echo 'Witaj '.$_SESSION['user'];
                        echo '</br><a href="logout.php">Wyloguj się!</a>';
                    }
                    else
                    {
                        echo '<form action="login.php" method="post">
	
                        <br /> <input type="text" placeholder="Login" name="login" /> <br />
                        <br /> <input type="password" placeholder="Hasło" name="haslo" /> <br /><br />
                        <input type="submit" value="Zaloguj się" />
                    
                    </form>';
                    }
                ?>
				</div>
                </div>

                <div id="content_area">

       
                    

                    <h1>O Nas</h1><br>
                    <h2></h2><br>
                    <h3>Patryk Pęcak i Michał Szeller - Studenci Politechniki Wrocławskiej na wydziale <b>Elektroniki (W4)</b>.
                    </h3><br>
                    <h3>Strona jest częścią projektu kursu Zastosowania Baz Danych</h3>

                    <div id="social">
                        
                    </div>

                </div>


            </div>

            <div id="footer">
                Patryk Pęcak & Michał Szeller &copy; Wszelkie prawa zastrzeżone
            </div>


        </div>
    </body>

    </html>
