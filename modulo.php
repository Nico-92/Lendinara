<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8" />
<meta http-equiv="Content-type" content="text/html; charset=UTF-8"/>
<title>Modulo Iscrizione</title>
<link rel="stylesheet" type="text/css" href="css/vendor/bootstrap3.min.css" />
<link rel="stylesheet" type="text/css" href="css/stile.css" />
<?php 
require dirname(__FILE__) . '/' . 'dbconfig.php';
$query="select * from varie";
$result=mysql_query($query, $conn) or die('Error, insert query failed' . mysql_error());
$control=mysql_fetch_array($result); 
mysql_close();
?>

<script src="js/vendor.min.js"></script>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
<script type="text/javascript" src="js/vendor/bootstrap/bootstrap-ui.js"></script>
<script type="text/javascript" src="js/app.js"></script>
<script type="text/javascript" src="js/services/iscrittiService.js"></script>
<script type="text/javascript" src="js/services/eventiService.js"></script>
<script type="text/javascript" src="js/services/gareService.js"></script>
<script type="text/javascript" src="js/services/translationService.js"></script>
<script type="text/javascript" src="js/services/testiService.js"></script>
<script type="text/javascript" src="js/translationController.js"></script>
<script type="text/javascript" src="js/tesseramentoController.js"></script>
<script type="text/javascript" src="js/iscrizioneGaraController.js"></script>
<script type="text/javascript" src="js/scannerDetector.js"></script>
		
<script type="text/javascript" src="script.js"></script>
<script type="text/javascript" src="ajax/prototype.js" ></script>
<script type="text/javascript" src="ajax/effects.js" ></script>
<script type="text/javascript" src="ajax/controls.js" ></script>
<style type="text/css"> @import url("css/stilistampa.css") print;</style>
<script type="text/javascript" src="//fast.eager.io/c2PMTMaiw7.js"></script>
</head>
<body ng-app="lendinara">
 <div class="col-md-12 languageNavbar unstamp" id="main-menu" ng-controller="translationController">
    <span class="language" ng-click="changeLanguage('en')">
        ENGLISH
    </span>
    <span class="language" ng-click="changeLanguage('it')">
        ITALIAN
    </span>
    <a href="gara.php"><input tabindex="-1" type="button" value="Pannello di controllo" class="btn btn-default unstamp" /></a>
	<a href="riassuntoiscritti.php?on=1"><input tabindex="-1" type="button" value="Elenco tesserati" class="btn btn-default unstamp" /></a>
	<button class="btn btn-success" id="startDemo">DEMO</button>
	<a href="tutorial.php"><input tabindex="-1" type="button" value="Guida" class="btn btn-default unstamp" /></a>
