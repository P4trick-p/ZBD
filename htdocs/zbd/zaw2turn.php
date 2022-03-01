<?php
session_start();
if ((!isset($_POST['id_zawodnik'])) || (!isset($_POST['id_turniej']))){
    header('Location: spis-turniejow');
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
       
$id_zawodnik = $_POST['id_zawodnik'];
$id_turniej = $_POST['id_turniej'];

unset($_POST['id_zawodnik']);
unset($_POST['id_turniej']);

if ($con->query("INSERT INTO zawodnicy_turn VALUES (NULL, '$id_turniej', '$id_zawodnik', 0)")){
    
    header('Location: spis-turniejow');
}
else
{echo "<br/>Nie wpisano zawodnika";};
};
};
?>