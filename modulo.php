<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8" />
<meta http-equiv="Content-type" content="text/html; charset=UTF-8"/>
<title>Modulo Iscrizione</title>
<link rel="stylesheet" type="text/css" href="css/stile.css" />
<?php 
require dirname(__FILE__) . '/' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("connessione impossibile"/* . mysql_error()*/);
mysql_select_db(DB_NAME, $conn) or die ("no database"/* . mysql_error()*/);
$query="select * from varie";
$result=mysql_query($query, $conn) or die('Error, insert query failed' . mysql_error());
$control=mysql_fetch_array($result); 
mysql_close();
?>


 <!-- bower:js -->
    <script src="js/jquery.js"></script>
    <script src="js/angular/angular.js"></script>
    <script src="js/angular/angular-resource.js"></script>
    <script src="js/angular/angular-cookies.js"></script>
    <script src="js/angular/angular-sanitize.js"></script>
    <script src="js/angular/angular-route.js"></script>
    <script src="js/angular/matchmedia-ng.js"></script>
<!-- endbower -->
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
<script src="bootstrap/js/bootstrap-ui.js"></script>

<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/app.js"></script>
<script type="text/javascript" src="js/iscrittiService.js"></script>
<script type="text/javascript" src="js/moduloController.js"></script>

<script type="text/javascript" src="script.js"></script>
<script src="ajax/prototype.js" type="text/javascript"></script>
<script src="ajax/effects.js" type="text/javascript"></script>
<script src="ajax/controls.js" type="text/javascript"></script>
<style type="text/css"> @import url("css/stilistampa.css") print;</style>
</head>
<body ng-app="lendinara">
<div align="center">
<a href="gara.php"><input tabindex="-1" type="button" value="Pannello di controllo" class="btn btn-default unstamp" /></a>
<a href="riassuntoeventi.php"><input tabindex="-1" type="button" value="Riassunto Eventi" class="btn btn-default unstamp" /></a>
<a href="riassuntoiscritti.php?on=1"><input tabindex="-1" type="button" value="Elenco tesserati" class="btn btn-default unstamp" /></a>
<!-- <input type="button" onclick="PlaySound();"/> -->

