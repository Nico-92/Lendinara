moduloServices.factory('eventiService', ['$http',
	function($http) {
		return {
			post: function(evento) {
				return $http({
					url: 'backend/eventi/crea_evento.php',
					method: 'GET',
					params: {
						evento: evento
					}
				});
			},
			put: function(evento) {
				return $http({
					url: 'backend/eventi/modifica_evento.php',
					method: 'GET',
					params: {
						evento: evento
					}
				});
			},
			delete: function(evento) {
				return $http({
					url: 'backend/eventi/elimina_evento.php',
					method: 'GET',
					params: {
						evento: evento
					}
				});
			},
			get: function(evento) {
				return $http({
					url: 'backend/eventi/ricerca_eventi.php',
					method: 'GET',
					params: {
						evento: evento
					}
				});
			}
		};
	}
]);
moduloServices.factory('eventiSharedService', ['$rootScope',
    function($rootScope) {
        var eventiSharedService = {};
        eventiSharedService.prepareBroadcast = prepareBroadcast;
        eventiSharedService.broadcastItem = broadcastItem;

        function prepareBroadcast() {
            this.broadcastItem();
        };
        function broadcastItem() {
            $rootScope.$broadcast('eventiBroadcast');
        };
        return eventiSharedService;
    }
]);