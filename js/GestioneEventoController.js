lendinara.controller('GestioneEventoCtrl', function ($scope, $http) {
    $scope.selezionaEvento = null;
    $http.get('ricerca_eventi.php').success(function (data){
    	$scope.eventi = data;
    });
    $scope.selezionato = function(){
    	$http({
            url: 'ricerca_eventi.php',
            method: 'GET',
            params: { evento: $scope.selezionaEvento }
            }).success(function (data){
    			$scope.datievento = data;
    			$scope.datievento.costo = parseFloat($scope.datievento.costo, 2);
        });
    };
    $scope.modifica = function(datiEvento){
    	if(!datiEvento.hasOwnProperty('altro')){
            datiEvento.altro = '';
        }
        datiEvento.nome = $scope.selezionaEvento.nome;
        $http({
            url: 'modifica_evento.php',
            method: 'GET',
            params: { evento: datiEvento }
            }).success(function (data){
		      if(data == 'true'){
		                $scope.risultato = true;
		                $scope.messaggio = 'Evento modificato con successo';
		            }else{
		                $scope.risultato=false;
		                $scope.messaggio = data;
		            }
		        });
    };
    $scope.elimina = function(){	
    	if(confirm('Sicuro di voler eliminare l\'evento '+ $scope.selezionaEvento.nome +'? tutti gli iscritti andranno persi')) {
			$http({
            url: 'elimina_evento.php',
            method: 'GET',
            params: { evento: $scope.selezionaEvento }
        	}).success(function (data){
	            if(data == 'true'){
	                $scope.risultato = true;
	                $scope.messaggio = 'Evento eliminato con successo';
	                location.reload();
	            }else{
	                $scope.risultato=false;
	                $scope.messaggio = data;
	            }
        	});
		}
    	
    };

});