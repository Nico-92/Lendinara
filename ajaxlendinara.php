<?php
	$a=$_POST['email'];
	require dirname(__FILE__) . '/' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("connessione impossibile"/* . mysql_error()*/);
mysql_select_db(DB_NAME, $conn) or die ("no database"/* . mysql_error()*/);
	$query = "select nominativo from iscritti where nominativo= '$a'";
	$result=mysql_query($query, $conn) or die('Error, select query failed'/* . mysql_error()*/);
	echo mysql_num_rows($result);
	mysql_close();
?>