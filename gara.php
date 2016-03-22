<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="Content-type" content="text/html; charset=UTF-8"/>
		<title>Pannello di controllo</title>
		<link rel="stylesheet" type="text/css" href="css/stile.css" />
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
		<script src="js/vendor.min.js"></script>
		<script type="text/javascript" src="js/app.js"></script>
		<script type="text/javascript" src="js/services/eventiService.js"></script>
		<script type="text/javascript" src="js/services/testiService.js"></script>
		<script type="text/javascript" src="js/services/translationService.js"></script>
		<script type="text/javascript" src="js/GestioneEventoController.js"></script>
		<script type="text/javascript" src="js/CreaEventoController.js"></script>
		<script type="text/javascript" src="js/GestioneTestoController.js"></script>
		<script type="text/javascript" src="js/translationController.js"></script>
		<!-- <script type="text/javascript" src="script.js"></script> -->
		<!-- <script src="ajax/prototype.js" type="text/javascript"></script> -->
		<!-- <script src="ajax/effects.js" type="text/javascript"></script> -->
		<!-- <script src="ajax/controls.js" type="text/javascript"></script> -->
	</head>
	<body ng-app="lendinara">
	<div class="col-md-12 languageNavbar" ng-controller="translationController">
	    <span class="language" ng-click="changeLanguage('en')">
	        ENGLISH
	    </span>
	    <span class="language" ng-click="changeLanguage('it')">
	        ITALIAN
	    </span>
	    <a href="modulo.php"><input type="button" value="Vai a Modulo" class="btn btn-default unstamp" /></a>
		<a href="riassuntoeventi.php"><input tabindex="-1" type="button" value="Riassunto Eventi" class="btn btn-default unstamp" /></a>
		<a href="riassuntoiscritti.php?on=1"><input tabindex="-1" type="button" value="Elenco tesserati" class="btn btn-default unstamp" /></a>
	</div>
		
		<div align="center">
			<div id="corpo">
				<h1>Pannello di controllo</h1>
				<div id="left" ng-controller="GestioneEventoCtrl">
					<form name="evento">
						<fieldset>
							<legend>Gestione evento</legend>
							<table><tr><td>Nome</td><td>
							
							<select ng-model="selezionaEvento" ng-options="evento.nome for evento in eventi" ng-change="selezionato()">
								<option value="">Seleziona Evento</option>
							</select>
						</td></tr>
						<td>Luogo</td><td><input type="text" placeholder="Luogo evento" ng-model="datievento.luogo" required /></td></tr>
						<td>Data</td><td><input type="date" ng-model="datievento.data" required/></td></tr>
						<td>Costo</td><td><input type="number" placeholder="Costo evento" ng-model="datievento.costo" required></td></tr>
						<td>Altro</td><td><input type="text" placeholder="Altro" ng-model="datievento.altro" /></td></tr>
					</table>
					<input type="submit" value="Modifica" class="btn btn-success" ng-click="modifica(datievento)" ng-show="selezionaEvento" />
					<input type="button" class="btn btn-danger" value="Elimina evento" ng-show="selezionaEvento" ng-click="elimina()" />
				</fieldset>
			</form>
			<div ng-if="risultato==true" class="alert alert-success alert-dismissable">{{messaggio}}</div>
			<div ng-if="risultato==false" class="alert alert-danger alert-dismissable">{{messaggio}}</div>
		</div>
		<div id="right" ng-controller="CreaEventoCtrl">
			<form name="creaevento">
				<fieldset>
					<legend>Crea evento</legend>
					<table><tr>
						<td>Nome</td> <td><input type="text" ng-model="evento.nome" name="nomeevento" required/></td></tr>
						<tr><td>Data</td> <td><input type="date" ng-model="evento.data" name="dataevento" required /></td></tr>
						<tr><td>Luogo</td> <td><input placeholder="Luogo evento" type="text" ng-model="evento.luogo" name="luogoevento" /></td></tr>
						<tr><td>Costo</td> <td><input placeholder="Costo evento" type="number" ng-model="evento.costo" name="costoevento" /></td></tr>
						<tr><td>Altro</td> <td><input placeholder="Altro" type="text" ng-model="evento.altro" name="altro" /></td></tr>
					</table>
					<input type="submit" value="Crea evento" class="btn btn-success" ng-click="crea(evento)" ng-show="evento.nome" />
					<input type="reset" class="btn" />
				</fieldset>
			</form>
			<div ng-if="risultato==true" class="alert alert-success">{{messaggio}}</div>
			<div ng-if="risultato==false" class="alert alert-danger">{{messaggio}}</div>
		</div>
		<div id="riassunti">
			<fieldset>
				<legend>Riassunti</legend>
				<!-- <input type="button" value="Riassunto eventi" onclick="goto2();" class="btn btn-default" /> -->
				<input type="button" value="Elenco tesserati" onclick="goto3();" class="btn btn-default" />
			</fieldset>
		</div>
		<div id="gestioneTesto" ng-controller="GestioneTestoCtrl">
			<fieldset>
				<legend>Layout di stampa</legend>
				<a href="layoutTesseramento.php"><button class="btn btn-default">Tesseramento</button></a>
				<a href="layoutGara.php"><button class="btn btn-default">Iscrizione gara</button></a>
				<!-- <table class="table">
					<tr><th><button class="btn" ng-click="cambia('precedente')">Indietro</button></th><th><button class="btn" ng-click="cambia('successivo')">Avanti</button></th></tr>
					<tr><th>Testo</th><th>Stampa quando</th></tr>
					<tr><td><textarea  style="width: 500px"; rows="10" placeholder="Inserisci testo" ng-model="testo"></textarea> </td>
					<td>
						<div class="radio" >
							<label>
								<input type="radio" name="posizione" ng-model="posizione" value="tesseramento" /> Tesseramento
							</label>
							<label>
								<input type="radio" name="posizione" ng-model="posizione" value="gara" /> Iscrizione a gara
							</label>
						</div>
						<input type="submit" value="Salva" ng-click="modifica(testo, posizione, 'salva')" class="btn btn-success" ng-show="nuovo" />
						<input type="submit" value="Modifica" ng-click="modifica(testo, posizione, 'modifica')" class="btn btn-warning" ng-show="!nuovo" />
						<input type="submit" value="Elimina" ng-click="modifica(testo, posizione, 'elimina')" class="btn btn-danger" />
						<button class="btn" ng-click="reset()">Pulisci form</button>
						<div ng-if="risultato==true" class="alert alert-success alert-dismissable">{{messaggio}}</div>
						<div ng-if="risultato==false" class="alert alert-danger alert-dismissable">{{messaggio}}</div>
					</td></tr>
				</table> -->
			</fieldset>
			<fieldset>
				<legend>Contenuto biglietti strattabili</legend>
				<table class="table">
					<tr>
						<th>Biglietto sinistra</th><th>Biglietto destra</th></tr>
						<tr><td><textarea  style="width: 250px"; rows="10" placeholder="Inserisci testo" ng-model="bigliettosx"></textarea> </td>
						<td><textarea  style="width: 250px"; rows="10" placeholder="Inserisci testo" ng-model="bigliettodx"></textarea></td>
						<td><button ng-click="modificaBiglietti(bigliettosx,bigliettodx);" class="btn btn-success">Modifica</button>
							<div ng-if="risultatoBiglietti==true" class="alert alert-success alert-dismissable">{{messaggio}}</div>
							<div ng-if="risultatoBiglietti==false" class="alert alert-danger alert-dismissable">{{messaggio}}</div></td>
						</tr>
					</table>
				</fieldset>
				<fieldset>
				<legend>Elenco campi iscrizione</legend>
					<div class="row text-left">
						<div class="span3">
							<input type="checkbox" ng-model="options.codicefiscale" ng-change="changeOptions()" /> Codice fiscale
						</div>
						<div class="span3">
							<input type="checkbox" ng-model="options.certificato" ng-change="changeOptions()" /> Certificato medico
						</div>
						<div class="span3">
							<input type="checkbox" ng-model="options.acconto" ng-change="changeOptions()" /> Acconto
						</div>
						<div class="span3">
							<input type="checkbox" ng-model="options.cauzione" ng-change="changeOptions()" /> Cauzione
						</div>
						<div class="span3">
							<input type="checkbox" ng-model="options.assicurazione" ng-change="changeOptions()" /> Assicurazione
						</div>
					</div>
					<div ng-if="optionsMessage==true" class="alert alert-success alert-dismissable">Opzioni salvate</div>
				</fieldset>
				<br /><br /><br /><br /><br />
			</div>
		</div>
	</div>
</body>
</html>