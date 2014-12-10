<?php
	require dirname(__FILE__) . '/' . 'dbconfig.php';
	$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("connessione impossibile"/* . mysql_error()*/);
	mysql_select_db(DB_NAME, $conn) or die ("no database"/* . mysql_error()*/);

	/* SE È PRESENTE UN PARAMETRO GET VOGLIO I DATI DELL'EVENTO PASSATO*/
	if( ( isset($_GET['numero'])) && (isset($_GET['evento'])) ){
		/* RECUPERO IL PARAMETRO IN FORMATO JSON, LO DECODIFICO E NE ESTRAGGO IL VALORE, QUINDI LO INIETTO NELLA QUERY*/ 
		$numero = $_GET['numero'];
		$evento = $_GET['evento'];
		$controllo = "select numero from r1 where numero='$numero' and nomeevento='$evento'";
		$result_controllo = mysql_query($controllo, $conn) or die('Error, check query failed ' . mysql_error());
		if(mysql_num_rows($result_controllo) == 0){
			echo true;
		}else{
			echo false;	
		}
	}
	
	mysql_close();
?>