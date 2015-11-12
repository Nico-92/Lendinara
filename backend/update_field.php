<?php 
/*CONNESSIONE AL DATABASE */
require dirname(__FILE__) . '/' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("Connessione impossibile"/* . mysql_error()*/);
mysql_select_db(DB_NAME, $conn) or die ("Database non presente"/* . mysql_error()*/);

$data = $_GET['data'];
$data = json_decode($data);

$table=$data->{'table'};
$field=$data->{'field'};
$value=$data->{'value'};
$whereField=$data->{'whereField'};
$whereValue=$data->{'whereValue'};

$value=mysql_escape_string($value);
$whereValue=mysql_escape_string($whereValue);

$query = "UPDATE $table SET $field='$value' WHERE $whereField='$whereValue'";
$result = mysql_query($query, $conn) or die('Errore, modifica fallita: ' . mysql_error());
echo $result;
mysql_close();
?>