<?php

/*CONNESSIONE AL DATABASE */
require '../' . 'dbconfig.php';

$nome = $_GET['nome'];
$query = "select nominativo from iscritti where nominativo like '$nome%' order by nominativo";
$result = mysql_query($query, $conn) or die(mysql_error());
$i = 0;
$ris = '{ "risultato": [';
while ($array = mysql_fetch_array($result)) {
    if ($i == mysql_num_rows($result) - 1) $ris = $ris . '{ "nome": "' . $array['nominativo'] . '"}';
    else $ris = $ris . '{ "nome": "' . $array['nominativo'] . '"},';
    $i++;
}
$ris = $ris . ']}';
echo $ris;
mysql_close();
?>