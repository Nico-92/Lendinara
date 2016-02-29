<?php 
/*CONNESSIONE AL DATABASE */
require '../' . 'dbconfig.php';

/* RECUPERO IL PARAMETRO IN FORMATO JSON, LO DECODIFICO */
$iscritto = $_GET['iscritto'];
$iscritto = json_decode($iscritto);

$funzione=$iscritto->{'funzione'};
$nome=$iscritto->{'nome'};
$datanascita=$iscritto->{'datanascita'};
$luogonascita=$iscritto->{'luogonascita'};
$via=$iscritto->{'via'};
$cap=$iscritto->{'cap'};
$citta=$iscritto->{'citta'};
$email=$iscritto->{'email'};
$telefono=$iscritto->{'telefono'};
$scadenza=$iscritto->{'scadenza'};
$codicefiscale=$iscritto->{'codicefiscale'};
$cauzione=$iscritto->{'cauzione'};
$datacauzione=$iscritto->{'datacauzione'};
$acconto=$iscritto->{'acconto'};
$dataacconto=$iscritto->{'dataacconto'};
$varie=$iscritto->{'varie'};
$tessera_el=$iscritto->{'tessera_el'};
$data_el=$iscritto->{'data_el'};
$tessera_fmi=$iscritto->{'tessera_fmi'};
$data_fmi=$iscritto->{'data_fmi'};
$tessera_csen=$iscritto->{'tessera_csen'};
$data_csen=$iscritto->{'data_csen'};
$tessera_sport=$iscritto->{'tessera_sport'};
$data_sport=$iscritto->{'data_sport'};
$licenza=$iscritto->{'licenza'};
$data_licenza=$iscritto->{'data_licenza'};

$nome=mysql_escape_string($nome);
$datanascita=mysql_escape_string($datanascita);
$luogonascita=mysql_escape_string($luogonascita);
$cap=mysql_escape_string($cap);
$via=mysql_escape_string($via);
$citta=mysql_escape_string($citta);
$email=mysql_escape_string($email);
$telefono=mysql_escape_string($telefono);
$scadenza=mysql_escape_string($scadenza);
$codicefiscale=mysql_escape_string($codicefiscale);
$cauzione=mysql_escape_string($cauzione);
$acconto=mysql_escape_string($acconto);
$varie=mysql_escape_string($varie);

/* VERIFICO SE DEVO SALVARE O MODIFICARE*/
if($funzione=="salva"){
	$query="insert into iscritti (nominativo, datanascita, luogonascita, via, cap, citta, email, telefono, sangue, scadenza_visita, codicefiscale, acconto, dataacconto, cauzione, datacauzione) values ('$nome', '$datanascita', '$luogonascita', '$via', '$cap', '$citta', '$email', '$telefono', '$varie', '$scadenza', '$codicefiscale', '$acconto', '$dataacconto', '$cauzione', '$datacauzione')";
	$result=mysql_query($query, $conn) or die('Errore, iscrizione fallita: ' . mysql_error());


	$query_get_id = "SELECT id FROM iscritti WHERE nominativo = '$nome'";
	$result_id = mysql_query($query_get_id, $conn) or die('Errore, non riesco a recuperare id: ' . mysql_error());
	$array=mysql_fetch_array($result_id);
	$id = $array['id'];
	$query_lendinara = "INSERT INTO lendinara (id,tesserael, tesseracsen, datael, datacsen) VALUES ('$id', '$tessera_el', '$tessera_csen', '$data_el', '$data_csen')";
	$result_lendinara=mysql_query($query_lendinara, $conn) or die('Errore, iscrizione tessere lendinara fallita: ' . mysql_error());
	$query_motoclub = "INSERT INTO motorclub (id, tessera, datatessera, licenza, datalicenza, tesserasport, datasport) VALUES ('$id', '$tessera_fmi', '$data_fmi', '$licenza', '$data_licenza', '$tessera_sport', '$data_sport')";
	$result_motoclub=mysql_query($query_motoclub, $conn) or die('Errore, iscrizione tessere motoclub fallita: ' . mysql_error());
}
else{
	$id=$iscritto->{'id'};
	$query = "UPDATE iscritti SET nominativo='$nome', datanascita='$datanascita', luogonascita='$luogonascita', via='$via', cap='$cap', citta='$citta', email='$email', telefono='$telefono', sangue='$varie', scadenza_visita='$scadenza', codicefiscale = '$codicefiscale', acconto = '$acconto', dataacconto = '$dataacconto', cauzione = '$cauzione', datacauzione = '$datacauzione' WHERE id='$id'";
	$result = mysql_query($query, $conn) or die('Errore, modifica fallita: ' . mysql_error());
	$query_lendinara = "UPDATE lendinara SET tesserael = '$tessera_el', datael = '$data_el', tesseracsen = '$tessera_csen', datacsen = '$data_csen' WHERE id='$id'";
	$result_lendinara=mysql_query($query_lendinara, $conn) or die('Errore, modifica tessere lendinara fallita: ' . mysql_error());
	$query_motoclub = "UPDATE motorclub SET tessera = '$tessera_fmi', datatessera = '$data_fmi', licenza = '$licenza', datalicenza = '$data_licenza', tesserasport = '$tessera_sport', datasport = '$data_sport' WHERE id='$id'";
	$result_motoclub=mysql_query($query_motoclub, $conn) or die('Errore, modifica tessere motoclub fallita: ' . mysql_error());
}
/* DOPO AVER ESEGUITO UNA DELLE DUE QUERY RITORNO TRUE O L'EVENTUALE ERRORE */
if(($result)&&($result_lendinara)&&($result_motoclub)){
	echo 'true';
}
else{
	echo $result." ".$result_lendinara." ".$result_motoclub;
}
mysql_close();

?>