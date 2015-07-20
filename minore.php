<?php
$nominativo=$_GET['nominativo'];
$datanascita=$_GET['datanascita'];
$datanascita = date("d-m-Y", strtotime($datanascita));
$luogonascita=$_GET['luogonascita'];
$citta=$_GET['citta'];
$via=$_GET['via'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script>
function goto(){
location.href = "modulo.php"; 	
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Assenso minori</title>
<style>
@import url("stilistampa.css") print;
#content{
	width:900px;
	height:1000px;
}
input{
	border:hidden;	
}
</style>
</head>
<body>
<input type="button" value="Chiudi" onclick="window.close()"/>
<a href="#" onclick="window.print();">Stampa pagina</a>
<div align="center">
<div id="content">
<img src="images/csen.png"/><img src="images/enduro.jpg" />
<table cellpadding="5px" border="5" width="880">
<tr>
<td width="435">
<h4>DICHIARAZIONE DI ASSENSO DEL PADRE<BR />ESERCENTE LA POTESTA' SU MINORE DI ANNI 18</h4>
(ex L. 4-1-1968 n.15 e D.P.R 25-1-1994 n.130 - cosi come integrata e modificata dalla L. 15-5-1997 n.127 ex art. 46 T.U.D.P.R n.445 del 28-12-2000)<br  /><br />
Il sottoscritto <input type="text" /><br />
nato a <input type="text" /><br />
il <input type="text" /><br />
in possesso di Tessera n. <input type="text" /><br />
residente a <input type="text" /><br />
Via/Piazza <input type="text" /> n° <input type="text" /><br /><br />
<b>Consapevole delle sanzioni penali previste dall'art. 76 T.U 445/2000, nel caso di mendaci dichiarazioni, falsità negli atti, uso o esibizione di atti falsi, contenenti dati non più rispondenti a verità<br /><br />DICHIARA SOTTO LA PROPRIA RESPONSABILITA'</b>
di essere il padre, esercente potestà su <input type="text" name="nominativo" value=" <?php echo $nominativo;?>"/><br />
nato/a a <input type="text" name="luogonascita" value=" <?php echo $luogonascita;?>"/><br />
il <input type="text" name="datanascita" value=" <?php echo $datanascita;?>"/><br />
residente a <input type="text"  name="citta" value=" <?php echo $citta;?>"/><br />
Via/Piazza <input type="text"  name="via" value=" <?php echo $via;?>"/> n° <input type="text" name="numero" /><br /><br />
di essere pienamente a conoscenza, autorizzare e consentire, che il figlio/a si iscriva alla A.S.D Enduro Lendinara quale tesserato e conduttore per partecipare a manifestazioni sportive di motociclismo, dichiarando fin'ora di conoscere, approvare e quindi osservare lo statuto Sociale ed i regolamenti connessi.<br />
Letto, confermato e sottoscritto.<br /><br />
Il dichiarante.............................................................................
<br /><br />
<b>Allegare copia documento d'identità e Modulo di tesseramento.<br /><br />
Informativa ai sensi del D.lgs. 196/2003: i dati riportati sono prescritti dalle vigenti disposizioni ai fini del procedimento per il quale sono richiesti e utilizzati esclusivamente a tale scopo.
</td>
<td width="435">
<h4>DICHIARAZIONE DI ASSENSO DELLA MADRE<BR />ESERCENTE LA POTESTA' SU MINORE DI ANNI 18</h4>
(ex L. 4-1-1968 n.15 e D.P.R 25-1-1994 n.130 - cosi come integrata e modificata dalla L. 15-5-1997 n.127 ex art. 46 T.U.D.P.R n.445 del 28-12-2000)<br /><br />
La sottoscritta <input type="text" /><br />
nata a <input type="text" /><br />
il <input type="text" /><br />
in possesso di Tessera n. <input type="text" /><br />
residente a <input type="text" /><br />
Via/Piazza <input type="text" /> n° <input type="text" /><br /><br />
<b>Consapevole delle sanzioni penali previste dall'art. 76 T.U 445/2000, nel caso di mendaci dichiarazioni, falsità negli atti, uso o esibizione di atti falsi, contenenti dati non più rispondenti a verità<br /><br />DICHIARA SOTTO LA PROPRIA RESPONSABILITA'</b><br />
di essere la madre, esercente potestà su <input type="text" name="nominativo" value=" <?php echo $nominativo;?>" /><br />
nato/a a <input type="text" name="luogonascita" value=" <?php echo $luogonascita;?>"/><br />
il <input type="text" name="datanascita" value=" <?php echo $datanascita;?>"/><br />
residente a <input type="text"  name="citta" value=" <?php echo $citta;?>"/><br />
Via/Piazza <input type="text"  name="via" value=" <?php echo $via;?>"/> n° <input type="text" name="numero" /><br /><br />
di essere pienamente a conoscenza, autorizzare e consentire, che il figlio/a si iscriva alla A.S.D Enduro Lendinara quale tesserato e conduttore per partecipare a manifestazioni sportive di motociclismo, dichiarando fin'ora di conoscere, approvare e quindi osservare lo statuto Sociale ed i regolamenti connessi.<br />
Letto, confermato e sottoscritto.<br /><br />
La dichiarante.............................................................................
<br /><br />
<b>Allegare copia documento d'identità e Modulo di tesseramento.<br /><br />
Informativa ai sensi del D.lgs. 196/2003: i dati riportati sono prescritti dalle vigenti disposizioni ai fini del procedimento per il quale sono richiesti e utilizzati esclusivamente a tale scopo.
</td></tr>
</table>
</div>
</div>
</body>
</html>