tessera.config(['$locationProvider', function($locationProvider) {
	$locationProvider.html5Mode(true);
}])

tessera.controller('tesseraController', ['$scope', '$location', 'iscrittiService', 'ipCookie', function($scope, $location, iscrittiService, ipCookie) {
	var paramValue = $location.search();
	iscrittiService.get(paramValue.nome).success(function(data) {
		$scope.iscritto = {
			dataNascita: moment(data.datanascita, 'YYYY-MM-DD').format('DD / MM / YYYY'),
			dataRilascio: moment().format("DD / MM / YYYY"),
			nome: data.nome,
			barcode: data.barcode,
			id: data.id
		}
	});
	$scope.etichette = {
		numeroEtichette: 24,
		stampaIn: 1
	};
	if(ipCookie('stampaIn')){
		$scope.etichette.stampaIn = ipCookie('stampaIn');
	}
	$scope.arrayEtichette = new Array($scope.etichette.numeroEtichette);

	$scope.setNumeroEtichette = function() {
		if ($scope.etichette.numeroEtichette !== "") {
			$scope.arrayEtichette = Array(parseInt($scope.etichette.numeroEtichette));
		}
	};

	$scope.setBarcode = function() {
		var text = "";
		var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
		for (var i = 0; i < 4; i++){
			text += possible.charAt(Math.floor(Math.random() * possible.length));
		}
		iscrittiService.updateField('iscritti', 'barcode', text, 'id', $scope.iscritto.id).success(function(data) {
			if(data === '1'){
				$scope.iscritto.barcode = text;
			}
		});
	};

	$scope.setStampaInCookie = function(){
		ipCookie.remove('stampaIn');
		ipCookie('stampaIn', parseInt($scope.etichette.stampaIn) + 1);
	}
}]);