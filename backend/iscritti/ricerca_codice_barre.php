<?php
/*CONNESSIONE AL DATABASE */
require '../' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Connessione impossibile");
mysql_select_db(DB_NAME, $conn) or die("Database non presente");

if (isset($_GET['codice'])) {
	$codice = $_GET['codice'];
	$query = "SELECT nominativo FROM iscritti WHERE barcode = '$codice'";
    $result = mysql_query($query, $conn) or die('Error, retrive name from id query failed' . mysql_error());
	echo mysql_result($result, 0);
}
mysql_close();
?>
