<?php
/*CONNESSIONE AL DATABASE */
require '../' . 'dbconfig.php';
/* RECUPERO IL PARAMETRO IN FORMATO JSON, LO DECODIFICO */
$options = $_GET['options'];
$options = json_decode($options);
$certificato = $options->{'certificato'};
$acconto = $options->{'acconto'};
$cauzione = $options->{'cauzione'};
$codicefiscale = $options->{'codicefiscale'};
//INSERISCI IL TESTO
$insert_query = "UPDATE varie SET cauzione = '$cauzione', certificato = '$certificato', acconto = '$acconto', codicefiscale = '$codicefiscale'";
$result = mysql_query($insert_query, $conn) or die('Error, update query failed ' . mysql_error());
if ($result) {
    echo "true";
}
else {
    echo $result;
}
mysql_close();
?>
