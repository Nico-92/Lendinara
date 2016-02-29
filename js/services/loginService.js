moduloServices.factory('loginService', ['$http',
    function($http) {
        return {
            login: function(login) {
            	return $http({
                    url: 'backend/login/login.php',
                    method: 'GET',
                    params: {
                        login: login
                    }
                });
            }
        };
    }
]);