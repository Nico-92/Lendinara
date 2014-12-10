<?php
	require dirname(__FILE__) . '/' . 'dbconfig.php';
	$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("connessione impossibile"/* . mysql_error()*/);
	mysql_select_db(DB_NAME, $conn) or die ("no database"/* . mysql_error()*/);
	
		$query = "SELECT *, date_format(datanascita,'%d/%m/%Y') FROM iscritti";
		$result=mysql_query($query, $conn) or die('Error, select query1 failed'/* . mysql_error()*/);
		
		// $query_tessere_lendinara = "SELECT * FROM lendinara";
		// $result_tessere_lendinara = mysql_query($query_tessere_lendinara, $conn) or die('Error, select query_tessere_lendinara failed'/* . mysql_error()*/);
			
		//$array_lendinara=mysql_fetch_array($result_tessere_lendinara);
		$i = 0;
		$ris= '{ "risultato": [';
		while($array = mysql_fetch_array($result)) {
			$id = $array['id'];
			
			$query_tessere_motorclub = "SELECT * FROM motorclub where id = '$id'";
			$result_tessere_motorclub = mysql_query($query_tessere_motorclub, $conn) or die('Error, select query_tessere_motorclub failed' . mysql_error());
			$array_motorclub=mysql_fetch_array($result_tessere_motorclub);

			$ris = $ris . '{ "nome": "'.$array['nominativo'].'",';
			$ris = $ris . '"datanascita": "'.$array['datanascita'].'",';
			$ris = $ris . '"luogonascita": "'.$array['luogonascita'].'",';
			$ris = $ris . '"via": "'.$array['via'].'",';
			$ris = $ris . '"cap": "'.$array['cap'].'",';
			$ris = $ris . '"citta": "'.$array['citta'].'",';
			$ris = $ris . '"email": "'.$array['email'].'",';
			$ris = $ris . '"telefono": "'.$array['telefono'].'",';
			$ris = $ris . '"varie": "'.$array['sangue'].'",';
			// $ r is=$ r is.'"tessera_el": "'.$array_lendinara['tesserael'].'",';
			// $ r is=$ r is.'"data_el": "'.$array_lendinara['datael'].'",';
			// $ r is=$ r is.'"tessera_csen": "'.$array_lendinara['tesseracsen'].'",';
			// $ r is=$ r is.'"data_csen": "'.$array_lendinara['datacsen'].'",';
			$ris = $ris . '"tessera_fmi": "'.$array_motorclub['tessera'].'",';
			$ris = $ris . '"data_fmi": "'.$array_motorclub['datatessera'].'",';
			$ris = $ris . '"tessera_sport": "'.$array_motorclub['tesserasport'].'",';
			$ris = $ris . '"data_sport": "'.$array_motorclub['datasport'].'",';
			$ris = $ris . '"licenza": "'.$array_motorclub['licenza'].'",';
			$ris = $ris . '"data_licenza": "'.$array_motorclub['datalicenza'].'",';
			$ris = $ris . '"id": "'.$id.'"';
			if($i==mysql_num_rows($result)-1){
				$ris = $ris . '}';
			}else{
				$ris = $ris . '},';
				$i++;
			}
		}
		$ris=$ris.']}';
		echo $ris;

	mysql_close();
?>