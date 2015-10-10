"use strict"

angular.module('moduloServices', ['ngResource']);
angular.module('moduloControllers', ['ngResource', 'ui.bootstrap', 'moduloServices']);
angular.module('riassuntoControllers', ['ngResource', 'ui.bootstrap', 'ngGrid', 'moduloServices']);
var lendinara = angular.module('lendinara', ['moduloControllers']);
angular.module('tesserati', ['riassuntoControllers']);

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