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
        <title>SOTS</title>

        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

        <script type="text/javascript" src="JavaScript/clock.js"></script>

        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

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
                    if ((isset($_SESSION['user'])) || (isset($_SESSION['pass'])))
                    {

                        $con=mysqli_connect("localhost","root","","zbd");
                            // Check connection
                            if (mysqli_connect_errno())
                            {
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                            }
                            $result = mysqli_query($con,
                            "SELECT * FROM dyscyplina");
                        echo '<form action="addturn.php" method="post">
                        <h1>Dodaj Turniej</h1><br>
                        Nazwa turnieju:<br/>
                        <textarea maxlength="50" style="resize: none;" name="nazwa" rows="2" cols="50" minlength="10" required></textarea>
                        <br/>Data:<br/>
                        <input type="datetime-local" name="data" required pattern="\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}">
                        <br/>Adres:<br/>
                        <textarea placeholder="Ulica" maxlength="50" style="resize: none;" name="ulica" rows="1" cols="35" minlength="3" required></textarea>
                        <textarea placeholder="Kod pocztowy" maxlength="10" style="resize: none;" name="kod" rows="1" cols="12" minlength="5" required></textarea>  
                        
                        <br/>
                        <textarea placeholder="Miasto" maxlength="50" style="resize: none;" name="miasto" rows="1" cols="25" minlength="1" required></textarea>
                        <textarea placeholder="Kraj" maxlength="20" style="resize: none;" name="kraj" rows="1" cols="22" minlength="2" required></textarea>             
                        <br/>Dyscyplina:<br/><select name="dyscyplina" required><option value="" disabled selected>Wybierz dyscyplinę</option>';
                        
                        while($row = mysqli_fetch_array($result)){
                            echo '<option value="'.$row['dyscyplina'].'">'.$row['dyscyplina'].'</option>';}
                        echo "</select>"; 
                        echo ' <br/>Opis:<br/>
                        <textarea maxlength="250" style="resize: none;" name="opis" rows="8" cols="50" minlength="1" required></textarea>                  
                        <br/>Zasady:<br/>
                        <textarea maxlength="250" style="resize: none;" name="zasady" rows="8" cols="50" minlength="1" required></textarea>   
                        <br/>Transmisja:<br/>
                        <select name="transmisja" required>
                            <option value="" disabled selected></option>
                            <option value="Tak">Tak</option>
                            <option value="Nie">Nie</option>
                        </select>
                        <br/>Wpisowe:<br/>
                        <input maxlength="10" type="number" name="wpisowe" />
                        <br/>
                        <input type="submit" value="Dodaj turniej" />
                        </form>';
                    }
                    else{
                        echo '<h2>Aby dodawać zaloguj się.</h2>';
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
