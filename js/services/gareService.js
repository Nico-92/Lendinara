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
                return $http({
                    url: 'backend/gare/controllo_numero.php',
                    method: 'GET',
                    params: {
                        numero: numero,
                        evento: evento
                    }
                });
            },
            post: function(iscritto, doppioni) {
                return $http({
                    url: 'backend/gare/iscrivi.php',
                    method: 'GET',
                    params: {
                        iscritto: iscritto,
                        doppioni: doppioni
                    }
                });
            },
            put: function(iscritti, evento) {
                return $http({
                    url: 'backend/gare/modifica_iscritto.php',
                    method: 'GET',
                    params: {
                        iscritti: JSON.stringify(iscritti),
                        evento: evento
                    }
                });
            },
            getIscritti: function(evento) {
                return $http({
                    url: 'backend/gare/ricerca_iscritti.php',
                    method: 'GET',
                    params: {
                        evento: evento
                    }
                });
            },
            delete: function(nome, numero, evento) {
                return $http({
                    url: 'backend/gare/elimina_iscritto.php',
                    method: 'GET',
                    params: {
                        numero: numero,
                        evento: evento,
                        nome: nome
                    }
                });
            }
        };
    }
]);