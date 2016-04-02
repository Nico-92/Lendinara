<?php
$login = $_GET['login'];
$login = json_decode($login);

$user = $login->{'username'};
$password = $login->{'password'};

if($user == 'demo' && $password == 'demo'){
	// $_SESSION["DB_NAME"] = 'my_nicolotresoldi';
	setcookie('DB_NAME', 'prova' , time() + (86400 * 30), "/");
	echo "true";
}else{
	setcookie('DB_NAME', '' , time() + (86400 * 30), "/");
	/*CONNESSIONE AL DATABASE */
	/*require '../' . 'logindbconfig.php';
	$query = "SELECT * FROM utenti WHERE user = '$user' AND password = '$password'";
	$result = mysql_query($query, $conn) or die('Error, insert query failed' . mysql_error());
	if(mysql_num_rows($result) == 0){
		$_SESSION["DB_NAME"] = '';
		echo "false";
	}else{
		$_SESSION["DB_NAME"] = 'enduroLendinara';
		echo "true";
	}
	mysql_close();*/
}


?>