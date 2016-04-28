lendinara.controller('GestioneEventoCtrl', ['$scope', 'eventiService', '$timeout', 'eventiSharedService', function($scope, eventiService, $timeout, eventiSharedService) {
    $scope.selezionaEvento = null;

    function caricaEventi() {
        eventiService.get().success(function(data) {
            $scope.eventi = data;
        });
    };
    caricaEventi();
    $scope.selezionato = function() {
        eventiService.get($scope.selezionaEvento).success(function(data) {
            $scope.datievento = data;
            $scope.datievento.costo = parseFloat($scope.datievento.costo, 2);
        });
    };
    $scope.modifica = function(datiEvento) {
        if (!datiEvento.hasOwnProperty('altro')) {
            datiEvento.altro = '';
        }
        datiEvento.nome = $scope.selezionaEvento.nome;
        eventiService.put(datiEvento).success(function(data) {
            if (data == 'true') {
                $scope.risultato = true;
                $scope.messaggio = 'Evento modificato con successo';
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
    };
    $scope.$on('eventiBroadcast', function() {
        caricaEventi();
    });
    $scope.elimina = function() {
        if (confirm('Sicuro di voler eliminare l\'evento ' + $scope.selezionaEvento.nome + '? Tutti gli iscritti andranno persi')) {
            eventiService.delete($scope.selezionaEvento).success(function(data) {
                if (data == 'true') {
                    $scope.risultato = true;
                    $scope.messaggio = 'Evento eliminato con successo';
                    caricaEventi();
                    $scope.datievento = {};
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
        }
    };
}]);