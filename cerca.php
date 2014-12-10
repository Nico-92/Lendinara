<?php
require dirname(__FILE__) . '/' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("connessione impossibile"/* . mysql_error()*/);
mysql_select_db(DB_NAME, $conn) or die ("no database"/* . mysql_error()*/);
$squadra=$_POST['nominativo'];
if($_POST['nominativo1'])
$squadra=$_POST['nominativo1'];
if($_POST['nominativo2'])
$squadra=$_POST['nominativo2'];

$query="select nominativo from iscritti where nominativo like '$squadra%' order by nominativo";
$result = mysql_query ($query, $conn) or die(mysql_error());
$ArrayRisultati=Array();
while ($risultati = mysql_fetch_array ($result)){
    array_push($ArrayRisultati,$risultati) ;
}
echo "<ul>";
for($a=0;$a<count($ArrayRisultati);$a++){
	echo "<li>".$ArrayRisultati[$a]['nominativo']."</li>";
}
echo "</ul>";
mysql_close();
?>
