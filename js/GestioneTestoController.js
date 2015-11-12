lendinara.controller('GestioneTestoCtrl', function ($scope, $http) {
    $scope.nuovo = false;
    $http.get('ricerca_biglietti.php').success(function (data){
        $scope.bigliettodx = data.bigliettodx;
        $scope.bigliettosx = data.bigliettosx;
    });

    $scope.modifica = function(testo, posizione, azione){
        $http({
                url: 'testo_da_stampare.php',
                method: 'GET',
                params: { testo: testo,
                        posizione: posizione,
                        id: $scope.testi[$scope.indice_corrente].id,
                        azione: azione }
            }).success(function (data){
                if(data == 'true'){
                    if((azione == 'salva') || (azione == 'elimina')){
                        carica_testi();
                    }
                    $scope.nuovo = false;
                    $scope.risultato = true;
                    $scope.messaggio = azione + ' eseguito con successo';
                }else{
                    $scope.risultato=false;
                    $scope.messaggio = data;
                }
            });
        
    };
    carica_testi = function(){
        $scope.indice_corrente = 0;
        $scope.indice_massimo = 0;
        $scope.testo = "";
        $http.get('ricerca_testi.php').success(function (data){
            $scope.indice_massimo = data.length-1;
            $scope.testi = data;
            for(i = 0; i < $scope.testi.length; i++){
                $scope.testi[i].testo = $scope.testi[i].testo.replace(/<br\s*\/?>/mg,"\n");
            }
            $scope.testo = $scope.testi[$scope.indice_corrente].testo; 
            $scope.posizione = $scope.testi[$scope.indice_corrente].posizione; 
            
            }).error(function (data){
                console.log(data);
        });
    };

    carica_testi();
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
    };

    $scope.reset = function(){
        $scope.testo = '';
        $scope.posizione = '';
        $scope.nuovo = true;
    };

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
        });
    };
});