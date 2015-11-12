function timeLapse(date1, date2) {
    //Get 1 day in milliseconds
    var one_day = 1000 * 60 * 60 * 24;
    // Convert both dates to milliseconds
    var date1_ms = date1.getTime();
    var date2_ms = date2.getTime();
    // Calculate the difference in milliseconds
    var difference_ms = date2_ms - date1_ms;
    // Convert back to days and return
    return Math.round(difference_ms / one_day);
}

function PlaySound() {
    var snd = new Audio("data:audio/wav;base64,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qJrx4KOQjahZxWbcZgztj2c49nKmkId44S71j0c8eV9yDK6uPRzx5X18eDvjvQ6yKo9ZSS6l//8elePK/Lf//IInrOF/FvDoADYAGBMGb7FtErm5MXMlmPAJQVgWta7Zx2go+8xJ0UiCb8LHHdftWyLJE0QIAIsI+UbXu67dZMjmgDGCGl1H+vpF4NSDckSIkk7Vd+sxEhBQMRU8j/12UIRhzSaUdQ+rQU5kGeFxm+hb1oh6pWWmv3uvmReDl0UnvtapVaIzo1jZbf/pD6ElLqSX+rUmOQNpJFa/r+sa4e/pBlAABoAAAAA3CUgShLdGIxsY7AUABPRrgCABdDuQ5GC7DqPQCgbbJUAoRSUj+NIEig0YfyWUho1VBBBA//uQZB4ABZx5zfMakeAAAAmwAAAAF5F3P0w9GtAAACfAAAAAwLhMDmAYWMgVEG1U0FIGCBgXBXAtfMH10000EEEEEECUBYln03TTTdNBDZopopYvrTTdNa325mImNg3TTPV9q3pmY0xoO6bv3r00y+IDGid/9aaaZTGMuj9mpu9Mpio1dXrr5HERTZSmqU36A3CumzN/9Robv/Xx4v9ijkSRSNLQhAWumap82WRSBUqXStV/YcS+XVLnSS+WLDroqArFkMEsAS+eWmrUzrO0oEmE40RlMZ5+ODIkAyKAGUwZ3mVKmcamcJnMW26MRPgUw6j+LkhyHGVGYjSUUKNpuJUQoOIAyDvEyG8S5yfK6dhZc0Tx1KI/gviKL6qvvFs1+bWtaz58uUNnryq6kt5RzOCkPWlVqVX2a/EEBUdU1KrXLf40GoiiFXK///qpoiDXrOgqDR38JB0bw7SoL+ZB9o1RCkQjQ2CBYZKd/+VJxZRRZlqSkKiws0WFxUyCwsKiMy7hUVFhIaCrNQsKkTIsLivwKKigsj8XYlwt/WKi2N4d//uQRCSAAjURNIHpMZBGYiaQPSYyAAABLAAAAAAAACWAAAAApUF/Mg+0aohSIRobBAsMlO//Kk4soosy1JSFRYWaLC4qZBYWFRGZdwqKiwkNBVmoWFSJkWFxX4FFRQWR+LsS4W/rFRb/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////VEFHAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAU291bmRib3kuZGUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMjAwNGh0dHA6Ly93d3cuc291bmRib3kuZGUAAAAAAAAAACU=");
    snd.play();
}

// Esegui le operazioni prima di caricare il controller
lendinara.run(function($rootScope, eventiService) {
    // Carica tendina eventi e relativi dati
    eventiService.get().success(function(data) {
        $rootScope.eventi = data;
    })
});

