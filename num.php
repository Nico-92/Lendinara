<?php
	$a=$_POST['evento'];
require dirname(__FILE__) . '/' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("connessione impossibile"/* . mysql_error()*/);
$var=fopen("eventi/".$evento.".txt","r");
$var2=fread($var,filesize("eventi/".$a.".txt"));
$ris=$var2;
		echo $ris;
?>