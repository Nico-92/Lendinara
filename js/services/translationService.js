moduloServices.factory('translationService', ['$http', '$rootScope',
    function($http, $rootScope) {
        var translationService = {};
        translationService.getTranslation = getTranslation;
        translationService.prepareBroadcast = prepareBroadcast;
        translationService.broadcastItem = broadcastItem;

        function getTranslation(language) {
            return $http({
                url: 'files/' + language + '.json',
                method: 'GET'
            });
        };
        function prepareBroadcast(msg) {
            this.translation = msg;
            this.broadcastItem();
        };
        function broadcastItem() {
            $rootScope.$broadcast('translationBroadcast');
        };
        return translationService;
    }
]);