var lendinara = angular.module('lendinara', ['ngResource'], function($locationProvider) {
      $locationProvider.html5Mode(true);
    });
lendinara.controller('stampaIscritti', function ($scope, $http, $location) {
    $scope.deleteColumn = function(indice){
        $scope.properties.splice(indice, 1);
        
    };
    $scope.predicato = 'numero';
    $scope.reverse = false;
    $scope.condizione_modifica = "Modifica";
    $scope.modifica_attiva = false;
    $scope.modifica = function(){
         if($scope.modifica_attiva == false){
            $scope.modifica_attiva = true;
            $scope.condizione_modifica = "Salva";
        }
        else{
            $scope.modifica_attiva = false;
            $scope.condizione_modifica = "Modifica";
            $http({
                url: 'salva_iscritti.php',
                method: 'GET',
                params: { iscritti: JSON.stringify($scope.iscritti),
                          evento: $scope.evento }
            })
            .success(function (data){
                console.log(data);
            }).error(function(data){
                console.log(data);
            });
        }
    }
    $scope.ordina_colonne = function(property, ordine){
        $scope.predicato = property;
        $scope.reverse = !$scope.reverse;
    }
    $scope.moveColumn = function(direzione,indice){
        var appoggio;
        if(direzione === 'dx'){
            if(indice < $scope.properties.length-1){
                appoggio = $scope.properties[indice+1];
                $scope.properties[indice+1] = $scope.properties[indice];
                $scope.properties[indice] = appoggio; 
            }
        }else{
            if(indice > 0){
                appoggio = $scope.properties[indice-1];
                $scope.properties[indice-1] = $scope.properties[indice];
                $scope.properties[indice] = appoggio;
            } 
        }
    }
    var parametro = $location.search()['evento'];
    $scope.evento = parametro;
    $http({
            url: 'ricerca_iscritti.php',
            method: 'GET',
            params: { evento: parametro }
            }).success(function (data){   
                $scope.numero_iscritti = data.length;
                $scope.iscritti = data;
                $scope.properties = Object.keys(data[0]);
                console.log(data);
        }).error(function(data){
        	console.log(data);
        });
    $scope.formato = 'csv';
    $scope.esporta = function(){
        if($scope.formato == 'csv')
            $scope.formato = 'lettura';
        else
            $scope.formato = 'csv';
    };
    $scope.stampa = function(){
        window.print();
    };
});