<div id="corpo">
	
	<div class="panel panel-default {{printable}}" class="printable" ng-controller="IscrizioneGaraCtrl">
		<div class="panel-heading">Iscrizione a gara<!--<span class="stampacheckbox unstamp"> <input type="checkbox" ng-model="numeri_doppi">Salva numeri doppi</span> --> <span class="stampacheckbox unstamp"><input type="checkbox" ng-model="vuoi_stampare"> Stampa iscrizione a gara</span></div>
		<div class="panel-body">
			<table border="1">
				<tr><td>
					<form name="evento" method="GET">
						<table class="table">
							<tr><th colspan="2">Dati Evento</th></tr>
							<tr><td colspan="2">
							<select tabindex="-1" ng-model="selezionaEvento" ng-options="evento.nome for evento in eventi" ng-change="selezionato()">
						    		<option value="">Seleziona Evento</option>
							</select>
						</td></tr>
							<tr><td>Costo</td><td><input tabindex="-1" type="text" ng-model="datievento.costo" class="input-small" disabled/></td></tr>
							<tr><td>Data</td><td><input tabindex="-1" type="date" ng-model="datievento.data" style="width:125px;" disabled /></td></tr>
							<tr><td>Luogo</td><td><input tabindex="-1" type="text" ng-model="datievento.luogo" class="input-small" disabled /></td></tr>
							<tr><td>Altro</td><td><input tabindex="-1" type="text" ng-model="datievento.altro" class="input-small" disabled /></td></tr>
							<tr><td colspan="2"><a tabindex="-1" href="gara.php" class="unstamp"><button type="button" class="btn btn-link unstamp" tooltip="Clicca per andare alla pagina di modifica evento"  tooltip-trigger="mouseenter" tooltip-placement="right">Modifica evento</button></a></td></tr>
							<tr><td colspan="2"><a tabindex="-1" href="stampa_iscritti.php?evento={{selezionaEvento.nome}}" class="unstamp" target="_blank"><button type="button" class="btn btn-link unstamp" ng-if="selezionaEvento"  >Stampa lista iscritti evento</button></a></td></tr>
						</table>
					</form>
				</td>
				<td>
				<form name="iscrizione">
				<tabset justified="true" >
			    	<tab heading="Dati Persona" select="reset()">

			    		<table class="table">
							<tr><td>Nome</td><td><input tabindex="1" type="text" ng-model="iscritto.nome" placeholder="Nome e cognome" typeahead="nome for nome in getIscritti($viewValue) | filter:$viewValue | limitTo:4" ng-blur="checkIscritto(iscritto.nome)" />
								<p class="error unstamp" ng-show="errore1">{{errore1}}</p></td></tr>
							<tr><td>Categoria</td><td><input tabindex="2" type="text" ng-model="iscritto.categoria" placeholder="Categoria" typeahead="categoria for categoria in getCategoria($viewValue) | filter:$viewValue | limitTo:4"/></td></tr>
							<tr><td>Moto</td><td><input tabindex="4" type="text" placeholder="Moto" ng-model="iscritto.moto" /></td></tr>
							<tr><td>M.C.</td><td><input tabindex="5"type="text" placeholder="Moto club" ng-model="iscritto.motoclub" /></td></tr>
							<tr><td>Varie</td><td><input tabindex="6"type="text" placeholder="Varie" ng-model="iscritto.varie" /></td></tr>
							<tr><td colspan="2"><button tabindex="7" type="submit" class="btn btn-success unstamp" ng-if="selezionaEvento" ng-click="iscrivi(iscritto)" >Iscrivi a {{selezionaEvento.nome}}</button>
									<button class="btn btn-danger unstamp" ng-if="!selezionaEvento"  disabled >Seleziona evento</button>
									<input type="reset" value="Pulisci form" class="unstamp" ng-click="reset()"/>
							</td></tr>
						</table>
			    	</tab>
				    <tab heading="Dati Squadra" select="reset()">

				    	<table class="table">
							<tr><td>Primo iscritto</td><td><input type="text" ng-model="iscritto.nome1" placeholder="Nome e cognome" typeahead="nome for nome in getIscritti($viewValue) | filter:$viewValue | limitTo:4" ng-blur="checkIscritto(iscritto.nome1)"/>
								<p class="error unstamp" ng-show="errore1">{{errore1}}</p></td></tr>
							<tr><td>Secondo iscritto</td><td><input type="text" ng-model="iscritto.nome2" placeholder="Nome e cognome" typeahead="nome for nome in getIscritti($viewValue) | filter:$viewValue | limitTo:4"  /></td></tr>
							<tr><td>Terzo iscritto</td><td><input type="text" ng-model="iscritto.nome3" placeholder="Nome e cognome" typeahead="nome for nome in getIscritti($viewValue) | filter:$viewValue | limitTo:4" /></td></tr>
							<tr><td>Categoria</td><td><input type="text" placeholder="Categoria" ng-model="iscritto.categoria" /></td></tr>
							<tr><td>Moto</td><td><input type="text" placeholder="Moto" ng-model="iscritto.moto" /></td></tr>
							<tr><td>M.C.</td><td><input type="text" placeholder="Moto club" ng-model="iscritto.motoclub" /></td></tr>
							<tr><td>Varie</td><td><input type="text" placeholder="Varie" ng-model="iscritto.varie" /></td></tr>
							<tr><td colspan="2"><input type="submit" class="btn btn-success unstamp" ng-if="selezionaEvento" ng-click="iscrivi(iscritto)" value="Iscrivi a {{selezionaEvento.nome}}" />
									<button class="btn btn-danger unstamp" ng-if="!selezionaEvento"  disabled >Seleziona evento</button>
									<input type="reset" value="Pulisci form" class="unstamp" ng-click="reset(1)"/>
							</td></tr>
						</table>
				    </tab>
			  	</tabset>

				</td>
				<td>
		        <table>
		        	<tr><th style="font-size:20px;"> Numero</th></tr>
		        	<tr><td><input tabindex="3" type="text" id="grandeNumero" ng-model="grandeNumero" class="input-small unstamp" ng-change="checkNumero();" required />
		        		<p class="alert alert-danger alert-dismissable" ng-if="numero_in_uso==true">Attenzione, numero già in uso</p></td></tr>
		        	<tr><td>
		        		<select ng-model="numeriDisponibili" ng-click="grandeNumero = numeriDisponibili">
      						<option ng-repeat="numero in numeriDisponibili" value="{{numero}}">{{numero}}</option>
      				</td></tr>
		        	<tr><td>&nbsp</td></tr>
		        	<tr><td>&nbsp</td></tr>
		        	<tr><td>&nbsp</td></tr>
		        	<tr><td style="font-size:200px; font-weight:bold;">{{grandeNumero}}</td></tr>
		        </table>
		    	</form>
				</td></tr>
			</table>
			<br />
			<div ng-if="risultato==true" class="alert alert-success alert-dismissable unstamp">{{messaggio}}</div>
			<div ng-if="risultato==false" class="alert alert-danger alert-dismissable unstamp">{{messaggio}}</div>
		</div>

			<!-- EVENTUALE TESTO -->

			<div id="testo" class="{{classeStampa}}" ng-repeat="testo in testi">
				<p class="list-group-item-text">{{testo.testo}}</p>
			</div>

			<!-- BOX FIRME -->

 			<div class="{{classeStampa}}" id="firma1">
			  	<div class="panel-heading">Firma</div>
			  	<div class="panel-body">
			    	Il sottoscritto: ...............................................................
			  	</div>
			</div>

			<br /><br /><br /><br /><br />

			<!-- AVVISI STRAPPABILI -->

			<div class="avviso {{classeStampa}}" style="width:420px; height:190px; float:left; border:double;"  name="altro1" align="left">
				<table border="1" width="100%" height="100%">
					<tr><td><h1><?php echo $control['altro1']; ?></h1></td>
						<td><h1>{{grandeNumero}}</h1></td>
					</tr>
				</table>
 			</div>

 			<div class="avviso {{classeStampa}}" style="width:420px; height:190px; float:right; border:double;"  name="altro1" align="left">
				<table border="1" width="100%" height="100%">
					<tr><td><h1><?php echo $control['altro2']; ?></h1></td>
						<td><h1>{{grandeNumero}}</h1></td>
					</tr>
				</table>
 			</div>

	</div> <!-- CHIUDO IL PANEL DI ISCRIZIONE A GARA -->


