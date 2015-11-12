lendinara.controller('CreaEventoCtrl',  ['$scope', 'eventiService', function ($scope, eventiService) {
    $scope.crea = function(evento){
        $scope.risultato=null;
        if(!evento.hasOwnProperty('altro')){
            evento.altro = '';
        }
        if(!evento.hasOwnProperty('luogo')){
            evento.luogo = '';
        }
        if(!evento.hasOwnProperty('costo')){
            evento.costo = '';
        }
        if($scope.creaevento.$valid){
            /* EVENTUALI CONTROLLI */
            eventiService.post(evento).success(function (data){
                if(data == 'true'){
                    $scope.risultato = true;
                    $scope.messaggio = 'Evento inserito con successo';
                }else{
                    $scope.risultato=false;
                    $scope.messaggio = data;
                }
            });
        }
        else{
            $scope.risultato=false;
            $scope.messaggio = 'Completa i campi indicati';
        }
        
    };

}]);