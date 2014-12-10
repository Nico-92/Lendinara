<?php
require dirname(__FILE__) . '/' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("connessione impossibile"/* . mysql_error()*/);
mysql_select_db(DB_NAME, $conn) or die ("no database"/* . mysql_error()*/);
$parte3=$_POST['parte3'];
$somma1=$_POST['somma1'];
$somma2=$_POST['somma2'];
$somma3=$_POST['somma3'];
$altro1=$_POST['altro1'];
$altro2=$_POST['altro2'];

/*if($_POST['parte3']){
	$parte3=$_POST['parte3'];
	$parte3 = mysql_escape_string($parte3);
$query = "UPDATE varie SET parte3='$parte3'";}
if($_POST['somma1']){
	$somma1=$_POST['somma1'];
	$somma1 = mysql_escape_string($somma1);
$query = "UPDATE varie SET somma1='$somma1'";}
if($_POST['somma2']){
	$somma2=$_POST['somma2'];
	$somma2 = mysql_escape_string($somma2);
echo $somma2;
$query = "UPDATE varie SET somma2='$somma2'";}
if($_POST['somma3']){
	$somma3=$_POST['somma3'];
	$somma3 = mysql_escape_string($somma3);
$query = "UPDATE varie SET somma3='$somma3'";}
*/
$query = "UPDATE varie SET parte3='$parte3', somma1='$somma1', somma2='$somma2', somma3='$somma3', altro1='$altro1', altro2='$altro2'";
$result=mysql_query($query, $conn) or die('Error, insert query failed' . mysql_error());
?>
<script>
//alert("Intestazione salvata");
location.href = "modulo.php#totale"; 
</script>