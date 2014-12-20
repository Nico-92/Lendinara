var lendinara = angular.module('lendinara', ['ngResource', 'ui.bootstrap']);
lendinara.controller('IscrizioneGaraCtrl', function ($scope, $http, $rootScope, $timeout) {
    $scope.classeStampa = 'hide';
    $scope.printable = 'unstamp';
    $scope.vuoi_stampare = false;
    $scope.numeri_doppi = false;
    $scope.getIscritti = function(val) {
        return $http.get('listaNomi.php', {
            params: { nome: val }
        }).then(function(res){
            var nomi = [];
            angular.forEach(res.data.risultato, function(item){
                nomi.push(item.nome);
            });
            return nomi;
        });
    };
	
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
    };
    $scope.active = function(){
        $scope.reset();
    };
    $scope.checkNumero = function(){
        if($scope.selezionaEvento != undefined){
            if ($scope.grandeNumero != 0) {
                $http({
                    url: 'controllo_numero.php',
                    method: 'GET',
                    params: { numero: $scope.grandeNumero,
                                evento:  $scope.selezionaEvento.nome}
                    }).success(function (data){
                        if(data == false){
                            $scope.numero_in_uso = true;
                        }else{
                            $scope.numero_in_uso = false;
                        }
                    })
            }
        }
    };
    getTesto = function(posizione){
        $http({
            url: 'ricerca_testi.php',
            method: 'GET',
            params: { tipo: posizione }
            }).success(function (data){
                $scope.testi = data;
                console.log($scope.testi);
        }).error(function(data){
        	console.log(data);
        })
    };
    function timeLapse(date1, date2 ) {
        //Get 1 day in milliseconds
        var one_day=1000*60*60*24;

        // Convert both dates to milliseconds
        var date1_ms = date1.getTime();
        var date2_ms = date2.getTime();
        // Calculate the difference in milliseconds
        var difference_ms = date2_ms - date1_ms;
        
        // Convert back to days and return
        return Math.round(difference_ms/one_day); 
    }
    $scope.checkTessera = function(iscritto){
        $rootScope.iscritto = iscritto;
        document.getElementById('nominativo').value = iscritto;
        $http({
            url: 'datiUtente.php',
            method: 'GET',
            params: { iscritto: iscritto }
            }).success(function (data){
                if(data != 'false'){
                    var tessera = new Date(data.data_el.substring(0,4), data.data_el.substring(5,7), data.data_el.substring(8,10));
                    var current_year = new Date();
                    var lapse = timeLapse(tessera,current_year);
                     if(lapse > 365){
                        $scope.tessera_non_valida = true;
                    }else{
                        $scope.tessera_non_valida = false;
                    }

                }
            })
        
        
    };
    $scope.iscrivi = function(iscritto){
        if( iscritto != undefined && ( iscritto.hasOwnProperty('nome') || iscritto.hasOwnProperty('nome1') ) && $scope.grandeNumero){
            iscritto.evento = $scope.selezionaEvento.nome;
            iscritto.grandeNumero = $scope.grandeNumero;
            if(!iscritto.hasOwnProperty('categoria')){
                iscritto.categoria = '';
            }
            if(!iscritto.hasOwnProperty('motoclub')){
                iscritto.motoclub = '';
            }
            if(!iscritto.hasOwnProperty('moto')){
                iscritto.moto = '';
            }
            if(!iscritto.hasOwnProperty('varie')){
                iscritto.varie = '';
            }
            if(!iscritto.hasOwnProperty('nome')){
                iscritto.nome = iscritto.nome1;
            }
            if(!iscritto.hasOwnProperty('nome2')){
                iscritto.nome2 = '';
            }
            if(!iscritto.hasOwnProperty('nome3')){
                iscritto.nome3 = '';
            }
            $http({
                url: 'iscrivi_concorrente.php',
                method: 'GET',
                params: { iscritto: iscritto, doppioni: $scope.numeri_doppi }
                }).success(function (data){
                     if(data == 'true'){
                            $scope.risultato = true;
                            $scope.messaggio = 'Concorrente iscritto con successo';
                            if($scope.vuoi_stampare === true){
                                $scope.printable = undefined;
                                var mediaQueryList = window.matchMedia('print');
                                getTesto('gara');
                                $scope.printable = '';
                                $scope.classeStampa = 'list-group';
                                $timeout(function(){
                                    window.print();    
                                }, 30);
                                mediaQueryList.addListener(function(mql) {
                                    if (mql.matches) {
                                    	//$scope.classeStampa = 'list-group';
                                        //$scope.printable = '';
                                    } else {
                                        
                                        $scope.classeStampa = 'hide';
                                        $scope.printable = 'unstamp';
                                    }
                                });
                            }
                            $scope.reset(1);
                        }else{
                            $scope.risultato = false;
                            $scope.messaggio = data;
                        }
                })
        }
        else{
            //$scope.iscritto.nome.$setDirty();
            //$scope.iscritto.grandeNumero.$setDirty();
            $scope.risultato=false;
            $scope.messaggio = 'Nome e numero sono obbligatori';
        }
    }
    $scope.reset = function(val){
        $scope.iscritto = {};
        $scope.tessera_non_valida = false;
        $scope.grandeNumero = "";
        $scope.numero_in_uso = false;
        if(val==1){
            $timeout(function(){
                $scope.messaggio = "";
                $scope.risultato = undefined;
            }, 2500);
        }else{
            $scope.messaggio = "";
            $scope.risultato = undefined;
        }
        
    };
});

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
lendinara.controller('IscrizioneLendinaraCtrl', function ($scope, $http, $timeout) {
    $scope.stato = 'Mostra';
    $scope.classeStampa = 'hide';
    $scope.printable = 'unstamp';
    $scope.id = undefined;
    $scope.nuovoIscritto = undefined;
    $scope.getIscritti = function(val) {
        return $http.get('listaNomi.php', {
            params: { nome: val }
        }).then(function(res){
            var nomi = [];
            angular.forEach(res.data.risultato, function(item){
                nomi.push(item.nome);
            });
            return nomi;
        });
    };
    $scope.loadData = function(val){
        $http({
            url: 'datiUtente.php',
            method: 'GET',
            params: { iscritto: val }
            }).success(function (data){
                if(data == 'false'){
                    $scope.nuovoIscritto = true;
                }
                else{
                    $scope.nuovoIscritto = false;
                    $scope.id = data.id;
                    $scope.iscritto = data;
                    $scope.iscritto.cap = parseFloat($scope.iscritto.cap, 2);
                    //Verifico se il certificato è scaduto
                    var oggi = new Date();
                    var scadenza = new Date($scope.iscritto.scadenza);
                    if(scadenza.setHours(0,0,0,0) <= oggi.setHours(0,0,0,0)){
                        $scope.risultato=false;
                        $scope.messaggio = 'ATTENZIONE: Certificato medico scaduto';
                    }
                }
            })
    };
    $scope.reset = function(val){
        $scope.iscritto = {};
        if(val==1){
            $timeout(function(){
                $scope.messaggio = "";
                $scope.risultato = undefined;
            }, 2500);
        }else{
            $scope.messaggio = "";
            $scope.risultato = undefined;
        }
    };
    controlloMinorenni = function(iscritto){
        console.log(iscritto.datanascita);
        var datanascita = new Date(iscritto.datanascita);
        var ageDifMs = Date.now() - datanascita.getTime();
        var ageDate = new Date(ageDifMs); // miliseconds from epoch
        var anni = Math.abs(ageDate.getUTCFullYear() - 1970);
        console.log(anni);
        if(anni < 1 || anni > 90) {
            alert("Non puoi avere "+anni+" anni!");
        }
        else {
            if(anni<18){
                if (confirm("L'utente ha "+anni+ " anni, far firmare consenso genitori?")){       
                    window.open("minore.php?nominativo="+iscritto.nome+"&datanascita="+iscritto.datanascita+"&luogonascita="+iscritto.luogonascita+"&citta="+iscritto.citta+"&via="+iscritto.via);
                }
            }
        }
    };

    getTesto2 = function(posizione){
        $http({
            url: 'ricerca_testi.php',
            method: 'GET',
            params: { tipo: posizione }
            }).success(function (data){
                $scope.testi = data;
                console.log($scope.testi);
        })
    };


    $scope.stampa = function(){
        if(!$scope.nuovoIscritto){
            $scope.salva($scope.iscritto, 'modifica');
        }
        getTesto2('tesseramento');
        var mediaQueryList2 = window.matchMedia('print');
        $scope.printable = '';
        $scope.classeStampa = 'list-group';
        $timeout(function(){
            window.print();    
        }, 30);
        mediaQueryList2.addListener(function(mql2) {
            if (mql2.matches) {
                //document.getElementById('testo2').className = 'list-group';
            } else {
                console.log('not match')
                $scope.classeStampa = 'hide';
                $scope.printable = 'unstamp';
                //document.getElementById('testo2').className = 'hide';
            }
            $scope.reset(1);
        });
        
        
        
    }

    $scope.salva = function(iscritto, tipo){
            iscritto.funzione = tipo;
            if(!iscritto.hasOwnProperty('luogonascita')){
                iscritto.luogonascita = '';
            }
            if(!iscritto.hasOwnProperty('datanascita')){
                iscritto.datanascita = '';
            }
            if(!iscritto.hasOwnProperty('citta')){
                iscritto.citta = '';
            }
            if(!iscritto.hasOwnProperty('via')){
                iscritto.via = '';
            }
            if(!iscritto.hasOwnProperty('email')){
                iscritto.email = '';
            }
            if(!iscritto.hasOwnProperty('telefono')){
            iscritto.telefono = '';
            }
            if(!iscritto.hasOwnProperty('scadenza')){
            iscritto.scadenza = '';
            }
            if(!iscritto.hasOwnProperty('varie')){
            iscritto.varie = '';
            }
            if(!iscritto.hasOwnProperty('cap')){
            iscritto.cap = '';
            }
            if(!iscritto.hasOwnProperty('tessera_el')){
                iscritto.tessera_el = '';
            }
            if(!iscritto.hasOwnProperty('data_el')){
                iscritto.data_el = '';
            }
            if(!iscritto.hasOwnProperty('tessera_csen')){
                iscritto.tessera_csen = '';
            }
            if(!iscritto.hasOwnProperty('data_csen')){
                iscritto.data_csen = '';
            }
            if(!iscritto.hasOwnProperty('tessera_fmi')){
                iscritto.tessera_fmi = '';
            }
            if(!iscritto.hasOwnProperty('data_fmi')){
                iscritto.data_fmi = '';
            }
            if(!iscritto.hasOwnProperty('tessera_sport')){
                iscritto.tessera_sport = '';
            }
            if(!iscritto.hasOwnProperty('data_sport')){
                iscritto.data_sport = '';
            }
            if(!iscritto.hasOwnProperty('licenza')){
                iscritto.licenza = '';
            }
            if(!iscritto.hasOwnProperty('data_licenza')){
                iscritto.data_licenza = '';
            }
            iscritto.nome = iscritto.nome.toUpperCase();
            iscritto.via = iscritto.via.toUpperCase();
            iscritto.luogonascita = iscritto.luogonascita.toUpperCase();
            iscritto.citta = iscritto.citta.toUpperCase();
            iscritto.varie = iscritto.varie.toUpperCase();
            controlloMinorenni(iscritto);
            $http({
                url: 'iscrivi.php',
                method: 'GET',
                params: { iscritto: $scope.iscritto }
            })
            .success(function (data){
                if(data == 'true'){
                    $scope.risultato = true;
                    if(tipo=='salva'){
                        $scope.messaggio = iscritto.nome +' è stato iscritto con successo';
                        $scope.stampa();
                    }else{
                        $scope.messaggio = iscritto.nome +' è stato modificato con successo';
                        $scope.reset(1);
                    }
                }else{
                    console.log(data)
                    $scope.risultato=false;
                    $scope.messaggio = data;
                }
            })
    }
    $scope.elimina = function(iscritto){
        if(confirm('Sicuro di voler eliminare '+ iscritto.nome +'? Tutti i dati andranno persi')) {
            console.log($scope.id);
            $http({
            url: 'elimina_definitivamente.php',
            method: 'GET',
            params: { id: $scope.id }
            }).success(function (data){
                console.log(data);
                if(data == 'true'){
                    $scope.risultato = true;
                    $scope.messaggio = iscritto.nome + ' eliminato con successo';
                    location.reload();
                }else{
                    $scope.risultato=false;
                    $scope.messaggio = data;
                }
            })
        }
        
    }
    $scope.gestioneTessere = function(){
        if($scope.stato == 'Mostra'){
            $scope.stato = 'Nascondi';
        }else{
            $scope.stato = 'Mostra';
        }
    }
});