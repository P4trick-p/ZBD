<?php
session_start();
if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
{
	header('Location: strona-glowna');
	exit();
}
else{
$host = "localhost";
$db_user = 'root';
$db_password = '';
$db_name = "zbd";

$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if ($polaczenie->connect_errno!=0)
{
	//echo "Error: ".$polaczenie->connect_errno;
	header('Location: zalogowano.php');
}
else
{
	$login = $_POST['login'];
	$haslo = $_POST['haslo'];
	

	$login = htmlentities($login, ENT_QUOTES, "UTF-8");
	$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");

	if ($rezultat = @$polaczenie->query(
	sprintf("SELECT * FROM uzytkownicy WHERE user='%s' AND pass='%s'",
	mysqli_real_escape_string($polaczenie,$login),
	mysqli_real_escape_string($polaczenie,$haslo))))
	{
		$ilu_userow = $rezultat->num_rows;
		if($ilu_userow>0)
		{
			$_SESSION['zalogowany'] = true;
			$wiersz = $rezultat->fetch_assoc();
			$_SESSION['id'] = $wiersz['id'];
			$_SESSION['user'] = $wiersz['user'];
			$_SESSION['pass'] = $wiersz['pass'];
			unset($_SESSION['blad']);
			$rezultat->free_result();
			
			header('Location: zalogowano.php');
		} else {
			
			$_SESSION['blad'] = '<span style="color:red"><h2>Błędne dane logowania</h2></br><h2>Spróbuj ponownie</h2></span>';
			header('Location: zalogowano.php');
			
		}
		
	}

	$polaczenie->close();
}}

?>