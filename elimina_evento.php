<?php
/*CONNESSIONE AL DATABASE */
require dirname(__FILE__) . '/' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("Connessione impossibile"/* . mysql_error()*/);
mysql_select_db(DB_NAME, $conn) or die ("Database non presente"/* . mysql_error()*/);

/* RECUPERO IL PARAMETRO IN FORMATO JSON, LO DECODIFICO */
$evento = $_GET['evento'];
$evento = json_decode($evento);
$nomeevento=$evento->{'nome'};

$query="DELETE FROM eventi WHERE nomeevento = '$nomeevento' LIMIT 1"; 
$result=mysql_query($query, $conn) or die('Error, select query1 failed'/* . mysql_error()*/);
$query="DELETE FROM r1 WHERE nomeevento = '$nomeevento'"; 
$result=mysql_query($query, $conn) or die('Error, select query1 failed'/* . mysql_error()*/);
if($result){
	echo "true";
}else{
	echo $result;
}
?>