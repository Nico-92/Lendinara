moduloServices.factory('eventiService', ['$http',
	function($http) {
		return {
			post: function(evento) {
				return $http({
					url: 'crea_evento.php',
					method: 'GET',
					params: {
						evento: evento
					}
				});
			},
			get: function(evento) {
				return $http({
					url: 'ricerca_eventi.php',
					method: 'GET',
					params: {
						evento: evento
					}
				});
			},
			getNumeri: function(evento) {
				return $http({
					url: 'ricerca_numeri.php',
					method: 'GET',
					params: {
						evento: evento
					}
				});
			},
			getCategorie: function(evento, categoria) {
				return $http({
					url: 'ricerca_classi.php',
					method: 'GET',
					params: {
						evento: evento,
						categoria: categoria
					}
				});
			}
		};
	}
]);