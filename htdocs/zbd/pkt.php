<?php
session_start();
if ((!isset($_POST['id_zawodnik'])) || (!isset($_POST['id_turniej'])) || (!isset($_POST['punkty']))){
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
$id_dyscyplina = $_POST['id_dyscyplina']; 
$id_zawodnika = $_POST['id_zawodnik'];
$id_turnieju = $_POST['id_turniej'];
$punkty = $_POST['punkty'];
unset($_POST['zawodnik']);
unset($_POST['id_turniej']);
unset($_POST['punkty']);

if ($con->query("UPDATE zawodnicy_turn
SET punkty = '$punkty'
WHERE id_turniej = $id_turnieju AND id_zawodnicy = $id_zawodnika;")){
    
    
    $ranking = mysqli_query($con,
    "SELECT ranking.id 
    FROM ranking 
    WHERE ranking.id_dyscyplina=$id_dyscyplina
    AND ranking.id_zawodnik=$id_zawodnika");

    while($row = mysqli_fetch_array($ranking)){ 
        $id_ranking = $row['id'];
    }
    echo $id_ranking;
    $zawodnik = mysqli_query($con,
        "SELECT zawodnicy.id_zawodnicy, zawodnicy.imie, zawodnicy.nazwisko, zawodnicy.klub, zawodnicy_turn.punkty, zawodnicy.id_dyscyplina, turniej.id_turniej 
        FROM zawodnicy, zawodnicy_turn, turniej 
        WHERE zawodnicy.id_dyscyplina=$id_dyscyplina
        AND zawodnicy_turn.id_zawodnicy=zawodnicy.id_zawodnicy 
        AND turniej.id_dyscyplina=$id_dyscyplina
        AND turniej.id_turniej=zawodnicy_turn.id_turniej
        AND zawodnicy.id_zawodnicy=$id_zawodnika
        ORDER BY zawodnicy.id_zawodnicy ASC");
    
    $i=0;
    while($row = mysqli_fetch_array($zawodnik))
    {   
        if($i == 0){
            $pkt = $row['punkty'];
            $i = $i+1;
        }
        else{
            $pkt = $pkt + $row['punkty'];
            
            $i = $i+1;
        }
    }
    
    if ($con->query("REPLACE INTO ranking (id, id_dyscyplina, id_zawodnik, punkty) VALUES ($id_ranking, $id_dyscyplina, $id_zawodnika, $pkt);")){
        header('Location: spis-turniejow');}else{}; 

    
    if ($con->query("UPDATE zawodnicy_turn
    SET punkty = '$punkty'
    WHERE id_turniej = $id_turnieju AND id_zawodnicy = $id_zawodnika;")){
        header('Location: spis-turniejow');
    }
    else{};

    header('Location: spis-turniejow');
    
}
else
{echo "<br/>Nie zapisano punktów";};
};
};
?>