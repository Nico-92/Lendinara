<?php
	$a=$_POST['a'];
require dirname(__FILE__) . '/' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("connessione impossibile"/* . mysql_error()*/);
mysql_select_db(DB_NAME, $conn) or die ("no database"/* . mysql_error()*/);
$query2 = "select * from motorclub where id= '$a'";
$result2=mysql_query($query2, $conn) or die('Error, select query2 failed'/* . mysql_error()*/);
$array=mysql_fetch_array($result2);
$ris=$array['tessera']."|".$array['datatessera']."|"./*$array['importotessera']."|".*/$array['licenza']."|".$array['datalicenza']."|"./*$array['importolicenza']."|".*/$array['tesserasport']."|".$array['datasport'];//."|".$array['importosport'];
echo $ris;
?>