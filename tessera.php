<!DOCTYPE html>
<html>
	<head>
		<title>Tessera</title>
		<script src="js/vendor.min.js"></script>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap3.min.css" />
		<link rel="stylesheet" type="text/css" href="css/stile.css" />
		<link rel="stylesheet" href="css/barcode.css" type="text/css"/>
		<style type="text/css"> @import url("css/stilistampa.css") print;</style>
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/app.js"></script>
		<script type="text/javascript" src="js/services/iscrittiService.js"></script>
		<script type="text/javascript" src="js/tesseraController.js"></script>
	</head>
	<body ng-app="tessera">
		<div ng-controller="tesseraController">
			<div class="panel panel-default unstamp">
				<div class="panel-heading">Menu</div>
				<div class="panel-body">
					<div class="col-md-2"><a href="modulo.php" class="btn btn-primary">Torna a Modulo</a></div>
					<div class="col-md-4">Numero etichette: <input type="text" ng-model="etichette.numeroEtichette" ng-change="setNumeroEtichette()" /></div>
					<div class="col-md-4">Stampa nella n°: <input type="text" ng-model="etichette.stampaIn" ng-change="setStampaInCookie()"/></div>
					<div class="col-md-2"><a href="javascript:window.print()" class="btn btn-info">STAMPA</a></div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-3 tessera" ng-repeat="i in arrayEtichette track by $index">
					<div ng-show="$index +1 == etichette.stampaIn">
						<div barcode-generator="{{iscritto.barcode}}" style="height:20px;" ng-show="iscritto.barcode"></div>
						<div ng-shoW="!iscritto.barcode"><button class="btn btn-default" ng-click="setBarcode()">Genera codice</button></div>
						<br />
						<p class="nome">Nome: {{iscritto.nome | uppercase}}</p>
						<p>Data di nascita: {{iscritto.dataNascita}}</p>
						<p>Data di rilascio: {{iscritto.dataRilascio}}</p>
						<p>Qualifica: SOCIO</p>
						<p>Comitato provinciale: PD</p>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>