</div>
<div align="center">
<div class="panel panel-default {{printable}}" id="iscrizioneLendinara" ng-controller="tesseramentoCtrl">
	<p id="testo2Blocco1" class="{{classeStampa}}" style="white-space: pre-wrap;"  >{{blocco1}}</p>
	<div class="panel-heading">{{translation.SUBSCRIPTION}}</div>
	<div class="panel-body" >
		<form name="nuovaIscrizione" id="nuovaIscrizione">
			<table class="table larger-font">
				<tr>
					<td>{{translation.NAME}}</td><td><input type="text" autocomplete="off" id="nominativo" ng-model="iscritto.nome" typeahead="nome for nome in getIscritti($viewValue) | filter:$viewValue | limitTo:4" typeahead-on-select="loadData($item)" ng-change="nuovoIscritto=true" required/></td>
					<td>{{translation.BIRTH_DATE}}</td><td><input type="date" ng-model="iscritto.datanascita"/></td>
					<td>{{translation.BIRTH_PLACE}}</td><td><input type="text" ng-model="iscritto.luogonascita" typeahead="city.comune for city in cities | startsWith:$viewValue | limitTo:4" ng-blur="calcolaCodiceFiscale()"/></td>
				</tr>
				<tr>
					<td>Via</td><td><input type="text" ng-model="iscritto.via" /></td>
					<td>{{translation.CITY}}</td><td><input type="text" ng-model="iscritto.citta" typeahead="city.comune for city in cities | startsWith:$viewValue | limitTo:4" ng-blur="findCap()"/></td>
					<td>CAP</td><td><input type="text" ng-model="iscritto.cap" /></td>
				</tr>
				<tr>
					<td>Email</td><td><input type="email" ng-model="iscritto.email"/></td>
					<td>Numero telefono</td><td><input type="text"  ng-model="iscritto.telefono"/></td>
					<td>Scadenza certificato</td><td><input type="date"  ng-model="iscritto.scadenza"/></td>
				</tr>
				<tr>
					<td>Varie</td><td colspan="3" ><input type="text" ng-model="iscritto.varie" style="width: 150%;" typeahead="nome for nome in getCommonVarie()"/></td>
				</tr>
				<!-- <tr><td colspan="2" ng-show="options.avanzate == undefined && avanzatePresenti == true" ng-click="options.avanzate = true">
				 	<button class="btn btn-link">Mostra avanzate</button>
				</td></tr>
				<tr><td colspan="2" ng-show="options.avanzate == true" ng-click="options.avanzate = undefined">
				 	<button class="btn btn-link">Nascondi avanzate</button>
				</td></tr> -->
				<tr ng-show="options.avanzate == true && options.codicefiscale == true">
					<td>Codice Fiscale</td><td> <input type="text" placeholder="Codice fiscale" id="codicefiscale" ng-model="iscritto.codicefiscale"/></td>
					<td><label style="display:inline" for="m">M</label><input type="radio" name="sesso" ng-model="iscritto.sesso" value="M">
						<label style="display:inline" for="f">F</label><input type="radio" name="sesso" ng-model="iscritto.sesso" value="F"></td>
					<td><button class="btn unstamp" ng-click="calcolaCodiceFiscale();">Ricalcola</button></td>
				</tr>
				<tr ng-show="options.avanzate == true && options.acconto == true">
					<td>Pagamento</td>
					<td><input type="text" ng-model="iscritto.acconto"/></td>
					<td>Data pagamento</td>
					<td><input type="date" ng-model="iscritto.dataacconto"/></td>
				</tr>
				<tr ng-show="options.avanzate == true && options.assicurazione == true">
					<td>Ass.</td>
					<td>
						<select ng-model="iscritto.assicurazione">
							<option value="Base" selected="selected">Base</option>
							<option value="A">Integrativa A</option>
							<option value="B">Integrativa B</option>
							<option value="C">RCT Integrativa C</option>
							<option value="CSEN">RCT Istruttori Csen</option>
						</select>
					</td>
				</tr>
				<tr ng-show="options.avanzate == true && options.cauzione == true">
					<td>Cauzione</td>
					<td><input type="text" ng-model="iscritto.cauzione"/></td>
					<td>Data Cauzione</td>
					<td><input type="date" ng-model="iscritto.datacauzione"/></td>
				</tr>
			</table>
			  	<div ng-repeat="tessera in tessere">
			  		<div ng-if="tesseraMancante==true" class="alert alert-danger alert-dismissable unstamp">Nessuna tessera trovata</div>
				  	<table class="table larger-font">
				  		<tr>
				  			<td>Tipo:</td>
				  			<td>
						  		<select ng-model="tessera.tipo">
						  			<option  value="Lendinara" selected="selected">Lendinara</option>
						  			<option value="csen">csen</option>
						  		</select>
				  			</td>
				  			<td>Numero:</td>
				  			<td>
				  				<input type="text" ng-model="tessera.tessera" ng-focus="tesseraMancante = false"></input>
				  			</td>
				  			<td>Ass.:</td>
				  			<td>
				  				<select ng-model="tessera.assicurazione">
									<option value="Base" selected="selected">Base</option>
									<option value="A">Integrativa A</option>
									<option value="B">Integrativa B</option>
									<option value="C">RCT Integrativa C</option>
									<option value="CSEN">RCT Istruttori Csen</option>
								</select>
				  			</td>
				  		</tr>
				  		<tr>
				  			<td>Emissione:</td>
				  			<td><input type="date" ng-model="tessera.dataemissione" ng-change="aggiornaDataScadenza()"></input></td>
				  			<td>Scadenza:</td>
				  			<td><input type="date" ng-model="tessera.datascadenza" ></input></td>
				  		</tr>
					</table>
			  	</div>
			  	<!-- <div class="panel-body" ng-show="stato=='Nascondi'">
			    	<table>
			      	<tr>
						<td>Tessera E.L.</td><td><input type="text" name="tesserael" id="tesserael" ng-model="iscritto.tessera_el" /></td>
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
			  	</div> -->
				<div class="row unstamp">
					<div class="col-md-2" ng-show="iscritto.nome && iscritto.id"><input type="submit" value="Modifica" ng-click="salva(iscritto, 'modifica');" class="unstamp btn btn-warning" /></div>
					<div class="col-md-2" ng-show="iscritto.nome && nuovoIscritto && !iscritto.id"><input type="submit" value="Salva" ng-click="salva(iscritto, 'salva');" class="unstamp btn btn-success" /></div>
					<div class="col-md-2"  ng-show="iscritto.nome"><input type="button" value="Elimina" ng-click="elimina(iscritto);" class="unstamp btn btn-danger"/></div>
					<!-- <div class="col-md-2"><button class="unstamp btn btn-info" ng-click="gestioneTessere();">{{stato}} tessere</button></div> -->
					<div class="col-md-2"><button ng-show="!nuovoIscritto" class="unstamp btn btn-info" ng-click="stampa();" >Stampa</button></div>
					<div class="col-md-2" ng-show="iscritto.nome"><a href="tessera.php?nome={{iscritto.nome}}" target="_blank" class="unstamp btn btn-info"  >
			    			Stampa tessera
			    		</a></div>
			    	<div class="col-md-2"><input type="button" value="Pulisci form" class="unstamp btn" ng-click="reset()" /></div>
			    	<div class="col-md-2" ng-show="controlloMinorenni(iscritto, true) ==true"><input type="button" value="Assenso" class="unstamp btn" ng-click="apriLiberatoria(iscritto)" /></div>
			    	
				</div>
			  	
			<br />
			<div ng-if="risultato==true" class="alert alert-success unstamp">{{messaggio}}</div>
			<div ng-if="risultato==false" class="alert alert-danger unstamp">{{messaggio}}</div>
		</form>
		
		<p id="testo2Blocco2" class="{{classeStampa}}" style="white-space: pre-wrap;"  >{{blocco2}}</p>
		
		<!-- BOX FIRME -->
		<!-- <br /><br /><br />
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
		</div>	  -->
