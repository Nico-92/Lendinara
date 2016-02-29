<?php

/*CONNESSIONE AL DATABASE */
require '../' . 'dbconfig.php';

$query = "SELECT cauzione, acconto, codicefiscale, certificato FROM varie";

$result = mysql_query($query, $conn) or die('Error, query failed ' . mysql_error());
$array = mysql_fetch_array($result);
$ris = '{ "cauzione": "' . $array['cauzione'] . '", "codicefiscale": "' . $array['codicefiscale'] . '", "acconto": "' . $array['acconto'] . '", "certificato": "' . $array['certificato'] . '"}';
echo $ris;
mysql_close();
?>