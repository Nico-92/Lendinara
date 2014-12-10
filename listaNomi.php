<?php
	require dirname(__FILE__) . '/' . 'dbconfig.php';
	$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("connessione impossibile"/* . mysql_error()*/);
	mysql_select_db(DB_NAME, $conn) or die ("no database"/* . mysql_error()*/);
	$nome = $_GET['nome'];
	$query ="select nominativo from iscritti where nominativo like '$nome%' order by nominativo";
	$result = mysql_query ($query, $conn) or die(mysql_error());
	$i = 0;
	$ris= '{ "risultato": [';
	while($array = mysql_fetch_array($result)){
		if($i == mysql_num_rows($result)-1)
			$ris = $ris . '{ "nome": "'.$array['nominativo'].'"}';
		else
			$ris = $ris . '{ "nome": "'.$array['nominativo'].'"},';
		$i++;
	}
	$ris = $ris.']}';
	echo $ris;
	mysql_close();
?>