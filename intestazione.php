<?php
require dirname(__FILE__) . '/' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("connessione impossibile"/* . mysql_error()*/);
mysql_select_db(DB_NAME, $conn) or die ("no database"/* . mysql_error()*/);
$parte1=$_POST['parte1'];
$parte1 = mysql_escape_string($parte1);
$query = "UPDATE varie SET parte1='$parte1'";
$result=mysql_query($query, $conn) or die('Error, insert query failed' . mysql_error());
?>
<script>
//alert("Intestazione salvata");
location.href = "modulo.php";
</script>