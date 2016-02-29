<?php

/*CONNESSIONE AL DATABASE */
require '../' . 'dbconfig.php';

$evento = $_GET['evento'];
$evento = json_decode($evento);
$evento = $evento->{'nome'};
$query = "select DISTINCT numero from r1 where nomeevento = '$evento' order by numero";
$result = mysql_query($query, $conn) or die(mysql_error());
$i = 0;
$ris = '{ "risultato": [';
while ($array = mysql_fetch_array($result)) {
    if ($i == mysql_num_rows($result) - 1) $ris = $ris . '{ "numero": "' . $array['numero'] . '"}';
    else $ris = $ris . '{ "numero": "' . $array['numero'] . '"},';
    $i++;
}
$ris = $ris . ']}';
echo $ris;
mysql_close();
?>