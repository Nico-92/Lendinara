<?php 
/*CONNESSIONE AL DATABASE */
require '../' . 'dbconfig.php';

/* RECUPERO IL PARAMETRO IN FORMATO JSON, LO DECODIFICO */
$iscritto = $_GET['iscritto'];
$iscritto = json_decode($iscritto);

$evento = $iscritto->{'evento'};
$nome = $iscritto->{'nome'};
$nome2 = $iscritto->{'nome2'};
$nome3 = $iscritto->{'nome3'};
$categoria = $iscritto->{'categoria'};
$moto = $iscritto->{'moto'};
$motoclub = $iscritto->{'motoclub'};
$varie = $iscritto->{'varie'};
$grandeNumero = $iscritto->{'grandeNumero'};

$evento = mysql_escape_string($evento);
$varie = mysql_escape_string($varie);
$nome = mysql_escape_string($nome);
$nome2 = mysql_escape_string($nome2);
$nome3 = mysql_escape_string($nome3);
$categoria = mysql_escape_string($categoria);
$moto = mysql_escape_string($moto);
$motoclub = mysql_escape_string($motoclub);
$grandeNumero = mysql_escape_string($grandeNumero);

$controllo = "SELECT numero FROM r1 WHERE numero='$grandeNumero' AND nomeevento='$evento'";
$result_controllo = mysql_query($controllo, $conn) or die('Error, check query failed ' . mysql_error());
if( (mysql_num_rows($result_controllo) == 0) || ($grandeNumero == 0) ){
	$query = "INSERT INTO r1 (nomeevento, nominativo, moto, motorclub, categoria, varie, numero, nominativo1, nominativo2) VALUES ('$evento','$nome','$moto','$motoclub', '$categoria', '$varie', '$grandeNumero', '$nome2', '$nome3')";
	$result = mysql_query($query, $conn) or die('Error, insert query failed ' . mysql_error());
	if($result){
		echo 'true';
	}
	else{
		echo $result;
	}
	mysql_close();
	// // Leggi da txt per compatibilità
	// $var=fopen("eventi/".$evento.".txt","r");
	// $var2=fread($var,filesize("eventi/".$evento.".txt"));
	// fclose($var);
	// $var3 = explode(",", $var2);
	// for($i=0;$i<200;$i++){
	// 	if($var3[$i]==$grandeNumero){
	// 		$var3[$i]="-";
	// 		$i=200;
	// 	}
	// }
	// $var2 = implode(',', $var3);
	// $var=fopen("eventi/".$evento.".txt","w+");
	// fwrite($var, $var2);	
	// // Leggi XML
	// if (file_exists("eventi/".$evento)) {
	//     $xml = simplexml_load_file("eventi/".$evento);
	//     foreach ($xml->numero as $element) {
	//     	$numeri.push($element);
	//     }
	//  	echo $numeri;

	// }
	// else{
 //      	exit('Impossibile aprire il file contenente i numeri già assegnati');
	// }
}
else{
	echo "Numero già assegnato";
}
?>