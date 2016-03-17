tessera.config(['$locationProvider', function($locationProvider) {
    $locationProvider.html5Mode(true);
}])
tessera.controller('tesseraController', ['$scope', '$location', 'iscrittiService', 'ipCookie', function($scope, $location, iscrittiService, ipCookie) {
    // Recupero i parametri dall'url
    var paramValue = $location.search();
    // Leggo i cookie per i settaggi iniziali
    $scope.etichette = {};
    if (ipCookie('stampaIn')) {
        $scope.etichette.stampaIn = ipCookie('stampaIn');
        $scope.etichette.numeroEtichette = 24;
    } else {
        $scope.etichette = {
            numeroEtichette: 24,
            stampaIn: 1
        };
    }
    if (ipCookie('marginiStampaTessere')) {
        $scope.margine = ipCookie('marginiStampaTessere');
    } else {
        $scope.margine = {
            superiore: 1,
            sinistro: 0.5
        }
    }
    // Recupero i dati relativi all'utente passato nell'url
    iscrittiService.get(paramValue.nome).success(function(data) {
        $scope.iscritto = {
            dataNascita: moment(data.datanascita, 'YYYY-MM-DD').format('DD / MM / YYYY'),
            dataRilascio: moment().format("DD / MM / YYYY"),
            nome: data.nome,
            barcode: data.barcode,
            id: data.id
        }
        $scope.datarilascio = moment().format("YYYY-MM-DD");
    });
    $scope.arrayEtichette = new Array($scope.etichette.numeroEtichette);
    $scope.setNumeroEtichette = function() {
        if ($scope.etichette.numeroEtichette !== "") {
            $scope.arrayEtichette = Array(parseInt($scope.etichette.numeroEtichette));
        }
    };
    // Genera un barcode per chi ne è sprovvsito e lo salva in database
    $scope.setBarcode = function() {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        for (var i = 0; i < 4; i++) {
            text += possible.charAt(Math.floor(Math.random() * possible.length));
        }
        iscrittiService.updateField('iscritti', 'barcode', text, 'id', $scope.iscritto.id).success(function(data) {
            if (data === '1') {
                $scope.iscritto.barcode = text;
            }
        });
    };
    // Cambio data rilascio tessera
    $scope.changeDate = function(){
        $scope.iscritto.dataRilascio = moment($scope.datarilascio).format('DD / MM / YYYY');
    }
    // Aggiorna il cookie dei margini quando vengono modificati
    $scope.updateMargins = function() {
        ipCookie.remove('marginiStampaTessere');
        ipCookie('marginiStampaTessere', $scope.margine);
    };
    // Quando si clicca su stampa/si modifica il campo di testo si aggiorna il cookie della posizione di stampa, muovendo in avanti di uno
    $scope.setStampaInCookie = function() {
        ipCookie.remove('stampaIn');
        ipCookie('stampaIn', parseInt($scope.etichette.stampaIn) + 1);
    }
}]);