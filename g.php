<?php
$a=$_GET['a'];
$b=$_GET['b'];
require dirname(__FILE__) . '/' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("connessione impossibile"/* . mysql_error()*/);
mysql_select_db(DB_NAME, $conn) or die ("no database"/* . mysql_error()*/);
$query="select * from r1 where nominativo='$a' and nomeevento='$b'";
$result=mysql_query($query, $conn) or die('Error, insert query failed' . mysql_error());
$array=mysql_num_rows($result);
$ris=$array;
$array=mysql_fetch_array($result);
$ris=$ris."|".$array['categoria']."|".$array['moto']."|".$array['numero']."|".$array['motorclub']."|".$array['squadra']."|".$array['nominativo1']."|".$array['nominativo2'];
echo $ris;
	?>