<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Riassunto iscritti</title>
	<script src="js/vendor.min.js"></script>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="css/stile.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<script src="bootstrap/js/bootstrap-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="css/ng-grid.min.css" />

	<script type="text/javascript" src="js/app.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/services/iscrittiService.js"></script>
	<script type="text/javascript" src="js/services/gareService.js"></script>
	<script type="text/javascript" src="js/riassuntoController.js"></script>

	<style type="text/css">
		@import url("css/stilistampa.css") print;
	</style>
</head>

<body ng-app="lendinara">
	<a href="modulo.php"><input type="button" value="Vai a Modulo" class="btn btn-primary unstamp" /></a>
	<table cellpadding="5" cellspacing="5">
		<tr>
			<td><img src="images/csen.png" />
			</td>
			<td>CENTRO SPORTIVO EDUCATIVO NAZIONALE
				<br /> ENTE DI PROMOZIONE SPORTIVA RICONOSCIUTO DAL C.O.N.I. (Art. 31 D.P.R. 2-8-1974 n. 530)
				<br /> ENTE NAZIONALE CON FINALITA’ ASSISTENZIALI RICONOSCIUTO DAL
				<br /> MINISTERO DELL’INTERNO (D.M. 559/C. 3206.12000.A. [101] DEL 29 FEBBRAIO 92)</td>
		</tr>
	</table>
	<div ng-controller="RiassuntoIscrittiCtrl" style="height:100%">
		<br />
		<div class = "filtri unstamp">
			<h1><small>Filtri</small></h1>
			<table>
				<tr><td>Da</td><td><input type="date" class="input-medium" ng-model="filtro.inizio" ng-blur="filtraDate()" ng-click="tesserati()" /></td></tr>
				<tr><td>A</td><td><input type="date" class="input-medium" ng-model="filtro.fine" ng-blur="filtraDate()" ng-click="tesserati()" /></td></tr>
			</table>
			 Visualizza solo tesserati <input type="checkbox" ng-model="filtro.tesserati" ng-change="filtra()">
			 <br /><br />
			 <button class="btn btn-default" ng-click="esporta();">ESPORTA IN EXCEL</button>
		</div>
		Totale tesserati: {{iscritti.length}}
		<div class="tabella" ng-grid="gridOptions">
		</div>
	</div>
</body>

</html>