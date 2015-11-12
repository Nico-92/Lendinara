moduloServices.factory('gareService', ['$http',
    function($http) {
        return {
            getNumeri: function(evento) {
                return $http({
                    url: 'backend/gare/ricerca_numeri.php',
                    method: 'GET',
                    params: {
                        evento: evento
                    }
                });
            },
            getClassi: function(evento, categoria) {
                return $http({
                    url: 'backend/gare/ricerca_classi.php',
                    method: 'GET',
                    params: {
                        evento: evento,
                        categoria: categoria
                    }
                });
            },
            checkNumero: function(numero, evento) {
                $http({
                    url: 'backend/gare/controllo_numero.php',
                    method: 'GET',
                    params: {
                        numero: numero,
                        evento: evento
                    }
                });
            },
            post: function(iscritto, doppioni){
                return  $http({
                    url: 'backend/gare/iscrivi.php',
                    method: 'GET',
                    params: {
                        iscritto: iscritto,
                        doppioni: doppioni
                    }
                });
            }
        };
    }
]);