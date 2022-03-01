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
                    <h1>Turnieje</h1><br>
                    <h3></h3><br>
                    <?php
                        $con=mysqli_connect("localhost","root","","zbd");
                        // Check connection
                        if (mysqli_connect_errno())
                        {
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                        }
                        ////SELECT * FROM turniej
                        $result = mysqli_query($con,
                        "SELECT *
                        FROM turniej, adres, dyscyplina
                        WHERE adres.id_adres = turniej.id_adres AND dyscyplina.id_dyscyplina = turniej.id_dyscyplina ORDER BY data");
                        
                        echo '
                        <table class="fixed" border="1">
                        <col width="20px" />
                        <col width="110px" />
                        <col width="80px" />
                        <col width="110px" />
                        <col width="90px" />
                        <col width="254px" />
                        <col width="254px" />
                        <col width="70px" />
                        <col width="60px" />
                        <col width="52px" />
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
                        </tr>';

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
                            $id = $row['id_turniej'];
                            $id_dysc = $row['id_dyscyplina'];
                            echo "<td>" . "<form action="."wiecej"." method="."post".">";
                            echo '<input type="hidden" name="id_dyscyplina" value="'.$id_dysc.'">';
                            echo "<button type="."submit"." name="."id"." value="."$id"." class="."btn-link".">Rozwiń</button></form>" . "</td>";
                            

                            echo "</tr>";
                            
                        }
                        echo "</table>";
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
