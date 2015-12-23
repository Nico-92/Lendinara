var moduloServices = angular.module('moduloServices', []);
var lendinara = angular.module('lendinara', ['ngResource', 'ui.bootstrap', 'ngGrid', 'moduloServices'], function($locationProvider) {
    $locationProvider.html5Mode(true);
});
var tessera = angular.module('tessera', ['barcodeGenerator', 'moduloServices', 'ipCookie']);

lendinara.filter('startsWith', function() {
	return function(array, search) {
		var matches = [];
		for (var i = 0; i < array.length; i++) {
			if (array[i].comune.toLowerCase().indexOf(search) === 0) {
				matches.push(array[i]);
			}
		}
		return matches;
	};
});