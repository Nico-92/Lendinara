lendinara.controller('loginController', ['$scope', '$location', 'translationService', 'loginService',
    function($scope, $location, translationService, loginService) {
        $scope.loginError = false;

        function getTranslation(language) {
            translationService.getTranslation(language).success(function(data) {
                $scope.translation = data;
            });
        }
        getTranslation('it');
        $scope.changeLanguage = function(language) {
            getTranslation(language);
        };
        $scope.login = function(login) {
            if (login === 'demo') {
                login = {
                    username: 'demo',
                    password: 'demo'
                }
            }
            loginService.login(login).success(function(data) {
                if (data === 'true') {
                    window.location.href = "modulo.php"
                } else {
                    $scope.loginError = true;
                }
            });
        }
    }
]);