<?php session_start(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Riassunto eventi</title>
<link rel="stylesheet" type="text/css" href="css/stile.css" />
<script type="text/javascript" src="script.js"></script>
<?php 
require dirname(__FILE__) . '/' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("connessione impossibile"/* . mysql_error()*/);
mysql_select_db(DB_NAME, $conn) or die ("no database"/* . mysql_error()*/);
$query="select * from eventi";
$resultevento=mysql_query($query, $conn) or die('Error, insert query failed' . mysql_error());
$valore=$_GET['selectevento'];
if($valore=="Seleziona")
$valore="";
$query2="select * from eventi where nomeevento='$valore'";
$resultevento2=mysql_query($query2, $conn) or die('Error, insert query failed' . mysql_error());
$array=mysql_fetch_array($resultevento2); 
?>
<script src="ajax/prototype.js" type="text/javascript"></script>
<script src="ajax/effects.js" type="text/javascript"></script>
<script src="ajax/controls.js" type="text/javascript"></script>
<style type="text/css">
    div.campo{
	font-family:Verdana;
        font-size:10px;
    }
    div.boxsuggerimenti {
      font-family:Verdana;
      font-size:10px;
      position:absolute;
      background-color:white;
      border:1px solid #888;
      margin:0px;
      padding:0px;
    }
    div.boxsuggerimenti ul {
      list-style-type:none;
      margin:0px;
      padding:0px;
    }
    div.boxsuggerimenti ul li.selected { background-color: #C2EBEF;}
    div.boxsuggerimenti ul li {
      list-style-type:none;
      display:block;
      margin:0;
      padding:1px;
      cursor:pointer;
      border-bottom:1px solid #888;
    }
</style>
</head>
<body>
<input type="button" value="Modulo" onclick="goto();" />
<div align="center">
<div id="corpo">
<table border="1"><tr><td>
<form name="evento" method="GET" action="modificaevento.php">
<table><tr><td>Nome evento</td><td>
<select name="selectevento" onchange="evento2();">
<option>Seleziona</option>
 <?php 
 
	while($row =mysql_fetch_array($resultevento)){
		 print("<option value='".$row['nomeevento']."'");
		 if($array['nomeevento']==$row['nomeevento']){
		echo 'selected="selected"';
		
		 }
    	 print(">".$row['nomeevento']."</option>");
	}
    ?>
</select>
</td></tr>
<input type="text" hidden="hidden" name="ret" value="<?php echo $array['nomeevento'];?>" />
<td>Costo</td><td><input type="text" value="<?php echo $array['costoevento'];?>"  name="costoevento" /></td></tr>
<td>Data</td><td><input type="text" value="<?php echo $array['dataevento'];?>"  name="dataevento" /></td></tr>
<td>Luogo</td><td><input type="text" value="<?php echo $array['luogoevento'];?>"  name="luogoevento" /></td></tr>
</table>
</form>
</td><td><form name="squadra" method="post">
<div id="add1" style="display:none"><table><tr><td>Secondo partecipante</td>
<td><input type="text" id="nominativo1" name="nominativo1"/>
<div id="suggerimenti1" class="boxsuggerimenti"></div>
<script type="text/javascript">new Ajax.Autocompleter("nominativo1", "suggerimenti1", "cerca.php", {minChars: 1});</script></td>
</tr><tr><td>Terzo partecipante </td><td><input type="text" id="nominativo2" name="nominativo2"/>
<div id="suggerimenti2" class="boxsuggerimenti"></div>
<script type="text/javascript">new Ajax.Autocompleter("nominativo2", "suggerimenti2", "cerca.php", {minChars: 1});</script></td></tr>
</table>
</div>
<table>
<input type="text" hidden="hidden" name="evento" value=" <?php echo $_GET['evento'];?>" />
<tr><td>Nome</td><td><input name="nominativo" id="nominativo" type="text" onclick="control3();" onblur="control4();" /></td>
<div id="suggerimenti" class="boxsuggerimenti"></div>
<script type="text/javascript">new Ajax.Autocompleter("nominativo", "suggerimenti", "cerca.php", {minChars: 1});</script>
<td>Categoria</td><td><input type="text" name="categoria"  /></td></tr>
<tr><td>Moto</td><td><input type="text" name="moto" /></td>
<td>Numero</td><td><input type="text" size="3" id="numero" name="numero" onchange="control2();" onclick="style.backgroundColor=null" /><select name="elenco" onchange="pass();">
<option>Seleziona</option>
<?php 
 $var=fopen("eventi/".$_GET['selectevento'].".txt","r");
 $var2=fread($var,filesize("eventi/".$_GET['selectevento'].".txt"));
 $var3 = explode(",", $var2);
 for($i=0;$i<200;$i++){
	 print("<option value='".$var3[$i]."'");
    	 print(">".$var3[$i]."</option>");
	}
?>
</select></td>
<div id="suggerimentinum" class="boxsuggerimenti"></div>
<script type="text/javascript">new Ajax.Autocompleter("numero", "suggerimentinum", "num.php", {minChars: 1});</script>
</tr><tr><td>M.C.</td><td><input type="text" name="motorclub" /></td><td>Varie</td><td><input type="text" name="nomesquadra" /></td></tr>
<tr><td><input type="text" name="evento" hidden="hidden" value="<?php echo $array['nomeevento'];?>" /></td></tr>
<tr><td>Len.<input type="radio" name="database" value="1" onclick="script2(1);" /></td><td> Moto Club<input type="radio" name="database" value="2" onclick="script2(2);" /></td><td>Esterni<input type="radio" name="database" value="3" onclick="script2(3);" /></td></tr>

<div id="1" class="radiob">
<br />
Tessera E.L.&nbsp;&nbsp;<input type="text" name="tesserael" />
Data <input type="text" name="datatesserael" /><br />
Tessera CSEN<input type="text" name="tesseracsen" />
Data <input type="text" name="datatesseracsen" />
<br /><br />
</div>


<div id="2" class="radiob">
<br />
Tessera FMI <input type="text" name="tesserafmi" />
Data<input type="text" name="datatesserafmi" />
Costo<input type="text" name="importotessera" size="6" />€<br />
Tesse Sport <input type="text" name="tesserasport" />
Data<input type="text" name="datasport" />
Costo<input type="text" name="importosport" size="6" />€<br />
Licenza FMI <input type="text" name="licenzafmi" />
Data<input type="text" name="datalicenzafmi" />
Costo<input type="text" name="importolicenza" size="6" />€
<br /><br /></div>


<div id="3" class="radiob"><br />
Tessera&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="tessera" />
Data <input type="text" name="datatessera" /><br />
Licenza&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="licenza" />
Data <input type="text" name="datalicenza" /><br />
Procuratore<input type="text" name="procuratore" />
Altro <input type="text" name="altroesterni" />
<br /><br /></div>


<tr><td><input type="submit" value="Iscrivi" onclick="control();" /></td><td><input type="reset" value="Cancella" /></td><td><input type="button" value="Modifica" onclick="modificaiscritto();"/></td><td><input type="button" value="Elimina dalla gara" onclick="eliminaiscritto();"/><img src="+.png" onclick="add();" class="unstamp" /></td></tr>
</table>
</form></td></tr></table>
<br /><br />
<form name="tabella" method="post">
<table width="900" border="1" cellpadding="5px" align="center">
    <tr bgcolor="#66CC66"><td width="50px">Numero</td><td width="550px">Nome</td><td width="100px">Categoria</td><td width="100px">Moto</td><td width="100px">M.C</td><td width="50px">Varie</td></tr>
<tr><td><input type="text" name="numero" size="3" autofocus="autofocus" onchange="controltabella();" onclick="style.backgroundColor=null;"/></td>
<td><input type="text" name="nominativo" id="nominativo" />
<div id="suggerimenti2" class="boxsuggerimenti"></div>
<script type="text/javascript">new Ajax.Autocompleter("nominativo", "suggerimenti2", "cerca.php", {minChars: 1});</script></td>
<td><input type="text" name="categoria" /></td>
<td><input type="text" name="moto" /></td><td><input type="text" name="motorclub" /></td><td><input type="text" name="nomesquadra" /></td>
<td><input type="button" value="Salva" onclick="salvatabella();"/></td>
<td><input type="text" name="evento" hidden="hidden" value="<?php echo $array['nomeevento'];?>" /></td>

</tr>
<?php 
$app=$array['nomeevento'];
$query3="select nominativo, nominativo1, nominativo2, squadra, moto,motorclub,categoria,numero,data from r1 inner join eventi as e where r1.nomeevento='$app' and e.nomeevento='$app' order by data ";
$result3=mysql_query($query3, $conn) or die('Error, insert query failed' . mysql_error());
$count=mysql_num_rows($result3);
echo "Numero righe: ".$count;
$i=0;
while($i<$count){
	?>
    
    <tr>
    <td width="50px"><?php echo mysql_result($result3,$i,'numero')?></td>
    <td width="200px"><?php echo mysql_result($result3,$i,'nominativo')." - ".mysql_result($result3,$i,'nominativo1')." - ".mysql_result($result3,$i,'nominativo2');?></td>
    <td width="150px"><?php echo mysql_result($result3,$i,'categoria')?></td>
    <td width="200px"><?php echo mysql_result($result3,$i,'moto')?></td>
    <td width="200px"><?php echo mysql_result($result3,$i,'motorclub')?></td>
    <td width="100px"><?php echo mysql_result($result3,$i,'squadra')?></td>
    <td width="100px"><input type="button" value="Cancella" /></td>
    </tr>
    <?php
$i++;
}
mysql_close();
?>
</table>
</form>
</div>
</div>
</body>
</html>