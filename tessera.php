<!DOCTYPE html>
<html>
	<head>
		<title>Tessera</title>
		<script src="js/vendor.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/index.css" />
		<style type="text/css"> @import url("css/stilistampa.css") print;</style>
		<script type="text/javascript" src="js/app.js"></script>
		<script type="text/javascript" src="js/services/iscrittiService.js"></script>
		<script type="text/javascript" src="js/tesseraController.js"></script>
	</head>
	<body ng-app="tessera">
		<div ng-controller="tesseraController">
			<div class="panel panel-default unstamp">
				<div class="panel-heading">Menu</div>
				<div class="panel-body">
					<div class="col-md-2"><a href="JavaScript:window.close()" class="btn btn-primary">Torna a Modulo</a></div>
					<div class="col-md-3">
						<p>Numero etichette: </p><input type="text" ng-model="etichette.numeroEtichette" ng-change="setNumeroEtichette()" /></div>
						<div class="col-md-3">
							<p>Stampa nella n°: </p><input type="text" ng-model="etichette.stampaIn" ng-change="setStampaInCookie()"/></div>
							<div class="col-md-2"><a href="javascript:window.print()" class="btn btn-info" ng-click="setStampaInCookie()"66666666666>STAMPA</a></div>
							<div class="col-md-2"><button class="btn btn-link" ng-click="avanzate = !avanzate">Avanzate</button></div>
							<div class="col-md-12" ng-show="avanzate">
								<div class="row">
									<hr />
									<div class="col-md-3">
										<p>Margine superiore</p>
										<input type="text" ng-model="margine.superiore" ng-change="updateMargin()">
									</div>
									<div class="col-md-3">
										<p>Margine sinistro</p>
										<input type="text" ng-model="margine.sinistro" ng-change="updateMargin()">
									</div>
									<div class="col-md-3">
										<p>Data rilascio tessera</p>
										<input type="date" class="input-medium" ng-model="datarilascio" ng-blur="changeDate()" />
									</div>
								</div>
							</div>
							
						</div>
					</div>
					<!-- <div class="row riga-tessere" ng-style="{'margin-top': margine.superiore + 'cm', left: margine.sinistro + 'cm'}"> -->
						
						
						<!-- <div class="col-xs-3 tessera" ng-repeat="i in arrayEtichette track by $index"> -->
							<!-- <div ng-show="$index +1 == etichette.stampaIn"> -->
							<img id="barcode" style="visibility: hidden;">
							<div id="tessera">
								<!-- <div barcode-generator="{{iscritto.barcode}}" style="height:20px;" ng-show="iscritto.barcode"></div> -->
								<!-- <div ng-shoW="!iscritto.barcode"><button class="btn btn-default" ng-click="setBarcode()">Genera codice</button></div> -->
								<p>{{iscritto.nome | uppercase}}</p>
								<p>Data di nascita: {{iscritto.dataNascita}}</p>
								<p>Data di rilascio: {{iscritto.dataRilascio}}</p>
								<p>Qual.: socio - Sport: Moto</p>
								<p>Comitato provinciale: PD</p>
							</div>
							<!-- </div> -->
						<!-- </div> -->
					<!-- </div> -->
				</div>
			</body>
		</html>