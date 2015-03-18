angular.module('moduloServices')
.factory('iscrittiService', ['$http',
	function($http){
		return {
			get: function(name){
				return 	$http({
			            url: 'datiUtente.php',
			            method: 'GET',
			            params: { iscritto: name }
			        })
			},
			query: function(val){
				return 	$http({
						url: 'listaNomi.php',
			            method: 'GET',
			            params: { nome: val }
		      		})
			},
			del: function(id){
				return $http({
			            url: 'elimina_definitivamente.php',
			            method: 'GET',
			            params: { id: id }
						})
			}
		}
}]);

angular.module('moduloServices')
.factory('eventiService', ['$http',
	function($http){
		return {
			get: function(evento){
				return $http({
		            url: 'ricerca_eventi.php',
		            method: 'GET',
		            params: { evento: evento }
				})
			}
		}
}]);

angular.module('moduloServices')
.factory('mySharedService', function($rootScope) {
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