</div> </div><!-- CHIUDO IL PANEL DI ISCRIZIONE A LENDINARA -->


<br /><br />


<div id="corpo">
	<div class="panel panel-default {{printable}}" class="printable" id="iscrizioneGara" ng-controller="IscrizioneGaraCtrl">
		<div class="panel-heading">{{translation.SUBSCRIBE_TO_MATCH}}<!--<span class="stampacheckbox unstamp"> <input type="checkbox" ng-model="numeri_doppi">Salva numeri doppi</span> --> <span class="stampacheckbox unstamp"><input type="checkbox" ng-model="vuoi_stampare"> {{translation.PRINT}} {{translation.SUBSCRIPTION}}</span></div>
		<div class="panel-body">
			<table border="1">
				<tr><td>
					<form name="evento" method="GET">
						<table class="table">
							<tr><th colspan="2">{{translation.EVENT_INFO}}</th></tr>
							<tr><td colspan="2">
							<select tabindex="-1" ng-model="selezionaEvento" ng-options="evento.nome for evento in eventi" ng-change="selezionato()">
						    		<option value="">{{translation.SELECT_EVENT}}</option>
							</select>
						</td></tr>
							<tr><td>{{translation.PRICE}}</td><td><input tabindex="-1" type="text" ng-model="datievento.costo" class="input-small" disabled/></td></tr>
							<tr><td>{{translation.DATE}}</td><td><input tabindex="-1" type="date" ng-model="datievento.data" style="width:125px;" disabled /></td></tr>
							<tr><td>{{translation.PLACE}}</td><td><input tabindex="-1" type="text" ng-model="datievento.luogo" class="input-small" disabled /></td></tr>
							<tr><td>{{translation.MISC}}</td><td><input tabindex="-1" type="text" ng-model="datievento.altro" class="input-small" disabled /></td></tr>
							<tr><td colspan="2"><a tabindex="-1" href="gara.php" class="unstamp"><button type="button" class="btn btn-link unstamp" tooltip="Clicca per andare alla pagina di modifica evento"  tooltip-trigger="mouseenter" tooltip-placement="right">{{translation.MODIFY_EVENT}}</button></a></td></tr>
							<tr><td colspan="2"><a tabindex="-1" href="stampa_iscritti.php?evento={{selezionaEvento.nome}}" class="unstamp" target="_blank"><button type="button" class="btn btn-link unstamp" ng-if="selezionaEvento"  >Stampa lista iscritti evento</button></a></td></tr>
						</table>
					</form>
				</td>
				<td>
				<form name="iscrizione">
				<tabset justified="true" >
			    	<tab heading="{{translation.USER_DATA}}" select="reset()">

			    		<table class="table">
							<tr><!-- <td>{{translation.NAME}}</td> --><td><input id="nominativoGara" tabindex="1" type="text" ng-model="iscritto.nome" placeholder="{{translation.NAME}}" typeahead="nome for nome in getIscritti($viewValue) | filter:$viewValue | limitTo:4" ng-blur="checkIscritto(iscritto.nome)" />
								<p class="error unstamp" ng-show="errore1">{{errore1}}</p></td></tr>
							<tr><!-- <td>{{translation.CATEGORY}}</td> --><td><input tabindex="2" type="text" ng-model="iscritto.categoria" placeholder="{{translation.CATEGORY}}" typeahead="categoria for categoria in getCategoria($viewValue) | filter:$viewValue | limitTo:4"/></td></tr>
							<tr><!-- <td>{{translation.VEHICLE}}</td> --><td><input tabindex="4" type="text" placeholder="{{translation.VEHICLE}}" ng-model="iscritto.moto" /></td></tr>
							<tr><!-- <td>{{translation.MOTOCLUB}}</td> --><td><input tabindex="5"type="text" placeholder="{{translation.MOTOCLUB}}" ng-model="iscritto.motoclub" /></td></tr>
							<tr><!-- <td>{{translation.MISC}}</td> --><td><input tabindex="6"type="text" placeholder="{{translation.MISC}}" ng-model="iscritto.varie" /></td></tr>
							<tr><td colspan="2"><button tabindex="7" type="submit" class="btn btn-success unstamp" ng-if="selezionaEvento" ng-click="iscrivi(iscritto)" >Iscrivi a {{selezionaEvento.nome}}</button>
									<button class="btn btn-danger unstamp" ng-if="!selezionaEvento"  disabled >Seleziona evento</button>
									<input type="reset" value="Pulisci form" class="unstamp" ng-click="reset()"/>
							</td></tr>
						</table>
			    	</tab>
				    <tab heading="{{translation.TEAM_DATA}}" select="reset()">

				    	<table class="table">
							<tr><td>Primo iscritto</td><td><input type="text" ng-model="iscritto.nome1" placeholder="Nome e cognome" typeahead="nome for nome in getIscritti($viewValue) | filter:$viewValue | limitTo:4" ng-blur="checkIscritto(iscritto.nome1)"/>
								<p class="error unstamp" ng-show="errore1">{{errore1}}</p></td></tr>
							<tr><td>Secondo iscritto</td><td><input type="text" ng-model="iscritto.nome2" placeholder="Nome e cognome" typeahead="nome for nome in getIscritti($viewValue) | filter:$viewValue | limitTo:4"  /></td></tr>
							<tr><td>Terzo iscritto</td><td><input type="text" ng-model="iscritto.nome3" placeholder="Nome e cognome" typeahead="nome for nome in getIscritti($viewValue) | filter:$viewValue | limitTo:4" /></td></tr>
							<tr><td>{{translation.CATEGORY}}</td><td><input type="text" placeholder="Categoria" ng-model="iscritto.categoria" /></td></tr>
							<tr><td>{{translation.VEHICLE}}</td><td><input type="text" placeholder="Moto" ng-model="iscritto.moto" /></td></tr>
							<tr><td>{{translation.MOTOCLUB}}</td><td><input type="text" placeholder="Moto club" ng-model="iscritto.motoclub" /></td></tr>
							<tr><td>{{translation.MISC}}</td><td><input type="text" placeholder="Varie" ng-model="iscritto.varie" /></td></tr>
							<tr><td colspan="2"><input type="submit" class="btn btn-success unstamp" ng-if="selezionaEvento" ng-click="iscrivi(iscritto)" value="Iscrivi a {{selezionaEvento.nome}}" />
									<button class="btn btn-danger unstamp" ng-if="!selezionaEvento"  disabled >{{translation.SELECT_EVENT}}</button>
									<input type="reset" value="{{translation.CLEAR_FORM}}" class="unstamp" ng-click="reset(1)"/>
							</td></tr>
						</table>
				    </tab>
			  	</tabset>

				</td>
				<td>
		        <table>
		        	<tr><th style="font-size:20px;"> {{translation.NUMBER}}</th></tr>
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


</div>
</div>
</body>
</html>