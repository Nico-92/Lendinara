<?php
function convertiData($dataEur){
$rsl = explode ('/',$dataEur);
$rsl = array_reverse($rsl);
return implode($rsl,'-');
}
require dirname(__FILE__) . '/' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("connessione impossibile"/* . mysql_error()*/);
mysql_select_db(DB_NAME, $conn) or die ("no database"/* . mysql_error()*/);
$query2="select datanascita,id from iscritti ";
$result2=mysql_query($query2, $conn) or die('Error, insert query failed' /*. mysql_error()*/);
$count=mysql_num_rows($result2);
$i=0;
while($i<$count){
	$data=mysql_result($result2,$i,'datanascita');
	$id=mysql_result($result2,$i,'id');
	$data=convertiData($data);
	$query3="update iscritti set datanascita='$data' where id='$id' ";
$result3=mysql_query($query3, $conn) or die('Error, insert query failed' /*. mysql_error()*/);
$i++;
}
?>