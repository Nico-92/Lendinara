lendinara.controller('CreaEventoCtrl', ['$scope', 'eventiService', 'eventiSharedService', '$timeout', function($scope, eventiService, eventiSharedService, $timeout) {
    $scope.crea = function(evento) {
        $scope.risultato = null;
        if (!evento.hasOwnProperty('altro')) {
            evento.altro = '';
        }
        if (!evento.hasOwnProperty('luogo')) {
            evento.luogo = '';
        }
        if (!evento.hasOwnProperty('costo')) {
            evento.costo = '';
        }
        if ($scope.creaevento.$valid) {
            /* EVENTUALI CONTROLLI */
            eventiService.post(evento).success(function(data) {
                if (data == 'true') {
                    $scope.risultato = true;
                    $scope.messaggio = 'Evento inserito con successo';
                    eventiSharedService.prepareBroadcast();
                    $timeout(function() {
                        $scope.risultato = undefined;
                    }, 3000);
                } else {
                    $scope.risultato = false;
                    $scope.messaggio = data;
                    $timeout(function() {
                        $scope.risultato = undefined;
                    }, 3000);
                }
            });
        } else {
            $scope.risultato = false;
            $scope.messaggio = 'Completa i campi indicati';
            $timeout(function() {
                $scope.risultato = undefined;
            }, 3000);
        }
    };
}]);