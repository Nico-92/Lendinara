lendinara.controller('CreaEventoCtrl',  ['$scope', function ($scope) {
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
            $http({
                url: 'crea_evento.php',
                method: 'GET',
                params: { evento: evento }
            }).success(function (data){
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