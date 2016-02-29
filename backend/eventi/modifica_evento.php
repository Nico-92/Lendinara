<?php

/*CONNESSIONE AL DATABASE */
require '../' . 'dbconfig.php';

//RECUPERO IL PARAMETRO IN FORMATO JSON, LO DECODIFICO
$evento = $_GET['evento'];
$evento = json_decode($evento);

$nomeevento = mysql_escape_string($evento->{'nome'});
$dataevento = mysql_escape_string($evento->{'data'});
$luogoevento = mysql_escape_string($evento->{'luogo'});
$costoevento = mysql_escape_string($evento->{'costo'});
$altro = mysql_escape_string($evento->{'altro'});

$query = " UPDATE eventi SET dataevento='$dataevento', luogoevento='$luogoevento', costoevento='$costoevento', altro='$altro' WHERE nomeevento='$nomeevento' ";
$result = mysql_query($query, $conn) or die('Error, insert query failed' . mysql_error());
if ($result) {
    echo "true";
} 
else {
    echo $result;
}
mysql_close();
?>