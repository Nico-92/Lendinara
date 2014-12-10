<?php
/*CONNESSIONE AL DATABASE */
require dirname(__FILE__) . '/' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("connessione impossibile"/* . mysql_error()*/);
mysql_select_db(DB_NAME, $conn) or die ("no database"/* . mysql_error()*/);

/* RECUPERO IL PARAMETRO IN FORMATO JSON, LO DECODIFICO */
$evento = $_GET['evento'];
$evento = json_decode($evento);

$nomeevento=$evento->{'nome'};
$dataevento=$evento->{'data'};
$luogoevento=$evento->{'luogo'};
$costoevento=$evento->{'costo'};
$altro=$evento->{'altro'};

$altro=mysql_escape_string($altro);
$nomeevento=mysql_escape_string($nomeevento);
$luogoevento=mysql_escape_string($luogoevento);
$dataevento=mysql_escape_string($dataevento);
$costoevento=mysql_escape_string($costoevento);
$query=" Update eventi set dataevento='$dataevento', luogoevento='$luogoevento', costoevento='$costoevento', altro='$altro' where nomeevento='$nomeevento' ";
$result=mysql_query($query, $conn) or die('Error, insert query failed' . mysql_error());
if($result){
	echo "true";
}else{
	echo $result;
}
?>
