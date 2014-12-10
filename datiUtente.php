<?php
	require dirname(__FILE__) . '/' . 'dbconfig.php';
	$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("connessione impossibile"/* . mysql_error()*/);
	mysql_select_db(DB_NAME, $conn) or die ("no database"/* . mysql_error()*/);

	/* SE È PRESENTE UN PARAMETRO GET VOGLIO I DATI DELL'EVENTO PASSATO*/
	if(isset($_GET['iscritto'])){
		/* RECUPERO IL PARAMETRO IN FORMATO JSON, LO DECODIFICO E NE ESTRAGGO IL VALORE, QUINDI LO INIETTO NELLA QUERY*/ 
		$iscritto = $_GET['iscritto'];
	
		$query = "SELECT *, date_format(datanascita,'%d/%m/%Y') FROM iscritti where nominativo= '$iscritto'";
		$result = mysql_query($query, $conn) or die('Error, select query1 failed'/* . mysql_error()*/);
		if(mysql_num_rows($result) == 0){
			echo 'false';
		}
		else{
			$array = mysql_fetch_array($result);
			$id = $array['id'];
			$query_tessere_lendinara = "SELECT * FROM lendinara where id = '$id'";
			$result_tessere_lendinara = mysql_query($query_tessere_lendinara, $conn) or die('Error, select query_tessere_lendinara failed'/* . mysql_error()*/);

			$query_tessere_motorclub = "SELECT * FROM motorclub where id = '$id'";
			$result_tessere_motorclub = mysql_query($query_tessere_motorclub, $conn) or die('Error, select query_tessere_motorclub failed' . mysql_error());
			
			$array_lendinara = mysql_fetch_array($result_tessere_lendinara);
			$array_motorclub = mysql_fetch_array($result_tessere_motorclub);
			
			$ris = '{ "nome": "'.$array['nominativo'].'",';
			$ris = $ris.'"datanascita": "'.$array['datanascita'].'",';
			$ris = $ris.'"luogonascita": "'.$array['luogonascita'].'",';
			$ris = $ris.'"via": "'.$array['via'].'",';
			$ris = $ris.'"cap": "'.$array['cap'].'",';
			$ris = $ris.'"citta": "'.$array['citta'].'",';
			$ris = $ris.'"email": "'.$array['email'].'",';
			$ris = $ris.'"telefono": "'.$array['telefono'].'",';
			$ris = $ris.'"varie": "'.$array['sangue'].'",';
			$ris = $ris.'"tessera_el": "'.$array_lendinara['tesserael'].'",';
			$ris = $ris.'"data_el": "'.$array_lendinara['datael'].'",';
			$ris = $ris.'"tessera_csen": "'.$array_lendinara['tesseracsen'].'",';
			$ris = $ris.'"data_csen": "'.$array_lendinara['datacsen'].'",';
			$ris = $ris.'"tessera_fmi": "'.$array_motorclub['tessera'].'",';
			$ris = $ris.'"data_fmi": "'.$array_motorclub['datatessera'].'",';
			$ris = $ris.'"tessera_sport": "'.$array_motorclub['tesserasport'].'",';
			$ris = $ris.'"data_sport": "'.$array_motorclub['datasport'].'",';
			$ris = $ris.'"licenza": "'.$array_motorclub['licenza'].'",';
			$ris = $ris.'"data_licenza": "'.$array_motorclub['datalicenza'].'",';
			$ris = $ris.'"id": "'.$id.'"';
			$ris = $ris.'}';
			echo $ris;
		}
	}
	
	mysql_close();
?>