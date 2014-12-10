<?php
$a=$_GET['a'];
$b=$_GET['b'];
require dirname(__FILE__) . '/' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("connessione impossibile"/* . mysql_error()*/);
mysql_select_db(DB_NAME, $conn) or die ("no database"/* . mysql_error()*/);
$query="select id from iscritti where nominativo='$a'";
$result=mysql_query($query, $conn) or die('Error, insert query failed' . mysql_error());
$result=mysql_fetch_array($result);
$a=$result['id'];
if($b==1){
	$query="select * from lendinara where id='$a'";
	$result=mysql_query($query, $conn) or die('Error, insert query failed' . mysql_error());
	$array=mysql_fetch_array($result);
	$ris=1;
	$ris=$ris."|".$array['tesserael']."|".$array['datael']."|".$array['tesseracsen']."|".$array['datacsen'];
}else{
	if($b==2){
		$query="select * from motorclub where id='$a'";
		$result=mysql_query($query, $conn) or die('Error, insert query failed' . mysql_error());
		$array=mysql_fetch_array($result);
		$ris=2;
		$ris=$ris."|".$array['tessera']."|".$array['datatessera']."|".$array['importotessera']."|".$array['licenza']."|".$array['datalicenza']."|".$array['importolicenza']."|".$array['tesserasport']."|".$array['datasport']."|".$array['importosport'];
	}else{
		$query="select * from esterni where id='$a'";
		$result=mysql_query($query, $conn) or die('Error, insert query failed' . mysql_error());
		$array=mysql_fetch_array($result);
		$ris=3;
		$ris=$ris."|".$array['tessera']."|".$array['datatessera']."|".$array['licenza']."|".$array['datalicenza']."|".$array['procuratore']."|".$array['altro'];
	}
}
echo $ris;
	?>