<?php 
/*CONNESSIONE AL DATABASE */
require dirname(__FILE__) . '/' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("Connessione impossibile"/* . mysql_error()*/);
mysql_select_db(DB_NAME, $conn) or die ("Database non presente"/* . mysql_error()*/);

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

$query="insert into eventi (nomeevento, dataevento, luogoevento, costoevento, altro) values ('$nomeevento','$dataevento','$luogoevento','$costoevento','$altro')";
$result=mysql_query($query, $conn) or die('Error, insert query failed ' . mysql_error());
if($result){
	echo "true";
}else{
	echo $result;
}
// Creao l'XML
// $xml = new SimpleXMLElement('<xml/>');
// $numero = $xml->addChild('numero', '0');
// Header('Content-type: text/xml');
// print($xml->asXML("eventi/".$nomeevento));
// Creo il file txt (per compatibilità con la versione precedente)
$var=fopen("eventi/".$nomeevento.".txt","w+");
for($i=0;$i<200;$i++){
	fwrite($var, $i.",");
}
fclose($var);
mysql_close();

?>