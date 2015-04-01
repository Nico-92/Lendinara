angular.module('riassuntoControllers').controller('RiassuntoIscrittiCtrl', ['$scope', '$http', '$rootScope', 'tesseratiService',  
    function ($scope, $http, $rootScope, tesseratiService) {
        $scope.tesserati = function (){
        return tesseratiService.query()
            .success(function(data){
                $scope.iscritti = data.risultato;
            });
        }

        $scope.tesserati();
        $scope.filtraDate = function(){
            var tesserati = [];
            if($scope.filtro.inizio){
                var inizio = new Date($scope.filtro.inizio);
                inizio = inizio.getTime();
                console.log($scope.filtro.inizio + ' ' + inizio)
                var datatessera;
                var arrayData = [];
                for(i = 0; i < $scope.iscritti.length; i++){
                    if($scope.iscritti[i].data){
                        arrayData = $scope.iscritti[i].data.split('-');
                        datatessera = new Date(arrayData[2] + '-' + arrayData[1] + '-' + arrayData[0]);
                        datatessera = datatessera.getTime();
                        console.log($scope.iscritti[i].nome + ' ' + $scope.iscritti[i].data + ' ' + datatessera)
                        if(datatessera >= inizio ){
                            tesserati.push($scope.iscritti[i]); 
                        }
                    }
                }
                $scope.iscritti = tesserati;
            }
            if($scope.filtro.fine){
                var fine = new Date($scope.filtro.fine);
                fine = fine.getTime();
                var datatessera;
                var arrayData = [];
                for(i = 0; i < $scope.iscritti.length; i++){
                    if($scope.iscritti[i].data){
                        arrayData = $scope.iscritti[i].data.split('-');
                        datatessera = new Date(arrayData[2] + '-' + arrayData[1] + '-' + arrayData[0]);
                        datatessera = datatessera.getTime();
                        if(datatessera <= fine ){
                            tesserati.push($scope.iscritti[i]); 
                        }
                    }
                }
                $scope.iscritti = tesserati;
            }
        }
        $scope.filtra = function(){
            var tesserati = [];
            if($scope.filtro.tesserati){
                for(i = 0; i < $scope.iscritti.length; i++){
                    if($scope.iscritti[i].tessera != ''){
                        tesserati.push($scope.iscritti[i]); 
                    }
                }
                $scope.iscritti = tesserati;
            }else{
                $scope.tesserati();
            }
        }    
	   $scope.gridOptions = { data: 'iscritti',
       columnDefs: [
                {field:'nome', displayName:'Nome e cognome'},
                {field:'datanascita', displayName:'Data nascita'},
                {field:'luogonascita', displayName:'Luogo nascita'},
                {field:'tessera', displayName:'Tessera'},
                {field:'data', displayName:'Data di rilascio'},
                {field:'telefono', displayName:'Telefono'},
                {field:'email', displayName:'Email'}
                ] 
        };   

}]);