lendinara.controller('IscrizioneGaraCtrl', ['$scope', '$timeout', 'iscrittiService', 'gareService', 'eventiService', 'testiService', 'mySharedService',
    function($scope, $timeout, iscrittiService, gareService, eventiService, testiService, sharedService) {
        $scope.classeStampa = 'hide';
        $scope.printable = 'unstamp';
        $scope.vuoi_stampare = false;
        $scope.numeri_doppi = false;
        $scope.getIscritti = function(val) {
            var nomi = [];
            return iscrittiService.query(val).then(function(res) {
                angular.forEach(res.data.risultato, function(item) {
                    nomi.push(item.nome);
                });
                return nomi;
            });
        };
        $scope.getCategoria = function(val) {
            var categorie = [];
            return gareService.getClassi($scope.selezionaEvento.nome, val).then(function(res) {
                angular.forEach(res.data.risultato, function(item) {
                    categorie.push(item.categoria);
                });
                return categorie;
            });
        };

        function getNumeriDisponibili() {
            var numeriOccupati = [];
            $scope.numeriDisponibili = [];
            if ($scope.selezionaEvento !== undefined) {
                gareService.getNumeri($scope.selezionaEvento).success(function(data) {
                    for (var i = 0; i < data.risultato.length; i++) {
                        numeriOccupati.push(data.risultato[i].numero);
                    };
                    var i = 2;
                    for (var i = 1; i <= 200; i++) {
                        if (numeriOccupati.indexOf(i.toString()) === -1) {
                            $scope.numeriDisponibili.push(i);
                        }
                    }
                });
            }
        }
        $scope.selezionato = function() {
            getNumeriDisponibili();
            eventiService.get($scope.selezionaEvento).success(function(data) {
                $scope.datievento = data;
                $scope.datievento.costo = parseFloat($scope.datievento.costo, 2);
            })
        };
        $scope.checkNumero = function() {
            if ($scope.selezionaEvento != undefined) {
                if ($scope.grandeNumero != 0) {
                    gareService.checkNumero($scope.grandeNumero, $scope.selezionaEvento.nome).success(function(data) {
                        if (data == false) {
                            $scope.numero_in_uso = true;
                        } else {
                            $scope.numero_in_uso = false;
                        }
                    })
                }
            }
        };
        getTesto = function(posizione) {
            testiService.getTesti(posizione).success(function(data) {
                $scope.testi = data;
                console.log($scope.testi);
            }).error(function(data) {
                console.log(data);
            })
        };
        $scope.checkIscritto = function(iscritto) {
            iscrittiService.get(iscritto).success(function(data) {
                // Necessario usando l'autocomplete
                if (data != 'false') {
                    sharedService.prepareBroadcast(iscritto);
                    // Controllo se la tessera enduro lendinara è valida
                    // Se la data non è presente errore
                    if (data.data_el) {
                        var tessera = new Date(data.data_el.substring(6, 10), data.data_el.substring(3, 5), data.data_el.substring(0, 2));
                        var current_year = new Date();
                        var lapse = timeLapse(tessera, current_year);
                        if (lapse > 365) {
                            $scope.errore1 = 'Attenzione, tessera El non valida ';
                            PlaySound();
                        } else {
                            $scope.errore1 = '';
                        }
                    } else {
                        $scope.errore1 = 'Attenzione, tessera El non valida ';
                        PlaySound();
                    }
                    // Controllo se il certificato medico è valido
                    if (data.scadenza) {
                        var scadenza = new Date(data.scadenza.substring(6, 10), data.scadenza.substring(3, 5), data.scadenza.substring(0, 2));
                        var current_year = new Date();
                        if (current_year > scadenza) {
                            $scope.errore1 = $scope.errore1 + 'Attenzione, certificato medico scaduto ';
                            PlaySound();
                        } else {
                            $scope.errore1 = '';
                        }
                    } else {
                        $scope.errore1 = 'Attenzione, certificato medico scaduto ';
                        PlaySound();
                    }
                }
            }).error(function(data) {});
        };
        $scope.iscrivi = function(iscritto) {
            if (iscritto != undefined && (iscritto.hasOwnProperty('nome') || iscritto.hasOwnProperty('nome1')) && $scope.grandeNumero) {
                iscritto.evento = $scope.selezionaEvento.nome;
                iscritto.grandeNumero = $scope.grandeNumero;
                if (!iscritto.hasOwnProperty('categoria')) {
                    iscritto.categoria = '';
                }
                if (!iscritto.hasOwnProperty('motoclub')) {
                    iscritto.motoclub = '';
                }
                if (!iscritto.hasOwnProperty('moto')) {
                    iscritto.moto = '';
                }
                if (!iscritto.hasOwnProperty('varie')) {
                    iscritto.varie = '';
                }
                if (iscritto.hasOwnProperty('nome1')) {
                    iscritto.nome = iscritto.nome1;
                }
                if (!iscritto.hasOwnProperty('nome2')) {
                    iscritto.nome2 = '';
                }
                if (!iscritto.hasOwnProperty('nome3')) {
                    iscritto.nome3 = '';
                }
                console.log(iscritto)
                gareService.post(iscritto, $scope.numeri_doppi).success(function(data) {
                    if (data == 'true') {
                        getNumeriDisponibili();
                        $scope.risultato = true;
                        $scope.messaggio = 'Concorrente iscritto con successo';
                        if ($scope.vuoi_stampare === true) {
                            $scope.printable = undefined;
                            var mediaQueryList = window.matchMedia('print');
                            getTesto('gara');
                            $scope.printable = '';
                            $scope.classeStampa = 'list-group';
                            $timeout(function() {
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
                    } else {
                        $scope.risultato = false;
                        $scope.messaggio = data;
                    }
                })
            } else {
                //$scope.iscritto.nome.$setDirty();
                //$scope.iscritto.grandeNumero.$setDirty();
                $scope.risultato = false;
                $scope.messaggio = 'Nome e numero sono obbligatori';
            }
        };
        $scope.reset = function(val) {
            $scope.errore1 = false;
            $scope.numeriDisponibili = "";
            $scope.numero_in_uso = false;
            $scope.grandeNumero = "";
            getNumeriDisponibili();
            if (val == 1) {
                $timeout(function() {
                    $scope.iscritto = {};
                    $scope.messaggio = "";
                    $scope.risultato = undefined;
                }, 2500);
            } else {
                $scope.messaggio = "";
                $scope.risultato = undefined;
            }
        };
    }
]);