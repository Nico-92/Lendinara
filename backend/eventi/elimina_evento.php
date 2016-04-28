<?php

/*CONNESSIONE AL DATABASE */
require '../' . 'dbconfig.php';

// RECUPERO IL PARAMETRO IN FORMATO JSON, LO DECODIFICO
$evento = $_GET['evento'];
$evento = json_decode($evento);
$nomeevento = $evento->{'nome'};

$query = "DELETE FROM eventi WHERE nomeevento = '$nomeevento'";
$result = mysql_query($query, $conn) or die('Error, select query1 failed');

$query = "DELETE FROM concorrenti WHERE nomeevento = '$nomeevento'";
$result = mysql_query($query, $conn) or die('Error, select query1 failed');

if ($result) {
	unlink("../../eventi/" . $nomeevento . ".txt");
    echo "true";
} 
else {
    echo $result;
}
?>