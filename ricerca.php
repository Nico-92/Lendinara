<?php
require dirname(__FILE__) . '/' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("connessione impossibile"/* . mysql_error()*/);
mysql_select_db(DB_NAME, $conn) or die ("no database"/* . mysql_error()*/);
$nominativo=$_POST['nominativo'];
$query="select id from iscritti where nominativo='$nominativo'";
$result=mysql_query($query, $conn) or die('Error, insert query failed' . mysql_error());
$id=$result['id'];
$query="select * from r1 where id='$id'";
$result2=mysql_query($query, $conn) or die('Error, insert query failed' . mysql_error());
$array=mysql_fetch_array($result2);
echo $array['moto'];
?>