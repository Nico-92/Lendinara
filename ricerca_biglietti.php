<?php
/*CONNESSIONE AL DATABASE */
require dirname(__FILE__) . '/' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("Connessione impossibile"/* . mysql_error()*/);
mysql_select_db(DB_NAME, $conn) or die ("Database non presente"/* . mysql_error()*/);

$query = "SELECT altro1, altro2 FROM varie";

$result = mysql_query($query, $conn) or die('Error, query failed ' . mysql_error());
$array = mysql_fetch_array($result);
$ris = '{ "bigliettosx": "'.$array['altro1'].'", "bigliettodx": "'.$array['altro2'].'"}';
echo $ris;
?>