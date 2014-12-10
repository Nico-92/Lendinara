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
$query5 = "select id from iscritti where id='$id'";
$result5=mysql_query($query5, $conn) or die('Error, insert query failed' . mysql_error());
if(mysql_num_rows($result5)==0){	
$tessera=$_POST['tesserafmi'];
$datatessera=$_POST['datatesserafmi'];
//$importotessera=$_POST['importotessera'];
$datatessera=convertiData($datatessera);

$licenza=$_POST['licenzafmi'];
$datalicenza=$_POST['datalicenzafmi'];
//$importolicenza=$_POST['importolicenza'];
$datalicenza=convertiData($datalicenza);

$tesserasport=$_POST['tesserasport'];
$datasport=$_POST['datasport'];
//$importosport=$_POST['importosport'];
$datasport=convertiData($datasport);

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
$datatessera = mysql_escape_string($datatessera);
$datalicenza = mysql_escape_string($datalicenza);
$datasport = mysql_escape_string($datasport);
$luogonascita=mysql_escape_string($luogonascita);
$via=mysql_escape_string($via);
$citta=mysql_escape_string($citta);
$nominativo=mysql_escape_string($nominativo);
$nominativo1=$_POST['nominativo1'];
$nominativo2=$_POST['nominativo2'];
$e_categoria=$_POST['e_categoria'];
$e_moto=$_POST['e_moto'];
$e_numero=$_POST['e_numero'];
$e_motorclub=$_POST['e_motorclub'];
$e_varie=$_POST['e_varie'];
$evento=$_POST['evento'];
if(!$id){
$query = "INSERT INTO iscritti (nominativo,datanascita,luogonascita,via,cap,citta,email,telefono,documento,visita,sangue) VALUES ('$nominativo','$datanascita','$luogonascita','$via','$cap','$citta','$email','$telefono','$documento','$visita','$sangue')";
$result=mysql_query($query, $conn) or die('Error, insert query failed' . mysql_error());
}
$query2="select id from iscritti where nominativo='$nominativo'";
$result=mysql_query($query2, $conn) or die('Error, insert query failed' . mysql_error());
$array=mysql_fetch_array($result);
$a=$array['id'];
$query3 = "INSERT INTO motorclub (id, tessera, datatessera, importotessera, licenza, datalicenza, importolicenza, tesserasport, datasport, importosport) VALUES ('$a', '$tessera', '$datatessera', '$importotessera','$licenza', '$datalicenza', '$importolicenza', '$tesserasport', '$datasport', '$importosport')";
$result2=mysql_query($query3, $conn) or die('Error, insert query failed' . mysql_error());
$query4 = "insert into r1 (nominativo,nominativo1, nominativo2, nomeevento, squadra,moto, motorclub,categoria,numero,data) values ('$nominativo','$nominativo1','$nominativo2','$evento','$e_varie','$e_moto','$e_motorclub','$e_categoria','$e_numero','$data') ";
$result3=mysql_query($query4, $conn) or die('Error, insert query failed' . mysql_error());
$query3 = "INSERT INTO lendinara (id, tesserael, datael, tesseracsen, datacsen ) VALUES ('$a', '', '', '', '')";
$result2=mysql_query($query3, $conn) or die('Error, insert query failed' . mysql_error());

$query3 = "INSERT INTO esterni (id, tessera, datatessera, licenza, datalicenza, procuratore, altro ) VALUES ('$a', '', '', '', '', '', '')";
$result2=mysql_query($query3, $conn) or die('Error, insert query failed' . mysql_error());

}
else{
	?>
    <script>
    alert("Iscritto gia presente");
	location.href = "modulo.php?selectevento=#corpo"; 	
    </script>
    <?php
}
mysql_close();
header("Location: modulo.php?selectevento=".$evento."#corpo");
?>
