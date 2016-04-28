moduloServices.factory('tessereService', ['$http',
    function($http) {
        return {
            update: function(tessera) {
                return $http({
                    url: 'backend/tessere/update.php',
                    method: 'GET',
                    params: {
                        tessera: tessera
                    }
                });
            }
        };
    }
]);