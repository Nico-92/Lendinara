moduloServices.factory('iscrittiService', ['$http',
	function($http) {
		return {
			get: function(name) {
				return $http({
					url: 'backend/iscritti/ricerca_iscritto.php',
					method: 'GET',
					params: {
						iscritto: name
					}
				});
			},
			getIscritti: function() {
                return $http({
                    url: 'backend/iscritti/ricerca_iscritti.php',
                    method: 'GET',
                });
            },
			query: function(val) {
				return $http({
					url: 'backend/iscritti/lista_nomi.php',
					method: 'GET',
					params: {
						nome: val
					}
				});
			},
			del: function(id) {
				return $http({
					url: 'backend/iscritti/elimina_iscritto.php',
					method: 'GET',
					params: {
						id: id
					}
				});
			},
			post: function(iscritto){
				return  $http({
                    url: 'backend/iscritti/iscrivi.php',
                    method: 'GET',
                    params: {
                        iscritto: iscritto
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