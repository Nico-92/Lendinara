<?php
	require dirname(__FILE__) . '/' . 'dbconfig.php';
	$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("connessione impossibile"/* . mysql_error()*/);
	mysql_select_db(DB_NAME, $conn) or die ("no database"/* . mysql_error()*/);
	/* NON RECUPERO IL PARAMETRO, MA VIENE PASSATO IN CASO DI MIGLIORAMENTI FUTURI */
	$query ="select * from indice";
	$result = mysql_query ($query, $conn) or die(mysql_error());
	$i = 0;
	$ris= '{ "risultato": [';
	while($array = mysql_fetch_array($result)){
		if($i == mysql_num_rows($result)-1)
			$ris = $ris . '{ "varie": "'.$array['sangue'].'"}';
		else
			$ris = $ris . '{ "varie": "'.$array['sangue'].'"},';
		$i++;
	}
	$ris = $ris.']}';
	echo $ris;
	mysql_close();
?>