<?php

/*CONNESSIONE AL DATABASE */
require '../' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Connessione impossibile");
mysql_select_db(DB_NAME, $conn) or die("Database non presente");

$evento = $_GET['evento'];
$categoria = $_GET['categoria'];
$query = "select DISTINCT categoria from r1 where categoria like '$categoria%' and nomeevento = '$evento' order by categoria";
$result = mysql_query($query, $conn) or die(mysql_error());
$i = 0;
$ris = '{ "risultato": [';
while ($array = mysql_fetch_array($result)) {
    if ($i == mysql_num_rows($result) - 1) $ris = $ris . '{ "categoria": "' . $array['categoria'] . '"}';
    else $ris = $ris . '{ "categoria": "' . $array['categoria'] . '"},';
    $i++;
}
$ris = $ris . ']}';
echo $ris;
mysql_close();
?>