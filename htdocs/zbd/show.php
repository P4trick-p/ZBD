<?php session_start(); 
    if((!isset($_POST['id'])) || (!isset($_SESSION['id']))){
        header('Location: strona-glowna');
    }
?>
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
        <title>Turnieje</title>
        <script type="text/javascript" src="JavaScript/clock.js"></script>
    </head>

    <body onload="clock();">
        <div id="wrapper">
            <div id="logo">
                <h1><span style="color:rgb(196, 208, 252)">System obsługi turniejów sportowych</span></h1>
            </div>

            <nav id="menu">
                <a class="men" href="strona-glowna">Strona główna</a>
                <a class="men_active" href="spis-turniejow">Turnieje</a>
                <a class="men" href="dodaj">Dodaj</a>
                <a class="men" href="o-nas">O nas</a>
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
                    
                    <?php
                        if ((isset($_POST['id']))){
                            $_SESSION['id'] = $_POST['id'];
                            $_SESSION['id_dysc'] = $_POST['id_dyscyplina'];
                        }
                        $con=mysqli_connect("localhost","root","","zbd");
                        // Check connection
                        if (mysqli_connect_errno())
                        {
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                        }
                        $id = $_SESSION['id'];
                        $id_dysc = $_SESSION['id_dysc'];

                        $result = mysqli_query($con,
                        "SELECT *
                        FROM turniej, adres, dyscyplina
                        WHERE id_turniej=$id 
                        AND adres.id_adres = turniej.id_adres 
                        AND dyscyplina.id_dyscyplina = turniej.id_dyscyplina");
                        
                        $zawodnicy = mysqli_query($con,
                        "SELECT zawodnicy.id_zawodnicy, zawodnicy.imie, zawodnicy.nazwisko, zawodnicy.klub, zawodnicy.opis, zawodnicy_turn.punkty
                        FROM zawodnicy, zawodnicy_turn, turniej
                        WHERE zawodnicy_turn.id_turniej=$id
                        AND zawodnicy.id_zawodnicy = zawodnicy_turn.id_zawodnicy 
                        AND zawodnicy_turn.id_turniej = turniej.id_turniej
                        ORDER BY zawodnicy_turn.punkty DESC");
                        
                        $zawodnicy_all = mysqli_query($con,
                        "SELECT * FROM zawodnicy 
                        WHERE NOT EXISTS
                        (SELECT * FROM zawodnicy_turn 
                        WHERE zawodnicy_turn.id_turniej=$id 
                        AND zawodnicy_turn.id_zawodnicy=zawodnicy.id_zawodnicy)
                        AND zawodnicy.id_dyscyplina=$id_dysc
                        ORDER BY nazwisko");

                        $komentatorzy = mysqli_query($con,
                        "SELECT komentatorzy.id_komentatorzy, komentatorzy.imie, komentatorzy.nazwisko 
                        FROM komentatorzy, komentatorzy_turn, turniej 
                        WHERE komentatorzy_turn.id_turniej=$id 
                        AND komentatorzy.id_komentatorzy = komentatorzy_turn.id_komentatorzy 
                        AND komentatorzy_turn.id_turniej = turniej.id_turniej");

                        $organizatorzy = mysqli_query($con,
                        "SELECT organizatorzy.id_organizatorzy, organizatorzy.nazwa, organizatorzy.id_adres, organizatorzy.email, organizatorzy.telefon, adres.id_adres, adres.kraj, adres.miasto, adres.kod_pocztowy, adres.ulica 
                        FROM organizatorzy, organizatorzy_turn, adres, turniej 
                        WHERE organizatorzy_turn.id_turniej=$id 
                        AND organizatorzy.id_organizatorzy = organizatorzy_turn.id_organizatorzy 
                        AND organizatorzy_turn.id_turniej = turniej.id_turniej 
                        AND adres.id_adres = organizatorzy.id_adres");

                        echo "<h1>Turniej</h1>";
                        echo "<table border='1'>
                        <tr>
                        <th>ID</th>
                        <th>Nazwa</th>
                        <th>Data</th>
                        <th>Adres</th>
                        <th>Dyscyplina</th>
                        <th>Opis</th>
                        <th>Zasady</th>
                        <th>Transmisja</th>
                        <th>Wpisowe</th>
                        </tr>";
                        while($row = mysqli_fetch_array($result))
                        {   
                            echo "<tr>";
                            echo "<td>" . $row['id_turniej'] . "</td>";
                            echo "<td>" . $row['nazwa'] . "</td>";
                            echo "<td>" . $row['data'] . "</td>";
                            echo "<td>".$row['ulica']." ".$row['miasto']." ".$row['kod_pocztowy']." ".$row['kraj']."</td>";
                            echo "<td>" . $row['dyscyplina'] . "</td>";
                            echo "<td>" . $row['opis'] . "</td>";
                            echo "<td>" . $row['zasady'] . "</td>";
                            echo "<td>" . $row['transmisja'] . "</td>";
                            echo "<td>" . $row['wpisowe'] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                        
                        //////////////////////////////////////////////   
                        echo "<br><h1>Zawodnicy</h1>";
                        if ((isset($_SESSION['user'])) || (isset($_SESSION['pass'])))
                        {
                            echo '
                            <form action="zaw2turn.php" method="post">
                            <input type="hidden" name="id_turniej" value="'.$id.'">
                            ';
                            echo '<br/>Dodaj zawodnika:<br/><select name="id_zawodnik" required><option value="" disabled selected>Wybierz zawodnika</option>';
                            
                            while($row = mysqli_fetch_array($zawodnicy_all)){
                                echo '<option value="'.$row['id_zawodnicy'].'">'.$row['nazwisko'].' '.$row['imie'].'</option>';}
                                echo '</select><input type="submit" value="Dodaj do turnieju" />'; 
                                echo '</form>';
                        }
                        else{}
                        echo "<table border='1'>
                        <tr>
                        <th>lp.</th>
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        <th>Klub</th>
                        <th>Punkty</th>";

                        if ((isset($_SESSION['user'])) || (isset($_SESSION['pass'])))
                        {
                            echo "<th></th>";
                        }
                        
                        echo "</tr>";
                        
                        $i = 1;
                        while($row = mysqli_fetch_array($zawodnicy))
                        {   
                            echo "<tr>";
                            echo "<td>" . $i . "</td>";
                            echo "<td>" . $row['imie'] . "</td>";
                            echo "<td>" . $row['nazwisko'] . "</td>";
                            echo "<td>" . $row['klub'] . "</td>";
                            echo "<td>" . $row['punkty'] . "</td>";
                            if ((isset($_SESSION['user'])) || (isset($_SESSION['pass'])))
                            { 
                                echo '<th><form action="pkt.php" method="post">
                                <input type="hidden" name="id_turniej" value="'.$id.'">
                                <input type="hidden" name="id_zawodnik" value="'.$row['id_zawodnicy'].'">
                                <input maxlength="5" type="number" name="punkty" />';
                                echo '<input type="hidden" name="id_dyscyplina" value="'.$id_dysc.'">';
                                echo "<button type="."submit"." name="."id"." value="."$id"." class="."btn-link".">Ustaw</button></form>"."</th>";
                            }
                            echo "</tr>";
                            $i = $i+1;
                        }
                        echo "</table>";

                        //////////////////////////////////////////////
                        echo "<br><h1>Komentatorzy</h1>";
                        echo "<table border='1'>
                        <tr>
                        <th>lp.</th>
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        </tr>";

                        $i = 1;
                        while($row = mysqli_fetch_array($komentatorzy))
                        {   
                            echo "<tr>";
                            echo "<td>" . $i . "</td>";
                            echo "<td>" . $row['imie'] . "</td>";
                            echo "<td>" . $row['nazwisko'] . "</td>";
                            echo "</tr>";
                            $i = $i+1;
                        }
                        echo "</table>";

                        //////////////////////////////////////////////
                        echo "<br><h1>Organizatorzy</h1>";
                        echo "<table border='1'>
                        <tr>
                        <th>lp.</th>
                        <th>Nazwa</th>
                        <th>Adres</th>
                        <th>E-mail</th>
                        <th>Telefon</th>
                        </tr>";

                        $i = 1;
                        while($row = mysqli_fetch_array($organizatorzy))
                        {   
                            echo "<tr>";
                            echo "<td>" . $i . "</td>";
                            echo "<td>" . $row['nazwa'] . "</td>";
                            echo "<td>".$row['ulica']." ".$row['miasto']." ".$row['kod_pocztowy']." ".$row['kraj']."</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['telefon'] . "</td>";
                            echo "</tr>";
                            $i = $i+1;
                        }
                        echo "</table>";

                        unset($_SESSION['id2']);
                        mysqli_close($con);
                    ?>
                </div>


            </div>

            <div id="footer">
                Patryk Pęcak & Michał Szeller &copy; Wszelkie prawa zastrzeżone
            </div>


        </div>
    </body>

    </html>
