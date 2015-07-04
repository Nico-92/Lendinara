<?php
	require dirname(__FILE__) . '/' . 'dbconfig.php';
	$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("connessione impossibile"/* . mysql_error()*/);
	mysql_select_db(DB_NAME, $conn) or die ("no database"/* . mysql_error()*/);
	/* NON RECUPERO IL PARAMETRO, MA VIENE PASSATO IN CASO DI MIGLIORAMENTI FUTURI */
	$query ="SELECT sangue FROM iscritti GROUP BY sangue ORDER BY COUNT(*) DESC LIMIT 10";
	$result = mysql_query ($query, $conn) or die(mysql_error());
	$i = 0;
	$ris= '{"risultato":[';
	while($array = mysql_fetch_array($result)){
			if($i == mysql_num_rows($result)-1){
				$ris = $ris . '"' . $array['sangue'] .'"' ;
			}
			else{
				$ris = $ris . '"' .$array['sangue'] . '",';
			}
			$i++;
	}
	$ris = $ris.']}';
	echo $ris;
	mysql_close();
?>