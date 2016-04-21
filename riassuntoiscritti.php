<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Riassunto iscritti</title>
	<script src="js/vendor.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/index.css" />
	<!-- <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" /> -->
	<!-- <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap3.min.css" /> -->
	<!-- <link rel="stylesheet" type="text/css" href="css/stile.css" /> -->
	<!-- <script src="bootstrap/js/bootstrap-ui.js"></script> -->
	<!-- <link rel="stylesheet" type="text/css" href="css/ng-grid.min.css" /> -->

	<script type="text/javascript" src="js/app.js"></script>
	<script type="text/javascript" src="js/services/iscrittiService.js"></script>
	<script type="text/javascript" src="js/services/tessereService.js"></script>
	<script type="text/javascript" src="js/services/translationService.js"></script>
	<script type="text/javascript" src="js/riassuntoController.js"></script>
	<script type="text/javascript" src="js/translationController.js"></script>
	<script type='text/javascript' src='bower_components/d3/d3.min.js'></script> 
	<script type='text/javascript' src='bower_components/angular-charts/dist/angular-charts.min.js'></script>


	<style type="text/css">
		@import url("css/stilistampa.css") print;
	</style>
</head>

<body ng-app="lendinara">

	<div class="col-md-12 languageNavbar" ng-controller="translationController">
	    <span class="language" ng-click="changeLanguage('en')">
	        ENGLISH
	    </span>
	    <span class="language" ng-click="changeLanguage('it')">
	        ITALIAN
	    </span>
		<a href="modulo.php"><input tabindex="-1" type="button" value="Modulo" class="btn btn-default unstamp" /></a>
	    <a href="gara.php"><input tabindex="-1" type="button" value="Pannello di controllo" class="btn btn-default unstamp" /></a>
	    	<a href="tutorial.php"><input tabindex="-1" type="button" value="Guida" class="btn btn-default unstamp" /></a>

		<!-- <a href="riassuntoeventi.php"><input tabindex="-1" type="button" value="Riassunto Eventi" class="btn btn-default unstamp" /></a> -->
	</div>
	<!-- <table cellpadding="5" cellspacing="5">
		<tr>
			<td><img src="images/csen.png" />
			</td>
			<td>CENTRO SPORTIVO EDUCATIVO NAZIONALE
				<br /> ENTE DI PROMOZIONE SPORTIVA RICONOSCIUTO DAL C.O.N.I. (Art. 31 D.P.R. 2-8-1974 n. 530)
				<br /> ENTE NAZIONALE CON FINALITA’ ASSISTENZIALI RICONOSCIUTO DAL
				<br /> MINISTERO DELL’INTERNO (D.M. 559/C. 3206.12000.A. [101] DEL 29 FEBBRAIO 92)</td>
		</tr>
	</table> -->
	<div ng-controller="RiassuntoIscrittiCtrl" style="height:100%">
		<div class="row text-center">
			<h1>Riassunto tesserati</h1>
		</div>
		<br />
		<div class="row">
			<div class="col-md-3 filtri-riassunto">
				<div class="row">
					<div class="col-md-12">
						<h1><small>Filtri</small></h1>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-6">
						<button class="btn btn-default" ng-click="resetFiltri()">AZZERA FILTRI</button>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-6">
					<div class="row">
						<div class="col-md-2">Da</div>
						<div class="col-md-10"><input type="date" class="input-medium" ng-model="filtro.inizio" ng-blur="filtraDate()" ng-click="tesserati()" /></div>
					</div>
					<div class="row">
						<div class="col-md-2">A</div>
						<div class="col-md-10"><input type="date" class="input-medium" ng-model="filtro.fine" ng-blur="filtraDate()" ng-click="tesserati()" /></div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<br />
							<button class="btn btn-default" ng-click="tesseratiOggi();">TESSERATI OGGI</button> 
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
						<input type="checkbox" checked="checked" ng-model="filtro.tipoTessere.nonTesserati" ng-change="cambiaTipoTessere()"/> Altre tessere
						<br />
						<input type="checkbox" checked="checked" ng-model="filtro.tipoTessere.lendinara" ng-change="cambiaTipoTessere()"/> Lendinara
						<br />
						<input type="checkbox" ng-model="filtro.tipoTessere.csen"  ng-change="cambiaTipoTessere()"/> CSEN
						</div>
					</div>
					 <hr />
					 <button class="btn btn-default" ng-click="esporta();">ESPORTA IN EXCEL</button>
					</div>
				</div>				
			</div>
			<div class="col-md-9">
				<div class="row">
					Totale tesserati: {{iscritti.length}}
				</div>
				<div class="row">
					<div class="tabella" ng-grid="gridOptions"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div ac-chart="bar" ac-data="iscritti" ac-config="config" id='chart' class='chart'></div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>