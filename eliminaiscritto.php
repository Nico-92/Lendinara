<?php
require dirname(__FILE__) . '/' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("connessione impossibile"/* . mysql_error()*/);
mysql_select_db(DB_NAME, $conn) or die ("no database"/* . mysql_error()*/);
$nome=$_POST['nominativo'];
$evento=$_POST['evento'];
$numero=$_POST['numero'];
//$query="SELECT MAX(squadra) FROM r1";
//$result=mysql_query($query, $conn) or die('Error, insert query failed' . mysql_error());
//$query2="SELECT id FROM iscritti where nominativo='$nome'";
//$result2=mysql_query($query2, $conn) or die('Error, insert query failed' . mysql_error());
//$array=mysql_fetch_array($result2);
//$squadra=$result['squadra']+1;
//echo $squadra;
//$id=$array['id'];
$query3="delete from r1 where nominativo='$nome' and nomeevento='$evento' ";
mysql_query($query3, $conn) or die('Error, insert query failed' . mysql_error());
mysql_close();
$var=fopen("eventi/".$evento.".txt","r");
$var2=fread($var,filesize("eventi/".$evento.".txt"));
fclose($var);
$var3 = explode(",", $var2);
for($i=0;$i<200;$i++){
	if($i==$numero){
		$var3[$i]=$numero;
		$i=200;
	}
}
$var2 = implode(',', $var3);
$var=fopen("eventi/".$evento.".txt","w+");
fwrite($var, $var2);
header("Location: riassuntoeventi.php?selectevento=".$evento);
?>