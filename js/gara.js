var lendinara = angular.module('lendinara', ['ngResource']);

lendinara.controller('GestioneEventoCtrl', function ($scope, $http) {
    $scope.selezionaEvento = null;
    $http.get('ricerca_eventi.php').success(function (data){
    	$scope.eventi = data;
    })
    $scope.selezionato = function(){
    	$http({
            url: 'ricerca_eventi.php',
            method: 'GET',
            params: { evento: $scope.selezionaEvento }
            }).success(function (data){
    			$scope.datievento = data;
    			$scope.datievento.costo = parseFloat($scope.datievento.costo, 2);
        })
    }
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
		        })
    }
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
        	})
		}
    	
    }

});

lendinara.controller('CreaEventoCtrl', function ($scope, $http) {
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
            })
        }
        else{
            $scope.risultato=false;
            $scope.messaggio = 'Completa i campi indicati';
        }
        
    }

});

lendinara.controller('GestioneTestoCtrl', function ($scope, $http) {
    $scope.nuovo = false;
    $scope.indice_corrente = 0;
    $scope.indice_massimo = 0;
    $scope.testo = "";
    $http.get('ricerca_biglietti.php').success(function (data){
        $scope.bigliettodx = data.bigliettodx;
        $scope.bigliettosx = data.bigliettosx;
    })
    $scope.modifica = function(testo, posizione, azione){
        console.log(azione)
        $http({
                url: 'testo_da_stampare.php',
                method: 'GET',
                params: { testo: testo,
                        posizione: posizione,
                        id: $scope.testi[$scope.indice_corrente].id,
                        azione: azione }
            }).success(function (data){
                if(data == 'true'){
                    $scope.nuovo = false;
                    $scope.risultato = true;
                    $scope.messaggio = azione + ' eseguito con successo';
                }else{
                    $scope.risultato=false;
                    $scope.messaggio = data;
                }
            })
        
    };
    $http.get('ricerca_testi.php').success(function (data){
        $scope.indice_massimo = data.length-1;
        $scope.testi = data;
        console.log(data)
        for(i = 0; i < $scope.testi.length; i++){
            $scope.testi[i].testo = $scope.testi[i].testo.replace(/<br\s*\/?>/mg,"\n");
        }
        $scope.testo = $scope.testi[$scope.indice_corrente].testo; 
        $scope.posizione = $scope.testi[$scope.indice_corrente].posizione; 
        
    }).error(function (data){
        console.log(data)
    })
    $scope.cambia = function(direzione){
        $scope.nuovo = false;
        console.log($scope.indice_corrente);
        //Gestione indice
        if(direzione=='successivo'){
            if($scope.indice_corrente == $scope.indice_massimo){
                $scope.indice_corrente = 0;
            }else{
                 $scope.indice_corrente++;
            }
            //--------
            $scope.testo = $scope.testi[$scope.indice_corrente].testo; 
            $scope.posizione = $scope.testi[$scope.indice_corrente].posizione; 
        }else{
            //Gestione indice
            if($scope.indice_corrente == 0){
                $scope.indice_corrente = $scope.indice_massimo;
            }else{
                $scope.indice_corrente--;
            }
            //------
            
            $scope.testo = $scope.testi[$scope.indice_corrente].testo; 
            $scope.posizione = $scope.testi[$scope.indice_corrente].posizione; 

        }
    }
    $scope.reset = function(){
        $scope.testo = '';
        $scope.posizione = '';
        $scope.nuovo = true;
    }
    $scope.modificaBiglietti = function(bigliettosx, bigliettodx){
        if(!bigliettosx){
            bigliettosx = '';
        }
        if(!bigliettodx){
            bigliettodx = '';
        }
        $http({
            url: 'modifica_biglietti.php',
            method: 'GET',
            params: { bigliettosx: bigliettosx,
                    bigliettodx: bigliettodx }
        }).success(function (data){
            if(data == 'true'){
                $scope.risultatoBiglietti = true;
                $scope.messaggio = 'Testo modificato con successo';
            }else{
                $scope.risultatoBiglietti=false;
                $scope.messaggio = data;
            }
        })

    }
});