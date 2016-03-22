lendinara.controller('layoutStampaController', ['$scope', 'testiService', '$timeout',
    function($scope, testiService, $timeout) {
        $scope.blocco1 = {
        	type: 'blocco1',
            testo: '',
            altezza: '4'
        };
        $scope.blocco2 = {
        	type: 'blocco2',
            testo: '',
            altezza: '10'
        };
        // $scope.blocco1.altezza = '4';
        // $scope.blocco2.altezza = '10';
        $scope.modifica = function() {
            var blocchi = [];
            blocchi.push($scope.blocco1);
            blocchi.push($scope.blocco2);
            var file = 'tesseramento';
            console.log(blocchi)
            testiService.postTesto(file, JSON.stringify(blocchi)).success(function(data) {
                if (data === '') {
                    $scope.messaggio = true;
                    $timeout(function() {
                        $scope.messaggio = false;
                    }, 3000);
                }else{
                	$scope.errore = true;
                    $timeout(function() {
                        $scope.errore = false;
                    }, 3000);
                }
            });
        };
        carica_testi = function() {
            testiService.getTesti('tesseramento').success(function(data) {
            	$scope.blocco1 = data[0];
            	$scope.blocco2 = data[1];
            	$scope.styleblocco1 = {'height':$scope.blocco1.altezza + 'cm'}; 
            	$scope.styleblocco2 = {'height':$scope.blocco2.altezza + 'cm'}; 
            }).error(function(data) {
                console.log(data);
            });
        };
        carica_testi();
    }
]);