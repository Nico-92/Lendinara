<?php
$a=$_GET['a'];
$b=$_GET['b'];
//$b="prova";
require dirname(__FILE__) . '/' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("connessione impossibile"/* . mysql_error()*/);
mysql_select_db(DB_NAME, $conn) or die ("no database"/* . mysql_error()*/);
$query="select * from r1 where numero='$a' and nomeevento='$b'";
$result=mysql_query($query, $conn) or die('Error, insert query failed' . mysql_error());
$array=mysql_num_rows($result);
echo $array;
	?>