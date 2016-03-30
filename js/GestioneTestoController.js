lendinara.controller('GestioneTestoCtrl', ['$scope', 'testiService', function($scope, testiService) {
    $scope.nuovo = false;
    $scope.options = {
        certificato: false,
        cauzione: false,
        acconto: false,
        codicefiscale: false,
        assicurazione: false
    };
    testiService.getOptions().success(function(data) {
        for (var key in data) {
            if(data[key] === '1'){
                data[key] = true;
            }
        }
        $scope.options = data;
    });
    testiService.getTestiBiglietti().success(function(data) {
        $scope.bigliettodx = data.bigliettodx;
        $scope.bigliettosx = data.bigliettosx;
    });
    /*$scope.modifica = function(testo, posizione, azione) {
        testiService.postTesto(testo, posizione, $scope.testi[$scope.indice_corrente].id, azione).success(function(data) {
            if (data == 'true') {
                if ((azione == 'salva') || (azione == 'elimina')) {
                    carica_testi();
                }
                $scope.nuovo = false;
                $scope.risultato = true;
                $scope.messaggio = azione + ' eseguito con successo';
            } else {
                $scope.risultato = false;
                $scope.messaggio = data;
            }
        });
    };
    carica_testi = function() {
        $scope.indice_corrente = 0;
        $scope.indice_massimo = 0;
        $scope.testo = "";
        testiService.getTesti().success(function(data) {
            $scope.indice_massimo = data.length - 1;
            $scope.testi = data;
            for (i = 0; i < $scope.testi.length; i++) {
                $scope.testi[i].testo = $scope.testi[i].testo.replace(/<br\s*\/?>/mg, "\n");
            }
            $scope.testo = $scope.testi[$scope.indice_corrente].testo;
            $scope.posizione = $scope.testi[$scope.indice_corrente].posizione;
        }).error(function(data) {
            console.log(data);
        });
    };
    carica_testi();*/
    $scope.cambia = function(direzione) {
        $scope.nuovo = false;
        console.log($scope.indice_corrente);
        //Gestione indice
        if (direzione == 'successivo') {
            if ($scope.indice_corrente == $scope.indice_massimo) {
                $scope.indice_corrente = 0;
            } else {
                $scope.indice_corrente++;
            }
            //--------
            $scope.testo = $scope.testi[$scope.indice_corrente].testo;
            $scope.posizione = $scope.testi[$scope.indice_corrente].posizione;
        } else {
            //Gestione indice
            if ($scope.indice_corrente == 0) {
                $scope.indice_corrente = $scope.indice_massimo;
            } else {
                $scope.indice_corrente--;
            }
            //------
            $scope.testo = $scope.testi[$scope.indice_corrente].testo;
            $scope.posizione = $scope.testi[$scope.indice_corrente].posizione;
        }
    };
    $scope.reset = function() {
        $scope.testo = '';
        $scope.posizione = '';
        $scope.nuovo = true;
    };
    $scope.modificaBiglietti = function(bigliettosx, bigliettodx) {
        if (!bigliettosx) {
            bigliettosx = '';
        }
        if (!bigliettodx) {
            bigliettodx = '';
        }
        testiService.postBiglietti(bigliettosx, bigliettodx).success(function(data) {
            if (data == 'true') {
                $scope.risultatoBiglietti = true;
                $scope.messaggio = 'Testo modificato con successo';
            } else {
                $scope.risultatoBiglietti = false;
                $scope.messaggio = data;
            }
        });
    };
    $scope.changeOptions = function() {
        console.log($scope.options);
        testiService.changeOptions($scope.options).success(function(data) {
            if (data === 'true') {
                $scope.optionsMessage = true;
            } else {
                //qualcosa
            }
        });
    };
}]);