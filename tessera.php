<!DOCTYPE html>
<html>
<head>
	<title>Tessera</title>
	 <!-- bower:js -->
    <script src="js/jquery.js"></script>
    <script src="js/angular/angular.js"></script>
    <script type="text/javascript" src="js/moment.js"></script>
    <!-- endbower -->

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap3.min.css" />
    <link rel="stylesheet" type="text/css" href="css/stile.css" />

    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/tesseraController.js"></script>
</head>
<body ng-app="tessera">
	<div ng-controller="tesseraController">
		<div class="row">
			<div class="col-xs-3 tessera">
				<p class="nome">NOMINATIVO</p>
				<p>{{nome}}</p>
				<p>DATA DI NASCITA: {{dataNascita}}</p>
				<p>DATA DI RILASCIO: {{dataRilascio}}</p>
				<p>QUALIFICA: Socio</p>
				<p>COMITATO PROVINCIALE: Padova</p>
			</div>
			<div class="col-xs-3 tessera">
				<p class="nome">NOMINATIVO</p>
				<p>{{nome}}</p>
				<p>DATA DI NASCITA: {{dataNascita}}</p>
				<p>DATA DI RILASCIO: {{dataRilascio}}</p>
				<p>QUALIFICA: Socio</p>
				<p>COMITATO PROVINCIALE: Padova</p>
			</div>
			<div class="col-xs-3 tessera">
				<p class="nome">NOMINATIVO</p>
				<p>{{nome}}</p>
				<p>DATA DI NASCITA: {{dataNascita}}</p>
				<p>DATA DI RILASCIO: {{dataRilascio}}</p>
				<p>QUALIFICA: Socio</p>
				<p>COMITATO PROVINCIALE: Padova</p>
			</div>
			<div class="col-xs-3 tessera">
				<p class="nome">NOMINATIVO</p>
				<p>{{nome}}</p>
				<p>DATA DI NASCITA: {{dataNascita}}</p>
				<p>DATA DI RILASCIO: {{dataRilascio}}</p>
				<p>QUALIFICA: Socio</p>
				<p>COMITATO PROVINCIALE: Padova</p>
			</div>
			</div>
		</div>
	</div>
</body>
</html>