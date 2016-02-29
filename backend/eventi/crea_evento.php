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

$query = "INSERT INTO eventi (nomeevento, dataevento, luogoevento, costoevento, altro) VALUES ('$nomeevento','$dataevento','$luogoevento','$costoevento','$altro')";
$result = mysql_query($query, $conn) or die('Error, insert query failed ' . mysql_error());
if ($result) {
    echo "true";
} 
else {
    echo $result;
}

// Creo il file txt (per compatibilità con la versione precedente)
$var = fopen("../../eventi/" . $nomeevento . ".txt", "w+");
for ($i = 0; $i < 200; $i++) {
    fwrite($var, $i . ",");
}
fclose($var);
mysql_close();
?>