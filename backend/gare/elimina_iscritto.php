<?php
/*CONNESSIONE AL DATABASE */
require '../' . 'dbconfig.php';

$nome = $_GET['nome'];
$evento = $_GET['evento'];
$numero = $_GET['numero'];

$query3 = "DELETE FROM concorrenti WHERE nominativo1='$nome' AND nomeevento='$evento' ";
$result = mysql_query($query3, $conn) or die('Error, insert query failed' . mysql_error());
echo $result;
mysql_close();

/*$var = fopen("eventi/" . $evento . ".txt", "r");
$var2 = fread($var, filesize("eventi/" . $evento . ".txt"));
fclose($var);
$var3 = explode(",", $var2);
for ($i = 0; $i < 200; $i++) {
    if ($i == $numero) {
        $var3[$i] = $numero;
        $i = 200;
    }
}
$var2 = implode(',', $var3);
$var = fopen("eventi/" . $evento . ".txt", "w+");
fwrite($var, $var2);
header("Location: riassuntoeventi.php?selectevento=" . $evento);*/
?>