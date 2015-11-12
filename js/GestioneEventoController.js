lendinara.controller('GestioneEventoCtrl', ['$scope', 'eventiService', function($scope, eventiService) {
    $scope.selezionaEvento = null;
    eventiService.get().success(function(data) {
        $scope.eventi = data;
    });
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
            } else {
                $scope.risultato = false;
                $scope.messaggio = data;
            }
        });
    };
    $scope.elimina = function() {
        if (confirm('Sicuro di voler eliminare l\'evento ' + $scope.selezionaEvento.nome + '? tutti gli iscritti andranno persi')) {
              eventiService.delete($scope.selezionaEvento).success(function(data) {
                if (data == 'true') {
                    $scope.risultato = true;
                    $scope.messaggio = 'Evento eliminato con successo';
                    location.reload();
                } else {
                    $scope.risultato = false;
                    $scope.messaggio = data;
                }
            });
        }
    };
}]);