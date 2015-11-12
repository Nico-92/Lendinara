moduloServices.factory('iscrittiService', ['$http',
	function($http) {
		return {
			get: function(name) {
				return $http({
					url: 'datiUtente.php',
					method: 'GET',
					params: {
						iscritto: name
					}
				});
			},
			query: function(val) {
				return $http({
					url: 'listaNomi.php',
					method: 'GET',
					params: {
						nome: val
					}
				});
			},
			del: function(id) {
				return $http({
					url: 'elimina_definitivamente.php',
					method: 'GET',
					params: {
						id: id
					}
				});
			},
			updateField: function(table, field, value, whereField, whereValue) {
				return $http({
					url: 'backend/update_field.php',
					method: 'GET',
					params: {
						data: {
							table: table,
							field: field,
							value: value,
							whereField: whereField,
							whereValue: whereValue
						}
					}
				});
			}
		};
	}
]);

moduloServices.factory('mySharedService', function($rootScope) {
		var sharedService = {};

		sharedService.iscritto = '';

		sharedService.prepareBroadcast = function(msg) {
			this.iscritto = msg;
			this.broadcastItem();
		};

		sharedService.broadcastItem = function() {
			$rootScope.$broadcast('handleBroadcast');
		};

		return sharedService;
	});

angular.module('moduloServices')
	.factory('tesseratiService', ['$http',
		function($http) {
			return {
				query: function() {
					return $http({
						url: 'listaIscritti.php',
						method: 'GET',
					})
				}
			}
		}
	]);