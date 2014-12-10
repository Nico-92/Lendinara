<?php
function convertiData($dataEur){
$rsl = explode ('/',$dataEur);
$rsl = array_reverse($rsl);
return implode($rsl,'-');
}
require dirname(__FILE__) . '/' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("connessione impossibile"/* . mysql_error()*/);
mysql_select_db(DB_NAME, $conn) or die ("no database"/* . mysql_error()*/);
$tessera=$_POST['tesserafmi'];
$datatessera=$_POST['datatesserafmi'];
$importotessera=$_POST['importotessera'];
$datatessera=convertiData($datatessera);

$licenza=$_POST['licenzafmi'];
$datalicenza=$_POST['datalicenzafmi'];
$importolicenza=$_POST['importolicenza'];
$datalicenza=convertiData($datalicenza);

$tesserasport=$_POST['tesserasport'];
$datasport=$_POST['datasport'];
$importosport=$_POST['importosport'];
$datasport=convertiData($datasport);

$tesserael=$_POST['tesserael'];
$datatesserael=$_POST['datatesserael'];
$datatesserael=convertiData($datatesserael);
$tesseracsen=$_POST['tesseracsen'];
$datatesseracsen=$_POST['datatesseracsen'];
$datatesseracsen=convertiData($datatesseracsen);
$datatesseracsen = mysql_escape_string($datatesseracsen);

$id=$_POST['id'];
$nominativo=$_POST['nominativo'];
$nominativo= RTrim($nominativo);
$datanascita=$_POST['datanascita'];
$datanascita=convertiData($datanascita);
$luogonascita=$_POST['luogonascita'];
$via=$_POST['via'];
$cap=$_POST['cap'];
$citta=$_POST['citta'];
$email=$_POST['email'];
$visita=$_POST['visita'];
$sangue=$_POST['sangue'];
$telefono=$_POST['telefono'];
$documento=$_POST['documenti'];
$datanascita = mysql_escape_string($datanascita);
$luogonascita=mysql_escape_string($luogonascita);
$via=mysql_escape_string($via);
$citta=mysql_escape_string($citta);
$nominativo=mysql_escape_string($nominativo);
$evento=$_POST['evento'];
$contributo=$_POST['contributo'];
$nominativo1=$_POST['nominativo1'];
$nominativo2=$_POST['nominativo2'];
$e_categoria=$_POST['e_categoria'];
$e_moto=$_POST['e_moto'];
$e_numero=$_POST['e_numero'];
$e_motorclub=$_POST['e_motorclub'];
$e_varie=$_POST['e_varie'];
if($id){
	$query = "update iscritti set nominativo='$nominativo',datanascita='$datanascita',luogonascita='$luogonascita',via='$via',cap='$cap',	citta='$citta',email='$email',telefono='$telefono',documento='$documento',visita='$visita',sangue='$sangue', contributo='$contributo' where id='$id'";
	$result=mysql_query($query, $conn) or die('Error, insert query failed' . mysql_error());
	$query3 = "update lendinara set tesserael='$tesserael', datael='$datatesserael', 	tesseracsen='$tesseracsen', datacsen='$datatesseracsen' where id='$id'";
	$result2=mysql_query($query3, $conn) or die('Error, insert query failed' . mysql_error());
	$query4 = "update motorclub set tessera='$tessera', datatessera='$datatessera', importotessera='$importotessera',licenza='$licenza', datalicenza='$datalicenza', importolicenza='$importolicenza', tesserasport='$tesserasport', datasport='$datasport', importosport='$importosport' where id='$id'";
$result2=mysql_query($query4, $conn) or die('Error, insert query failed' . mysql_error());
$querycontrollo="SELECT nominativo FROM r1 WHERE nominativo='$nominativo'";
$resultcontrollo=mysql_query($querycontrollo, $conn) or die('Error, control query failed' . mysql_error());
if(mysql_num_rows($resultcontrollo)==0){
	$query4 = "insert into r1 (nominativo,nominativo1, nominativo2, nomeevento, squadra,moto,motorclub,categoria,numero,data) values ('$nominativo','$nominativo1','$nominativo2','$evento','$e_varie','$e_moto','$e_motorclub','$e_categoria','$e_numero','$data') ";
}else{
	$query4 = "UPDATE r1 SET nominativo='$nominativo', nominativo1='$nominativo1', nominativo2='$nominativo2', squadra='$e_varie', moto='$e_moto', motorclub='$e_motorclub', categoria='$e_categoria', numero='$e_numero' WHERE  nominativo='$nominativo'";
}
	$result3=mysql_query($query4, $conn) or die('Error, insert query failed' . mysql_error());
	mysql_close();
	//modifica file
	$var=fopen("eventi/".$evento.".txt","r");
$var2=fread($var,filesize("eventi/".$evento.".txt"));
fclose($var);
$var3 = explode(",", $var2);
for($i=0;$i<200;$i++){
	if($var3[$i]==$e_numero){
		$var3[$i]="-";
		$i=200;
	}
}
$var2 = implode(',', $var3);
$var=fopen("eventi/".$evento.".txt","w+");
fwrite($var, $var2);
	header("Location: modulo.php?selectevento=".$evento."#corpo");
}
else{
	?>
	<script>
	alert("Impossibile modificare");
	location.href = "modulo.php#corpo";
	</script>
	<?php
}
?>