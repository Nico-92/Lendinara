moduloServices.factory('testiService', ['$http',
    function($http) {
        return {
            getTesti: function(tipo) {
                return $http({
                    url: 'backend/testi/ricerca_testi.php',
                    method: 'GET',
                    params: {
                        tipo: tipo
                    }
                });
            },
            getTestiBiglietti: function() {
                return $http({
                    url: 'backend/testi/ricerca_biglietti.php',
                    method: 'GET'
                });
            },
            postBiglietti: function(bigliettosx, bigliettodx) {
                return $http({
                    url: 'backend/testi/salva_biglietti.php',
                    method: 'GET',
                    params: {
                        bigliettosx: bigliettosx,
                        bigliettodx: bigliettodx
                    }
                })
            },
            postTesto: function(testo, posizione, id, azione) {
                return $http({
                    url: 'backend/testi/salva_testi.php',
                    method: 'GET',
                    params: {
                        testo: testo,
                        posizione: posizione,
                        id: id,
                        azione: azione
                    }
                })
            },
            changeOptions: function(options) {
                return $http({
                    url: 'backend/testi/salva_opzioni.php',
                    method: 'GET',
                    params: {
                        options: options
                    }
                })
            },
            getOptions: function() {
                return $http({
                    url: 'backend/testi/get_opzioni.php',
                    method: 'GET'
                })
            }
        };
    }
]);