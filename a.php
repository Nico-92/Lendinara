<?php
	$a=$_GET['a'];
	$b=$_GET['b'];
require dirname(__FILE__) . '/' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("connessione impossibile"/* . mysql_error()*/);
mysql_select_db(DB_NAME, $conn) or die ("no database"/* . mysql_error()*/);
	$query = "select * from iscritti where nominativo= '$a'";
	$result=mysql_query($query, $conn) or die('Error, select query1 failed'/* . mysql_error()*/);
	$array=mysql_fetch_array($result);
	if($array['luogonascita']=="")$array['luogonascita']=" ";
	if($array['datanascita']=="")$array['datanascita']="0000-00-00";
	$ris=$array['luogonascita']."|".$array['datanascita']."|".$array['via']."|".$array['cap']."|".$array['citta']."|".$array['email']."|".$array['telefono']."|".$array['documento']."|".$array['visita']."|".$array['sangue']."|".$array['id']."|".$array['contributo'];
	$query = "select * from r1 where nominativo= '$a' and nomeevento='$b'";
	$result=mysql_query($query, $conn) or die('Error, select query1 failed'/* . mysql_error()*/);
	$array=mysql_fetch_array($result);
	$ris=$ris."|".$array['moto']."|".$array['motorclub']."|".$array['categoria']."|".$array['numero']."|".$array['squadra'];
	//$a=$array['id'];
//	$query2 = "select * from lendinara where id= '$a'";
//	$query3 = "select * from motorclub where id= '$a'";
//	$query4 = "select * from esterni where id= '$a'";
//	$result2=mysql_query($query2, $conn) or die('Error, select query2 failed'/* . mysql_error()*/);
//	if(mysql_num_rows($result2)>0){
//		$array2=mysql_fetch_array($result2);
//		$ris=$ris.$array['tesserael'].$array['datael'].$array['tesseracsen'].$array['datacsen'];
//	}
//	else{
//	$result3=mysql_query($query3, $conn) or die('Error, select query3 failed'/* . mysql_error()*/);
//		if(mysql_num_rows($result3)>0){
//			$array3=mysql_fetch_array($result3);
//			$ris=$ris.$array['tessera'].$array['datatessera'].$array['importotessera'].$array['licenza'].$array['datalicenza'].$array['importolicenza'].$array['tesserasport'].$array['datasport'].$array['importosport'];
//	}
//	else{
//		$result4=mysql_query($query4, $conn) or die('Error, select query4 failed'/* . mysql_error()*/);
//		$array4=mysql_fetch_array($result4);
//		$ris=$ris.$array['tessera'].$array['datatessera'].$array['licenza'].$array['datalicenza'].$array['procuratore'].$array['altro'];
//	}
//	}
//	 
	echo $ris;
	mysql_close();
?>