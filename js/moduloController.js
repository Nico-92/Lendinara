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
function PlaySound() {
   var snd = new  Audio("data:audio/wav;base64,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qJrx4KOQjahZxWbcZgztj2c49nKmkId44S71j0c8eV9yDK6uPRzx5X18eDvjvQ6yKo9ZSS6l//8elePK/Lf//IInrOF/FvDoADYAGBMGb7FtErm5MXMlmPAJQVgWta7Zx2go+8xJ0UiCb8LHHdftWyLJE0QIAIsI+UbXu67dZMjmgDGCGl1H+vpF4NSDckSIkk7Vd+sxEhBQMRU8j/12UIRhzSaUdQ+rQU5kGeFxm+hb1oh6pWWmv3uvmReDl0UnvtapVaIzo1jZbf/pD6ElLqSX+rUmOQNpJFa/r+sa4e/pBlAABoAAAAA3CUgShLdGIxsY7AUABPRrgCABdDuQ5GC7DqPQCgbbJUAoRSUj+NIEig0YfyWUho1VBBBA//uQZB4ABZx5zfMakeAAAAmwAAAAF5F3P0w9GtAAACfAAAAAwLhMDmAYWMgVEG1U0FIGCBgXBXAtfMH10000EEEEEECUBYln03TTTdNBDZopopYvrTTdNa325mImNg3TTPV9q3pmY0xoO6bv3r00y+IDGid/9aaaZTGMuj9mpu9Mpio1dXrr5HERTZSmqU36A3CumzN/9Robv/Xx4v9ijkSRSNLQhAWumap82WRSBUqXStV/YcS+XVLnSS+WLDroqArFkMEsAS+eWmrUzrO0oEmE40RlMZ5+ODIkAyKAGUwZ3mVKmcamcJnMW26MRPgUw6j+LkhyHGVGYjSUUKNpuJUQoOIAyDvEyG8S5yfK6dhZc0Tx1KI/gviKL6qvvFs1+bWtaz58uUNnryq6kt5RzOCkPWlVqVX2a/EEBUdU1KrXLf40GoiiFXK///qpoiDXrOgqDR38JB0bw7SoL+ZB9o1RCkQjQ2CBYZKd/+VJxZRRZlqSkKiws0WFxUyCwsKiMy7hUVFhIaCrNQsKkTIsLivwKKigsj8XYlwt/WKi2N4d//uQRCSAAjURNIHpMZBGYiaQPSYyAAABLAAAAAAAACWAAAAApUF/Mg+0aohSIRobBAsMlO//Kk4soosy1JSFRYWaLC4qZBYWFRGZdwqKiwkNBVmoWFSJkWFxX4FFRQWR+LsS4W/rFRb/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////VEFHAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAU291bmRib3kuZGUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMjAwNGh0dHA6Ly93d3cuc291bmRib3kuZGUAAAAAAAAAACU=");  
   snd.play();
}
/**
    Execute the operation before load controller
*/
angular.module('moduloControllers').run(function($rootScope, $http) {
    // Carica tendina eventi e relativi dati
    $http.get('ricerca_eventi.php').success(function (data){
        $rootScope.eventi = data;
    })
});
angular.module('moduloControllers').controller('IscrizioneGaraCtrl', ['$scope', '$http', '$timeout', 'iscrittiService', 'eventiService', 'mySharedService',
 function ($scope, $http, $timeout, iscrittiService, eventiService, sharedService) {
    $scope.classeStampa = 'hide';
    $scope.printable = 'unstamp';
    $scope.vuoi_stampare = false;
    $scope.numeri_doppi = false;
    
    $scope.getIscritti = function(val) {
        var nomi = [];
        return iscrittiService.query(val)
            .then(function(res){
            angular.forEach(res.data.risultato, function(item){
                nomi.push(item.nome);
            });
            return nomi;
        });
    };

    $scope.getCategoria = function(val){
        var categorie = [];
        return eventiService.getCategorie($scope.selezionaEvento.nome, val)
            .then(function(res){   
                angular.forEach(res.data.risultato, function(item){
                    categorie.push(item.categoria);
                });
                return categorie;
            });
    };
    
	$scope.selezionato = function(){
        var numeriDisponibili = [];
        eventiService.getNumeri($scope.selezionaEvento)
            .success(function(data){
                for (var i = 0; i < data.risultato.length; i++) {
                    if(i != data.risultato[i].numero){
                        numeriDisponibili.push(i);
                    }
                };
                console.log(numeriDisponibili)
            });
        eventiService.get($scope.selezionaEvento)
            .success(function (data){
    			$scope.datievento = data;
    			$scope.datievento.costo = parseFloat($scope.datievento.costo, 2);
        })
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

    $scope.checkIscritto = function(iscritto){
        iscrittiService.get(iscritto)
            .success( function(data){
                // Necessario usando l'autocomplete
                if(data != 'false'){
                    sharedService.prepareBroadcast(iscritto);
                    // Controllo se la tessera enduro lendinara è valida
                    // Se la data non è presente errore
                    if(data.data_el){
                        var tessera = new Date(data.data_el.substring(6,10), data.data_el.substring(3,5), data.data_el.substring(0,2));
                        var current_year = new Date();
                        var lapse = timeLapse(tessera,current_year);
                         if(lapse > 365){
                            $scope.errore1 = 'Attenzione, tessera El non valida ';
                            PlaySound();
                        }else{
                            $scope.errore1 = '';
                        }
                    }else{
                        $scope.errore1 = 'Attenzione, tessera El non valida ';
                        PlaySound();
                    }
                    // Controllo se il certificato medico è valido
                    if(data.scadenza){
                        var scadenza = new Date(data.scadenza.substring(6,10), data.scadenza.substring(3,5), data.scadenza.substring(0,2));
                        var current_year = new Date();
                        if(current_year > scadenza){
                            $scope.errore1 =  $scope.errore1 + 'Attenzione, certificato medico scaduto ';
                            PlaySound();
                        }else{
                            $scope.errore1 = '';
                        }
                    }else{
                        $scope.errore1 = 'Attenzione, certificato medico scaduto ';
                        PlaySound();
                    }
                }
            })
            .error(function(data){
            });
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
            if(iscritto.hasOwnProperty('nome1')){
                iscritto.nome = iscritto.nome1;
            }
            if(!iscritto.hasOwnProperty('nome2')){
                iscritto.nome2 = '';
            }
            if(!iscritto.hasOwnProperty('nome3')){
                iscritto.nome3 = '';
            }
            console.log(iscritto)
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
                                }, 50);
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
    };

    $scope.reset = function(val){
        $scope.errore1 = false;
        $scope.numero_in_uso = false;
        if(val==1){
            $timeout(function(){
                $scope.grandeNumero = "";
                $scope.iscritto = {};
                $scope.messaggio = "";
                $scope.risultato = undefined;
            }, 2500);
        }else{
            $scope.messaggio = "";
            $scope.risultato = undefined;
        }    
    };

}]);

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
angular.module('moduloControllers').controller('IscrizioneLendinaraCtrl', ['$scope', '$http', '$timeout', '$rootScope', 'iscrittiService', 'mySharedService', 
    function ($scope, $http, $timeout, $rootScope, iscrittiService, sharedService) {
    $scope.$on('handleBroadcast', function(){
        $scope.loadData(sharedService.iscritto);                 
    });
    $scope.stato = 'Mostra';
    $scope.classeStampa = 'hide';
    $scope.printable = 'unstamp';
    $scope.id = undefined;
    $scope.nuovoIscritto = undefined;

    $scope.getCommonVarie = function(val){
        return $http.get('listaCommonVarie.php', {
            params: { nome: val }
        }).then(function(res){
            var varie = [];
            angular.forEach(res.data.risultato, function(item){
                varie.push(item.varie);
            });
            return varie;
        });
    };

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
        iscrittiService.get(val).then(function (res){
            console.log(res.data)
            var data = res.data;
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
        }, 50);
        mediaQueryList2.addListener(function(mql2) {
            if (mql2.matches) {
                //document.getElementById('testo2').className = 'list-group';
            } else {
                console.log('not match')
                $scope.classeStampa = 'hide';
                $scope.printable = 'unstamp';
                $scope.reset(1);
                //document.getElementById('testo2').className = 'hide';
            }
            
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
                        //$scope.reset(1);
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
            iscrittiService.del($scope.id)
            .success(function (data){
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
}]);