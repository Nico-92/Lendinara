<?php
	$a=$_POST['a'];
$query="select id from iscritti where nominativo='$a'";
$result=mysql_query($query, $conn) or die('Error, insert query failed' . mysql_error());
$array=mysql_fetch_array($result2);
$id=$array['id'];
$query="select * from r1 where id=10";
$result2=mysql_query($query, $conn) or die('Error, insert query failed' . mysql_error());
$array=mysql_fetch_array($result2);
$ris=$array['moto']."|".$array['motorclub']."|".$array['categoria']."|".$array['numero'];
echo $ris;
	?>