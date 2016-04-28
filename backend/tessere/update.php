<?php 
/*CONNESSIONE AL DATABASE */
require '../' . 'dbconfig.php';

/* RECUPERO IL PARAMETRO IN FORMATO JSON, LO DECODIFICO */
$tessera = $_GET['tessera'];
$tessera = json_decode($tessera);
$codiceTessera=$tessera->{'Numero Tessera'};
$dataemissione=$tessera->{'Data emissione'};
$datascadenza=$tessera->{'Data Scadenza'};
$tipo=$tessera->{'Tipo'};
$assicurazione=$tessera->{'Assicurazione'};
$id=$tessera->{'id'};
$query_tessera = "UPDATE tessere SET tessera = '$codiceTessera', dataemissione = '$dataemissione', datascadenza = '$datascadenza', tipo = '$tipo', assicurazione = '$assicurazione' WHERE proprietario='$id'";
$result_tessera=mysql_query($query_tessera, $conn) or die('Errore, modifica tessera fallita: ' . mysql_error());
echo $datascadenza;
mysql_close();
?>