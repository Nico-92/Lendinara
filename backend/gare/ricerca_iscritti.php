<?php
/*CONNESSIONE AL DATABASE */
require '../' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Connessione impossibile");
mysql_select_db(DB_NAME, $conn) or die("Database non presente");

/* RECUPERO IL PARAMETRO IN FORMATO JSON, LO DECODIFICO */
if(isset($_GET['evento'])){
	$evento = $_GET['evento'];
	$query = "SELECT * FROM r1 WHERE nomeevento='$evento' ";
	$result = mysql_query($query, $conn) or die('Error, query failed ' . mysql_error());
	if($result){
		//successo
		$i = 0;
		$ris = '[';
		while($array = mysql_fetch_array($result)){
			if($i==mysql_num_rows($result)-1)
				$ris=$ris . '{ "numero": '.$array['numero'].', "nome": "'.$array['nominativo'].'","nome2": "'.$array['nominativo1'].'","nome3": "'.$array['nominativo2'].'", "moto": "'.$array['moto'].'", "motoclub": "'.$array['motorclub'].'", "varie": "'.$array['varie'].'", "categoria": "'.$array['categoria'].'"}';
			else
				$ris=$ris . '{ "numero": '.$array['numero'].', "nome": "'.$array['nominativo'].'","nome2": "'.$array['nominativo1'].'","nome3": "'.$array['nominativo2'].'", "moto": "'.$array['moto'].'", "motoclub": "'.$array['motorclub'].'", "varie": "'.$array['varie'].'", "categoria": "'.$array['categoria'].'"},';
			$i++;
		}
		$ris=$ris.']';
		echo $ris;
	}else{
		//errore
		echo $result;
	}

}
else{
	//errore
	echo "Specifica un evento";
}
?>