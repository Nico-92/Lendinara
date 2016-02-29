lendinara.controller('translationController', ['$scope', 'translationService',
    function($scope, translationService) {
        $scope.loginError = false;

        function getTranslation(language) {
            translationService.getTranslation(language).success(function(data) {
                translationService.prepareBroadcast(data);
            });
        }
        getTranslation('it');
        $scope.changeLanguage = function(language) {
            getTranslation(language);
        };
    }
]);