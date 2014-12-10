<?php
require dirname(__FILE__) . '/' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("connessione impossibile"/* . mysql_error()*/);
mysql_select_db(DB_NAME, $conn) or die ("no database"/* . mysql_error()*/);
$nome=$_POST['nominativo'];
$nome1=$_POST['nominativo1'];
$nome2=$_POST['nominativo2'];
$categoria=$_POST['categoria'];
$moto=$_POST['moto'];
$numero=$_POST['numero'];
$evento=$_POST['evento'];
$motorclub=$_POST['motorclub'];
$nomesquadra=$_POST['nomesquadra'];
//$query="SELECT MAX(squadra) FROM r1";
//$result=mysql_query($query, $conn) or die('Error, insert query failed' . mysql_error());
//$query2="SELECT id FROM iscritti where nominativo='$nome'";
//$result2=mysql_query($query2, $conn) or die('Error, insert query failed' . mysql_error());
//$array=mysql_fetch_array($result2);
//$squadra=$result['squadra']+1;
//echo $squadra;
//$id=$array['id'];
$query3="update r1 set categoria='$categoria', nominativo1='$nome1', nominativo2='$nome2', moto='$moto', numero='$numero' , motorclub='$motorclub' , squadra='$nomesquadra' where nominativo='$nome' and nomeevento='$evento'";
mysql_query($query3, $conn) or die('Error, insert query failed' . mysql_error());
mysql_close();
header("Location: riassuntoeventi.php?selectevento=".$evento);
?>