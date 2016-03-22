<!DOCTYPE html>
<html>
<head>
	<title>Layout tesseramento</title>
	<link rel="stylesheet" type="text/css" href="css/stile.css">
	<link rel="stylesheet" type="text/css" href="css/vendor/bootstrap3.min.css">
	<style type="text/css"> @import url("css/stilistampa.css") print;</style>
	<script src="js/vendor.min.js"></script>
	<script type="text/javascript" src="js/app.js"></script>
	<script type="text/javascript" src="js/services/translationService.js"></script>
	<script type="text/javascript" src="js/services/testiService.js"></script>
	<script type="text/javascript" src="js/translationController.js"></script>
	<script type="text/javascript" src="js/layoutStampaController.js"></script>

</head>
<body ng-app="lendinara">
	<div class="col-md-12 languageNavbar unstamp" ng-controller="translationController">
	    <span class="language" ng-click="changeLanguage('en')">
	        ENGLISH
	    </span>
	    <span class="language" ng-click="changeLanguage('it')">
	        ITALIAN
	    </span>
	    <a href="modulo.php"><input type="button" value="Vai a Modulo" class="btn btn-default unstamp" /></a>
		<a href="gara.php"><input tabindex="-1" type="button" value="Pannello di controllo" class="btn btn-default unstamp" /></a>
		<a href="riassuntoiscritti.php?on=1"><input tabindex="-1" type="button" value="Elenco tesserati" class="btn btn-default unstamp" /></a>
	</div>
	<div ng-controller="layoutStampaController">
		<div  class="layoutStampa">
			<div class="blocco blocco-uno" ng-style="styleblocco1">
				<textarea class="form-control" ng-model="blocco1.testo"></textarea>
			</div>
			<div class="blocco blocco-dati text-center">
				Qui verranno visualizzati i dati del tesserato
			</div>
			<div class="blocco blocco-due" ng-style="styleblocco2">
				<textarea  class="form-control" ng-model="blocco2.testo"></textarea>
			</div>
		</div>
		<div class="control-panel unstamp">
			<h1><small>Layout di stampa tesseramento</small></h1>
			<p>A sinistra puoi vedere come sarà la stampa lanciata quando viene tesserato o modificato un iscritto.
			L'area grigia conterrà i dati dell'iscritto è non è modificabile.
			<p>Puoi modificare il testo che apparirà sopra e sotto i dati dell'iscritto incollandolo nel rispettivo blocco e cliccando Salva al termine.</p>
			</p>
			<p>Se il testo viene tagliato, o resta troppo spazio bianco puoi modifcare l'altezza dei due blocchi cambiando i valori qui sotto.</p>
			<p>Per un video tutorial <a href="">clicca qui</a></p>
			<p>Altezza blocco 1 in cm: <input type="text" ng-model="blocco1.altezza" class="form-control input-small" /> <button class="btn btn-default" ng-click="styleblocco1={'height':blocco1.altezza + 'cm'}"> Modifica</button></p>
			<p>Altezza blocco 2 in cm: 
			<input type="text" ng-model="blocco2.altezza" class="form-control input-small" /> <button class="btn btn-default" ng-click="styleblocco2={'height':blocco2.altezza + 'cm'}"> Modifica</button></p>	
			<p><button class="btn btn-default" ng-click="modifica()">Salva</button></p>
			<div ng-if="messaggio==true" class="alert alert-success alert-dismissable unstamp">Testi salvati</div>
			<div ng-if="errore==true" class="alert alert-danger alert-dismissable unstamp">Qualcosa non ha funzionato. Riprova</div>
		</div>
	</div>
</body>
</html>