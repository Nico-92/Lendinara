<?php
/*CONNESSIONE AL DATABASE */
require '../' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Connessione impossibile");
mysql_select_db(DB_NAME, $conn) or die("Database non presente");

/* RECUPERO IL PARAMETRO IN FORMATO JSON, LO DECODIFICO */
$evento = $_GET['evento'];
echo $evento;
$iscritti = $_GET['iscritti'];
$iscritti = json_decode($iscritti);


for($i=0; $i< count($iscritti); $i++){
	$nome = $iscritti[$i]->nome;
	$numero = $iscritti[$i]->numero;
	$nome2 = $iscritti[$i]->nome2;
	$nome3 = $iscritti[$i]->nome3;
	$moto = $iscritti[$i]->moto;
	$motoclub = $iscritti[$i]->motoclub;
	$varie = $iscritti[$i]->varie;
	$categoria = $iscritti[$i]->categoria;
	$query="UPDATE r1 SET numero = '$numero', nominativo1 = '$nome2', nominativo2 = '$nome3', moto = '$moto', categoria = '$categoria', motorclub = '$motoclub', varie = '$varie' where nomeevento = '$evento' and nominativo = '$nome'";
	$result=mysql_query($query, $conn) or die('Error, update query failed' . mysql_error());
}
echo $result;

?>