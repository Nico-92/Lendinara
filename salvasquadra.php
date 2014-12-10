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
$data=date('Y-m-d-H-i-s');
//$query="SELECT MAX(squadra) FROM r1";
//$result=mysql_query($query, $conn) or die('Error, insert query failed' . mysql_error());
//$query2="SELECT id FROM iscritti where nominativo='$nome'";
//$result2=mysql_query($query2, $conn) or die('Error, insert query failed' . mysql_error());
//$array=mysql_fetch_array($result2);
//$squadra=$result['squadra']+1;
//echo $squadra;
//$id=$array['id'];
$query3="insert into r1 (nominativo,nominativo1, nominativo2, nomeevento, squadra,moto, motorclub,categoria,numero,data) values ('$nome','$nome1','$nome2','$evento','$nomesquadra','$moto','$motorclub','$categoria','$numero','$data') ";
mysql_query($query3, $conn) or die('Error, insert query failed' . mysql_error());
$var=fopen("eventi/".$evento.".txt","r");
$var2=fread($var,filesize("eventi/".$evento.".txt"));
fclose($var);
$var3 = explode(",", $var2);
for($i=0;$i<200;$i++){
	if($var3[$i]==$numero){
		$var3[$i]="-";
		$i=200;
	}
}
$var2 = implode(',', $var3);
$var=fopen("eventi/".$evento.".txt","w+");
fwrite($var, $var2);
mysql_close();
header("Location: riassuntoeventi.php?selectevento=".$evento);
?>