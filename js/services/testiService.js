moduloServices.factory('testiService', ['$http',
    function($http) {
        return {
            getTesti: function(evento) {
                return $http({
                    url: 'backend/testi/ricerca_testi.php',
                    method: 'GET',
                });
            },
            getTestiBiglietti: function(evento) {
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
            }
        };
    }
]);