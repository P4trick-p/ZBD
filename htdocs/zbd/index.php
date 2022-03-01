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
            <a class="men_active" href="strona-glowna">Strona główna</a>
            <a class="men" href="spis-turniejow">Turnieje</a>
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
                <h1>Strona główna</h1><br>
                
                <?php 
                        $con=mysqli_connect("localhost","root","","zbd");
                        // Check connection
                        if (mysqli_connect_errno())
                        {
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                        }
                        $result = mysqli_query($con,
                            "SELECT * FROM dyscyplina");
                        
                        echo 'Wybierz dyscyplinę:';
                        echo '<form action="" method="post">';
                        echo '<select name="dyscyplina" required><option value="" disabled selected>Wybierz dyscyplinę</option>';
                        while($row = mysqli_fetch_array($result)){
                            echo '<option value="'.$row['id_dyscyplina'].'">'.$row['dyscyplina'].'</option>';
                        }
                        echo '<input type="submit" value="Wyświetl" />';
                        echo "</select></br>"; 
                        
                        if((!isset($_POST['dyscyplina']))){}
                        else{   
                            $dyscyplina = $_POST['dyscyplina'];
                            
                            $zawodnicy = mysqli_query($con,
                        "SELECT zawodnicy.id_zawodnicy, zawodnicy.imie, zawodnicy.nazwisko, zawodnicy.klub, zawodnicy_turn.punkty, zawodnicy.id_dyscyplina, turniej.id_turniej 
                        FROM zawodnicy, zawodnicy_turn, turniej 
                        WHERE zawodnicy.id_dyscyplina=$dyscyplina
                        AND zawodnicy_turn.id_zawodnicy=zawodnicy.id_zawodnicy 
                        AND turniej.id_dyscyplina=$dyscyplina 
                        AND turniej.id_turniej=zawodnicy_turn.id_turniej 
                        ORDER BY zawodnicy.id_zawodnicy ASC");
                        

                        $rank = mysqli_query($con,
                                    "SELECT zawodnicy.imie, zawodnicy.nazwisko, zawodnicy.klub, ranking.punkty, zawodnicy.id_dyscyplina 
                                    FROM zawodnicy, ranking
                                    WHERE zawodnicy.id_dyscyplina=$dyscyplina
                                    AND zawodnicy.id_zawodnicy=ranking.id_zawodnik
                                    ORDER BY ranking.punkty DESC");
                            
                            $dnames = mysqli_query($con,
                                    "SELECT dyscyplina.dyscyplina 
                                    FROM dyscyplina
                                    WHERE dyscyplina.id_dyscyplina=$dyscyplina");
                            while($row = mysqli_fetch_array($dnames)){
                                $dname = $row['dyscyplina'];
                            }
                            echo "<br><h1>". $dname ."</h1>"; 
                            echo "<br><h2>Zawodnicy</h2>";
                            echo "<table border='1'>
                            <tr>
                            <th>lp.</th>
                            <th>Imię</th>
                            <th>Nazwisko</th>
                            <th>Klub</th>
                            <th>Punkty</th></tr>";
            
                            $i = 1;
                            while($row = mysqli_fetch_array($rank))
                            {   
                                echo "<tr>";
                                echo "<td>" . $i . "</td>";
                                echo "<td>" . $row['imie'] . "</td>";
                                echo "<td>" . $row['nazwisko'] . "</td>";
                                echo "<td>" . $row['klub'] . "</td>";
                                $rank_pkt = $row['punkty'];
                                echo "<td>" . $rank_pkt . "</td>";
                                $i = $i+1;
                            }
                            echo "</table>";
                        }
                ?>
            </div>


        </div>

        <div id="footer">
            Patryk Pęcak & Michał Szeller &copy; Wszelkie prawa zastrzeżone
        </div>


    </div>
</body>

</html>
