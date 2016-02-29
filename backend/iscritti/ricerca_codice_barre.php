<?php
/*CONNESSIONE AL DATABASE */
require '../' . 'dbconfig.php';

if (isset($_GET['codice'])) {
	$codice = $_GET['codice'];
	$query = "SELECT nominativo FROM iscritti WHERE barcode = '$codice'";
    $result = mysql_query($query, $conn) or die('Error, retrive name from id query failed' . mysql_error());
	echo mysql_result($result, 0);
}
mysql_close();
?>
