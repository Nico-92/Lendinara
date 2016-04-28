<?php

/*CONNESSIONE AL DATABASE */
require '../' . 'dbconfig.php';

//RECUPERO IL PARAMETRO IN FORMATO JSON, LO DECODIFICO
$evento = $_GET['evento'];
$evento = json_decode($evento);

// Escape delle stringhe
$nomeevento = mysql_escape_string($evento->{'nome'});
$dataevento = mysql_escape_string($evento->{'data'});
$luogoevento = mysql_escape_string($evento->{'luogo'});
$costoevento = mysql_escape_string($evento->{'costo'});
$altro = mysql_escape_string($evento->{'altro'});
//Verifica se tutti i controlli sono superati
$tuttOk = "true";
// No caratteri speciali su nome evento
if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬"-]/', $nomeevento)){
	$tuttOk = 'Il nome dell\'evento può contenere solo lettere, numeri e spazi';
}
// No data diversa da formato YYYY-MM-DD
if(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$dataevento)){
	$tuttOk = 'Il formato data è errato';
}
$date = new DateTime($dataevento);
$now = new DateTime();
// No data antecedente ad oggi
if($date < $now) {
	$tuttOk = 'La data dell\'evento deve essere una data presente o futura';
}
// No caratteri speciali su luogo evento
if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $luogoevento)){
	$tuttOk = 'Il luogo dell\'evento può contenere solo lettere, numeri e spazi';
}
if($tuttOk == "true"){
	$query = "INSERT INTO eventi (nomeevento, dataevento, luogoevento, costoevento, altro) VALUES ('$nomeevento','$dataevento','$luogoevento','$costoevento','$altro')";
	$result = mysql_query($query, $conn);// or die('Error, insert query failed ' . mysql_error());
	if ($result) {
	    echo "true";
	} 
	else {
		if (mysql_errno() == 1062) {
			die('Un evento con questo nome è già presente');
		}else{
			echo 'Errore, evento non salvato';
		}
	}
		// Creo il file txt (per compatibilità con la versione precedente)
	$var = fopen("../../eventi/" . $nomeevento . ".txt", "w+");
	for ($i = 0; $i < 200; $i++) {
	    fwrite($var, $i . ",");
	}
	fclose($var);
}else{
	echo $tuttOk;
}

mysql_close();
?>