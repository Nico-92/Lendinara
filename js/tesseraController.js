var tessera = angular.module('tessera', []);

tessera.config(['$locationProvider', function($locationProvider) {
        $locationProvider.html5Mode(true);
    }])

tessera.controller('tesseraController', ['$scope', '$location', function($scope, $location) {
	var paramValue = $location.search();
	$scope.nome = paramValue.nome.toLowerCase();
	$scope.nome = $scope.nome.replace(/(?:^|\s)\S/g, function(a) { return a.toUpperCase(); });
	$scope.dataNascita = moment(paramValue.nascita, 'YYYY-MM-DD').format('DD / MM / YYYY');
	$scope.dataRilascio = moment().format("DD / MM / YYYY");
}]);