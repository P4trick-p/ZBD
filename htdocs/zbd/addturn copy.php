<?php
session_start();
if ((!isset($_POST['nazwa'])) || (!isset($_POST['data'])) || (!isset($_POST['ulica'])) || (!isset($_POST['kod'])) || (!isset($_POST['miasto'])) || (!isset($_POST['kraj'])) || (!isset($_POST['opis'])) || (!isset($_POST['zasady'])) || (!isset($_POST['wpisowe']))){
    header('Location: dodaj');
    exit();
}
else{
$host = "localhost";
$db_user = $_SESSION['user'];
$db_password = $_SESSION['pass'];
$db_name = "zbd";

$con = @new mysqli($host, $db_user, $db_password, $db_name);

if ($con->connect_errno!=0)
{
	echo "Error: ".$polaczenie->connect_errno;
}
else
{
    $d = $_POST['dyscyplina'];
    if($dysc = mysqli_query($con,
    "SELECT * FROM zbd.dyscyplina WHERE dyscyplina='$d'")){
    $ile = $dysc->num_rows;
		if($ile>0){
            
            $wiersz = $dysc->fetch_assoc();
            $id_dyscyplina = $wiersz['id_dyscyplina'];
            $dyscyplina = $wiersz['dyscyplina'];
        }}
       
$nazwa = $_POST['nazwa'];
$data = date("Y-m-d H:i:s",strtotime($_POST['data']));
$ulica = $_POST['ulica'];
$kod = $_POST['kod'];
$miasto = $_POST['miasto'];
$kraj = $_POST['kraj'];

$opis = $_POST['opis'];
$zasady = $_POST['zasady'];
$transmisja = $_POST['transmisja'];
$wpisowe = $_POST['wpisowe'];

unset($_POST['nazwa']);

//echo $nazwa." | ".$data." | ".$ulica." | ".$kod." | ".$miasto." | ".$kraj." | ".$dyscyplina." | ".$opis." | ".$zasady." | ".$transmisja." | ".$wpisowe." | ";
echo "INSERT INTO 'adres' VALUES (NULL, ".$kraj.",".$miasto.",".$kod.", ".$ulica." )";
if ($con->query("INSERT INTO adres VALUES (NULL, '$kraj', '$miasto', '$kod', '$ulica')")){
    
    if($ad = mysqli_query($con,
    "SELECT * FROM zbd.adres ORDER BY id_adres DESC LIMIT 1")){
    $ile = $ad->num_rows;
		if($ile>0){
            $wiersz = $ad->fetch_assoc();
            $id_adres = $wiersz['id_adres'];
            echo $id_adres."<br/>";
            echo "INSERT INTO turniej VALUES (NULL, '$data', $id_adres, $id_dyscyplina, 1, '$nazwa', '$opis', '$zasady', '$transmisja', $wpisowe)";
            if ($con->query("INSERT INTO turniej VALUES (NULL, '$data', '$id_adres', '$id_dyscyplina', '1', '$nazwa', '$opis', '$zasady', '$transmisja', '$wpisowe','100')")){
        
                header('Location: spis-turniejow');
            }
            else
            {echo "<br/>Nie zapisano turnieju";};

        }
        else{ echo "<br/>Błąd";};
        
    
    };

    
    
}
else{echo "Nie zapisano adresu";};
};
};
?>