<br /><br />



<div class="panel panel-default {{printable}}" id="iscrizioneLendinara" ng-controller="IscrizioneLendinaraCtrl">
	<div class="panel-heading">Iscrizione a Enduro Lendinara</div>
	<div class="panel-body" >
		<form name="nuovaIscrizione" id="nuovaIscrizione">
			<table class="table larger-font">
				<tr>
					<td>Nome</td><td><input type="text" id="nominativo" placeholder="Nome e Cognome" ng-model="iscritto.nome" typeahead="nome for nome in getIscritti($viewValue) | filter:$viewValue | limitTo:4" typeahead-on-select="loadData($item)" ng-change="nuovoIscritto=true" required/></td>
					<td>Data nascita</td><td><input type="date" ng-model="iscritto.datanascita"/></td>
					<td>Luogo nascita</td><td><input type="text" placeholder="Luogo di nascita" ng-model="iscritto.luogonascita" typeahead="city.comune for city in cities | startsWith:$viewValue | limitTo:4" ng-blur="calcolaCodiceFiscale()"/></td>
				</tr>
				<tr>
					<td>Via</td><td><input type="text" placeholder="Via" ng-model="iscritto.via" /></td>
					<td>Città</td><td><input type="text" placeholder="Città" ng-model="iscritto.citta" typeahead="city.comune for city in cities | startsWith:$viewValue | limitTo:4" ng-blur="findCap()"/></td>
					<td>CAP</td><td><input type="text" placeholder="CAP" ng-model="iscritto.cap" readonly="readonly" /></td>
				</tr>
				<tr>
					<td>Email</td><td><input type="email" placeholder="Email" ng-model="iscritto.email"/></td>
					<td>Numero telefono</td><td><input type="text" placeholder="Numero telefono" ng-model="iscritto.telefono"/></td>
					<td>Scadenza certificato</td><td><input type="date" placeholder="Scadenza certificato" ng-model="iscritto.scadenza"/></td>
				</tr><tr>
					<td>Codice FIscale</td><td> <input type="text" placeholder="Codice fiscale" ng-model="iscritto.codicefiscale"/></td>
					<td><label style="display:inline" for="m">M</label><input type="radio" name="sesso" ng-model="iscritto.sesso" value="M">
						<label style="display:inline" for="f">F</label><input type="radio" name="sesso" ng-model="iscritto.sesso" value="F"></td>
					<td><button class="btn" ng-click="calcolaCodiceFiscale();">Ricalcola</button></td>
				</tr><tr>
					<td>Varie</td><td colspan="3" ><input type="text" placeholder="Varie" ng-model="iscritto.varie" style="width: 150%;" typeahead="nome for nome in getCommonVarie()"/></td>
				</tr>
			</table>
			  	
			  	<div class="panel-body" ng-show="stato=='Nascondi'">
			    	<table>
			      	<tr>
						<td>Tessera E.L.</td><td><input type="text" name="tesserael" ng-model="iscritto.tessera_el" /></td>
						<td>Data </td><td width="130"><input type="date" name="datatesserael" ng-model="iscritto.data_el" /></td>
					</tr><tr>
						<td>Tessera Csen</td><td><input type="text" name="tesseracsen" ng-model="iscritto.tessera_csen" /></td>
						<td>Data</td><td><input type="date" name="datatesseracsen" ng-model="iscritto.data_csen"  /></td>
					</tr>
					<tr>
						<td>Tessera FMI</td><td><input type="text" name="tesserafmi" ng-model="iscritto.tessera_fmi" /></td>
					    <td>Data</td><td><input type="date" name="datatesserafmi" ng-model="iscritto.data_fmi" /></td>
					</tr>
					<tr>
						<td>Tessera Sport</td><td><input type="text" name="tesserasport" ng-model="iscritto.tessera_sport" /></td>
					    <td>Data</td><td><input type="date" name="datasport" ng-model="iscritto.data_sport" /></td>
					</tr><tr>
					    <td>Licenza FMI</td><td><input type="text" name="licenzafmi" ng-model="iscritto.licenza" /></td>
					    <td>Data</td><td><input type="date" name="datalicenzafmi" ng-model="iscritto.data_licenza" /></td>
					</tr>
					</table>
			  	</div>
		
			  	<table class="table">
			    <tr>
			    	<td><input type="submit" value="Modifica" ng-click="salva(iscritto, 'modifica');" class="unstamp btn btn-warning" ng-show="iscritto.nome && iscritto.id"/></td>
			    	<td><input type="submit" value="Salva" ng-click="salva(iscritto, 'salva');" class="unstamp btn btn-success" ng-show="iscritto.nome && nuovoIscritto && !iscritto.id"/></td>
			   		<td><input type="button" value="Elimina" ng-click="elimina(iscritto);" class="unstamp btn btn-danger" ng-if="iscritto.nome"/></td>
			    	<td><input type="reset" value="Pulisci form" class="unstamp btn" ng-click="reset()" /></td><td><!--<input type="button" value="Modifica Moto Club" onclick="modificamotorclub();" />--></td><td><!--<input type="button" value="Salva Moto club" onclick="salvamotorclub();" class="unstamp" /> --></td>
			    	<td><button class="unstamp btn btn-info" ng-click="gestioneTessere();">{{stato}} tessere</button></td>
			    	<td><button class="unstamp btn btn-info" ng-click="stampa();" >Stampa</button></td>
			    </tr>
			
			<br />
			</table>
			<br />
			<div ng-if="risultato==true" class="alert alert-success alert-dismissable unstamp">{{messaggio}}</div>
			<div ng-if="risultato==false" class="alert alert-danger alert-dismissable unstamp">{{messaggio}}</div>
		</form>
		<div id="testo2" class="{{classeStampa}}" ng-repeat="testo in testi">
				<p class="list-group-item-text">{{testo.testo}}</p>
		</div>
		<!-- BOX FIRME -->
		<br /><br /><br />
 		<div class="{{classeStampa}}" id="firma1">
		  	<div class="panel-heading">Firma</div>
		  	<div class="panel-body">
		    	Il sottoscritto: ...............................................................
		  	</div>
		</div>

		<div class="{{classeStampa}}" id="firma2">
		  	<div class="panel-heading">Consenso per il trattamento dei dati personali</div>
		  	<div class="panel-body">
		    	Il sottoscritto: ..............................................................
		  	</div>
		</div>
		 
</div> </div><!-- CHIUDO IL PANEL DI ISCRIZIONE A LENDINARA -->


</div>
</div>
</body>
</html>