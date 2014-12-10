<?php 
require dirname(__FILE__) . '/' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("connessione impossibile"/* . mysql_error()*/);
mysql_select_db(DB_NAME, $conn) or die ("no database"/* . mysql_error()*/);
$query2="select id from iscritti ";
$result2=mysql_query($query2, $conn) or die('Error, insert query failed' /*. mysql_error()*/);
echo $count=mysql_num_rows($result2);
while ($row = mysql_fetch_array($result2)) { 
	$a=$row['id'];
$query3 = "INSERT INTO esterni (id, tessera, datatessera, licenza, datalicenza, procuratore, altro ) VALUES ('$a', '', '', '', '', '', '')";
$result3=mysql_query($query3, $conn) or die('Error, insert query failed' . mysql_error());
}
?>