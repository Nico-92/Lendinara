 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Riassunto iscritti evento</title>
<link rel="stylesheet" type="text/css" href="css/stile.css" />


<script src="js/vendor.min.js"></script>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<script src="bootstrap/js/bootstrap-ui.js"></script>


<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/app.js"></script>
<script type="text/javascript" src="js/services/gareService.js"></script>
<script type="text/javascript" src="js/scannerDetector.js"></script>
<script type="text/javascript" src="js/stampa.js"></script>
<script src="ajax/prototype.js" type="text/javascript"></script>
<script src="ajax/effects.js" type="text/javascript"></script>
<script src="ajax/controls.js" type="text/javascript"></script>
<style type="text/css"> @import url("css/stilistampa.css") print;</style>

</head>
<body ng-app="lendinara" >
  <input type="button" class="btn btn-primary unstamp" value="Vai a Modulo" onclick="goto();"/>
	<div ng-controller="stampaIscritti">
	    <div class="page-header" align="center">
	      	<h1><small>Elenco iscritti {{evento}}</small></h1>
	      	<h4><small>Totale: {{numero_iscritti}}</small></h4>
	    </div>

    	 <button class="btn unstamp" ng-click="modifica();">{{condizione_modifica}}</button>
		<button class="btn unstamp" ng-click="esporta();">Formato {{formato}}</button>
		<button class="btn unstamp" ng-click="stampa();">Stampa</button><br /><br />
		<span ng-repeat="iscritto in iscritti track by $index" ng-if="formato=='lettura'">
				{{iscritto.numero}},{{iscritto.nome}},{{iscritto.categoria}},{{iscritto.moto}},{{iscritto.motoclub}},{{iscritto.varie}}<br />
		</span>
		
		<table class="table" ng-if="formato=='csv'">
			<tr>
				<th></th>
		        <th ng-repeat="property in properties">
		          <span class="glyphicon glyphicon-backward pointer unstamp" ng-click="moveColumn('sx',$index)"></span> 
		          <a href="" ng-click="ordina_colonne(property)">{{property | uppercase }}</a> 
		          <span class="glyphicon glyphicon-forward pointer unstamp" ng-click="moveColumn('dx',$index)"></span> 
		          <span class="glyphicon glyphicon-remove-sign pointer unstamp" ng-click="deleteColumn($index)"></span>
		        </th>
	      	</tr>
			<tr ng-repeat="iscritto in iscritti | orderBy:predicato:reverse track by $index">
				<td><span class="glyphicon glyphicon-remove" ng-click="elimina(iscritto)"></span></td>
				<td ng-repeat="property in properties">
					<span ng-if="modifica_attiva==false">{{iscritto[property]}}</span>
					<span ng-if="modifica_attiva==true"><input class="input-small" type="text" ng-model="iscritto[property]" /></span>
				</td>
			</tr>
		</table>
	</div>
</body>
</html>