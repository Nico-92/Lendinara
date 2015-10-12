<?php
/*CONNESSIONE AL DATABASE */
require dirname(__FILE__) . '/' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("Connessione impossibile"/* . mysql_error()*/);
mysql_select_db(DB_NAME, $conn) or die ("Database non presente"/* . mysql_error()*/);
header('Content-Type: text/html; charset=UTF-8');
/* RECUPERO IL PARAMETRO IN FORMATO JSON, LO DECODIFICO */
if(isset($_GET['tipo'])){
	$tipo = $_GET['tipo'];
	$query = "SELECT * FROM testi WHERE posizione='$tipo' ";
}
else{
	$query = "SELECT * FROM testi";
}
$result = mysql_query($query, $conn) or die('Error, query failed ' . mysql_error());

$i = 0;
$ris = '[';
while($array = mysql_fetch_array($result)){
	//$array['testo'] = str_replace("<br/>", "\n", $array['testo']);
	if($i==mysql_num_rows($result)-1)
		$ris = $ris . '{ "testo": "'.$array['testo'].'", "posizione": "'.$array['posizione'].'", "id": "'.$array['id'].'"}';
	else
		$ris = $ris . '{ "testo": "'.$array['testo'].'", "posizione": "'.$array['posizione'].'", "id": "'.$array['id'].'"},';
	$i++;
}
$ris=$ris.']';
echo $ris;
?>