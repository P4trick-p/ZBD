<?php session_start(); ?>

<!DOCTYPE HTML>
<html lang="pl">

<head>
    <link rel="stylesheet" type="text/css" href="main.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&amp;subset=latin-ext" rel="stylesheet">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="System do obsługi turniejów sportowych"/>
    <meta name="keywords" content="sport, turniej, zawody" />
    <title>SOTS</title>

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
            <a class="men_active" href="dodaj">Dodaj</a>
            <a class="men" href="o-nas">O nas</a>
            <a class="men" href="kontakt">Kontakt</a>
        </nav>

        <div id="core">

            <div id="sidebar">
                <div style="background:black;border-radius:15px;height:25px">
                <div id="clock" style="font-size:20px"></div></div></br>
                <div id="login">
				<?php 
                    if ((isset($_SESSION['user'])) || (isset($_SESSION['pass']))){
                        echo 'Witaj '.$_SESSION['user'];
                        echo '</br><a href="logout.php">Wyloguj się!</a>';
                    }
                    else{
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
            <?php
            if ((isset($_SESSION['user'])) || (isset($_SESSION['pass'])))
            {
                echo '<h1>Dodaj</h1><br>
                <p><a href="zglos-turniej">Turniej</a></p></br>
                <p><a href="zglos-zawodnika">Zawodnika</a></p></div>';
            }
            else{
                echo '<h2>Aby dodawać zaloguj się.</h2>';
            }
            ?>
        </div>

        <div id="footer">
            Patryk Pęcak & Michał Szeller &copy; Wszelkie prawa zastrzeżone
        </div>


    </div>
</body>

</html>
