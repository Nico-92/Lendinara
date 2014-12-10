var lendinara = angular.module('lendinara', ['ngResource', 'ui.bootstrap', 'ngGrid']);
lendinara.controller('RiassuntoIscrittiCtrl', function ($scope, $http, $rootScope) {
	   

	   $scope.gridOptions = { data: 'iscritti',
       columnDefs: [
                {field:'nome', displayName:'Nome e cognome'},
                {field:'datanascita', displayName:'Data nascita'},
                {field:'luogonascita', displayName:'Luogo nascita'},
                {field:'tessera_fmi', displayName:'Tessera CSEN n°'},
                {field:'data_fmi', displayName:'Data di rilascio'},
                {field:'telefono', displayName:'Telefono'},
                {field:'email', displayName:'Email'}
                ] 
        };
    
	$http({
            url: 'listaIscritti.php',
            method: 'GET'
            }).success(function (data){
            	$scope.iscritti = data.risultato;
                //console.log($scope.iscritti)
            })

    $scope.filtra = function(){
        if($scope.only_csen === true){
            for(i=0; i<$scope.iscritti.length; i++){
                if($scope.iscritti[i].tessera_fmi == '' || $scope.iscritti[i].tessera_fmi == ' '){
                    console.log($scope.iscritti[i].tessera_fmi)
                    $scope.iscritti.splice(i, 1);
                }  
            }    
        }
    }    

});