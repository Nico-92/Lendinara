<?php

/*CONNESSIONE AL DATABASE */
require '../' . 'dbconfig.php';

$query = "SELECT altro1, altro2 FROM varie";

$result = mysql_query($query, $conn) or die('Error, query failed ' . mysql_error());
$array = mysql_fetch_array($result);
$ris = '{ "bigliettosx": "' . $array['altro1'] . '", "bigliettodx": "' . $array['altro2'] . '"}';
echo $ris;
mysql_close();
?>