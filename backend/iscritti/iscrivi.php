<?php 
/*CONNESSIONE AL DATABASE */
require '../' . 'dbconfig.php';

/* RECUPERO IL PARAMETRO IN FORMATO JSON, LO DECODIFICO */
$iscritto = $_GET['iscritto'];
$iscritto = json_decode($iscritto);
$tessere = $_GET['tessere'];
$tessere = json_decode($tessere);


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
// $assicurazione=$iscritto->{'assicurazione'};
$dataacconto=$iscritto->{'dataacconto'};
$varie=$iscritto->{'varie'};
// $tessera_el=$iscritto->{'tessera_el'};
// $data_el=$iscritto->{'data_el'};
// $tessera_fmi=$iscritto->{'tessera_fmi'};
// $data_fmi=$iscritto->{'data_fmi'};
// $tessera_csen=$iscritto->{'tessera_csen'};
// $data_csen=$iscritto->{'data_csen'};
// $tessera_sport=$iscritto->{'tessera_sport'};
// $data_sport=$iscritto->{'data_sport'};
// $licenza=$iscritto->{'licenza'};
// $data_licenza=$iscritto->{'data_licenza'};

$tessera = $tessere->{'tessera'};
$dataemissione = $tessere->{'dataemissione'};
$datascadenza = $tessere->{'datascadenza'};
$tipo = $tessere->{'tipo'};
$assicurazione = $tessere->{'assicurazione'};

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
$errore = '';
// VERIFICO SE DEVO SALVARE O MODIFICARE
if($funzione == "salva"){
	// Verifico che non ci sia un tesserato con lo stesso nome. Avere omonimi è un problema quando si fa la ricerca per noma per recuperare i dati
	$query_get_iscritto = "SELECT id FROM iscritti WHERE nominativo LIKE '%$nome%'";
	$result_get_iscritto = mysql_query($query_get_iscritto, $conn);
	if(mysql_num_rows($result_get_iscritto) != 0){
		$errore = 'Esiste già un iscritto con questo nome';
	}else{
		// Salvo i dati del tesserato
		$query="insert into iscritti (nominativo, datanascita, luogonascita, via, cap, citta, email, telefono, varie, scadenza_visita, codicefiscale, acconto, dataacconto, cauzione, datacauzione) values ('$nome', '$datanascita', '$luogonascita', '$via', '$cap', '$citta', '$email', '$telefono', '$varie', '$scadenza', '$codicefiscale', '$acconto', '$dataacconto', '$cauzione', '$datacauzione')";
		$result=mysql_query($query, $conn) or die('Errore, iscrizione fallita: ' . mysql_error());
		// Recupero l'id del tesserato appena salvato
		$query_get_id = "SELECT id FROM iscritti WHERE nominativo = '$nome'";
		$result_id = mysql_query($query_get_id, $conn) or die('Errore, non riesco a recuperare id: ' . mysql_error());
		$array=mysql_fetch_array($result_id);
		$id = $array['id'];
		// Uso l'id per salvare i dati della tessera
		if($tessera){
			$query_tessera = "INSERT INTO tessere (tessera, dataemissione, datascadenza, tipo, proprietario, assicurazione) VALUES ('$tessera', '$dataemissione', '$datascadenza', '$tipo', '$id', '$assicurazione')";
			$result_post_tessera = mysql_query($query_tessera, $conn) or die('Errore, salvataggio tessera fallita: ' . mysql_error());
		}else{
			$result_post_tessera = true;
		}
	}
}
// MODIFICO
else{
	// Modifico i dati del tesserato
	$id=$iscritto->{'id'};
	$query = "UPDATE iscritti SET nominativo='$nome', datanascita='$datanascita', luogonascita='$luogonascita', via='$via', cap='$cap', citta='$citta', email='$email', telefono='$telefono', varie='$varie', scadenza_visita='$scadenza', codicefiscale = '$codicefiscale', acconto = '$acconto', dataacconto = '$dataacconto', cauzione = '$cauzione', datacauzione = '$datacauzione' WHERE id='$id'";
	$result = mysql_query($query, $conn) or die('Errore, modifica fallita: ' . mysql_error());
	// Se è presente la tessera modifico anche quelli della tessera
	if($tessera){
		// Controllo che la tessera sia presente, in tal caso la modifico, altrimenti la creo
		$query_get_tessera = "SELECT id FROM tessere WHERE proprietario='$id' and tipo = 'Lendinara'";
		$result_get_tessera = mysql_query($query_get_tessera, $conn) or die('Errore, modifica tessera fallita: ' . mysql_error());
		if(mysql_num_rows($result_get_tessera) == 0){
			$query_post_tessera = "INSERT INTO tessere (tessera, dataemissione, datascadenza, tipo, proprietario, assicurazione) VALUES ('$tessera', '$dataemissione', '$datascadenza', '$tipo', '$id', '$assicurazione')";
			$result_post_tessera=mysql_query($query_post_tessera, $conn) or die('Errore, modifica tessera fallita: ' . mysql_error());
		}else{
			$query_post_tessera = "UPDATE tessere SET tessera = '$tessera', dataemissione = '$dataemissione', datascadenza = '$datascadenza', tipo = '$tipo', assicurazione = '$assicurazione' WHERE proprietario='$id' and tipo = 'Lendinara'";
			$result_post_tessera=mysql_query($query_post_tessera, $conn) or die('Errore, modifica tessera fallita: ' . mysql_error());	
		}
	}else{
		$result_post_tessera = true;
	}
}
// DOPO AVER ESEGUITO UNA DELLE DUE QUERY RITORNO TRUE O L'EVENTUALE ERRORE 
if($errore == ''){
	echo 'true';
}
else{
	echo $errore;
	// echo $result." ".$result_post_tessera;
}
mysql_close();
?>