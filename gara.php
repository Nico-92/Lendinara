<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pannello di controllo</title>

<link rel="stylesheet" type="text/css" href="stile.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />


 <!-- bower:js -->
    <script src="js/jquery.js"></script>
    <script src="js/angular/angular.js"></script>
    <script src="js/angular/angular-resource.js"></script>
    <script src="js/angular/angular-cookies.js"></script>
    <script src="js/angular/angular-sanitize.js"></script>
    <script src="js/angular/angular-route.js"></script>
<!-- endbower -->


<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/gara.js"></script>
<script type="text/javascript" src="script.js"></script>
<script src="ajax/prototype.js" type="text/javascript"></script>
<script src="ajax/effects.js" type="text/javascript"></script>
<script src="ajax/controls.js" type="text/javascript"></script>
</head>
<body ng-app="lendinara">
<input type="button" class="btn btn-primary" value="Vai a Modulo" onclick="goto();"/>
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
			<legend>Testo da stampare</legend>

			<table class="table">
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
  					<input type="submit" value="Modifica" ng-click="modifica(testo, posizione)" class="btn btn-success" />
  					<input type="submit" value="Elimina" ng-click="elimina(testo, posizione)" class="btn btn-danger" />
  					<button class="btn" ng-click="reset()">Pulisci form</button>
  					<div ng-if="risultato==true" class="alert alert-success alert-dismissable">{{messaggio}}</div>
					<div ng-if="risultato==false" class="alert alert-danger alert-dismissable">{{messaggio}}</div>
				</td></tr>
			</table>
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
	</div>
</div>
</div>
</body>
</html>