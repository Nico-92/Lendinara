<?php
function convertiData($dataEur){
$rsl = explode ('/',$dataEur);
$rsl = array_reverse($rsl);
return implode($rsl,'-');
}
require dirname(__FILE__) . '/' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("connessione impossibile"/* . mysql_error()*/);
mysql_select_db(DB_NAME, $conn) or die ("no database"/* . mysql_error()*/);
$id=$_POST['id'];
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

$nominativo=$_POST['nominativo'];
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
$contributo=$_POST['contributo'];
$luogonascita=mysql_escape_string($luogonascita);
$via=mysql_escape_string($via);
$citta=mysql_escape_string($citta);
$nominativo=mysql_escape_string($nominativo);
if($id){
	$query = "update iscritti set nominativo='$nominativo',datanascita='$datanascita',luogonascita='$luogonascita',via='$via',cap='$cap',citta='$citta',email='$email',telefono='$telefono',documento='$documento',visita='$visita',sangue='$sangue',contributo='$contributo' where id='$id'";
$result=mysql_query($query, $conn) or die('Error, insert query failed' . mysql_error());
$query3 = "update motorclub set tessera='$tessera', datatessera='$datatessera', importotessera='$importotessera',licenza='$licenza', datalicenza='$datalicenza', importolicenza='$importolicenza', tesserasport='$tesserasport', datasport='$datasport', importosport='$importosport' where id='$id'";
$result2=mysql_query($query3, $conn) or die('Error, insert query failed' . mysql_error());
	?>
<script>
alert("Dati modificati");
location.href = "modulo.php#corpo";
</script>
<?php
}
else{
	?>
<script>
alert("Impossibile modificare");
location.href = "modulo.php#corpo";
</script>
<?php }
?>