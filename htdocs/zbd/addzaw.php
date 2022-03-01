<?php
session_start();
if ((!isset($_POST['imie'])) || (!isset($_POST['nazwisko'])) || (!isset($_POST['klub'])) || (!isset($_POST['dyscyplina'])) || (!isset($_POST['opis']))){
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
        }}
       
$imie = $_POST['imie'];
$nazwisko = $_POST['nazwisko'];
$klub = $_POST['klub'];
$opis = $_POST['opis'];

unset($_POST['imie']);

if ($con->query("INSERT INTO zawodnicy VALUES (NULL, '$id_dyscyplina', '$imie', '$nazwisko', '$klub', '$opis')")){
    
    if($id = mysqli_query($con,
    "SELECT * FROM zawodnicy  
    ORDER BY id_zawodnicy DESC LIMIT 1")){
    $ile = $id->num_rows;
		if($ile>0){
            $wiersz = $id->fetch_assoc();
            $id_zawodnik = $wiersz['id_zawodnicy'];
            if ($con->query("INSERT INTO ranking VALUES (NULL ,'$id_dyscyplina', '$id_zawodnik', 0)")){
                header('Location: spis-turniejow');
            }

        }}
}
else
{echo "<br/>Nie zapisano zawodnika";};
};
};
?>