var CFisc = {}
CFisc.tavola_mesi = ['A', 'B', 'C', 'D', 'E', 'H', 'L', 'M', 'P', 'R', 'S', 'T']
CFisc.tavola_omocodie = ['L', 'M', 'N', 'P', 'Q', 'R', 'S', 'T', 'U', 'V']
CFisc.tavola_carattere_di_controllo_valore_caratteri_dispari = {
    0: 1,
    1: 0,
    2: 5,
    3: 7,
    4: 9,
    5: 13,
    6: 15,
    7: 17,
    8: 19,
    9: 21,
    A: 1,
    B: 0,
    C: 5,
    D: 7,
    E: 9,
    F: 13,
    G: 15,
    H: 17,
    I: 19,
    J: 21,
    K: 2,
    L: 4,
    M: 18,
    N: 20,
    O: 11,
    P: 3,
    Q: 6,
    R: 8,
    S: 12,
    T: 14,
    U: 16,
    V: 10,
    W: 22,
    X: 25,
    Y: 24,
    Z: 23
}
CFisc.tavola_carattere_di_controllo_valore_caratteri_pari = {
    0: 0,
    1: 1,
    2: 2,
    3: 3,
    4: 4,
    5: 5,
    6: 6,
    7: 7,
    8: 8,
    9: 9,
    A: 0,
    B: 1,
    C: 2,
    D: 3,
    E: 4,
    F: 5,
    G: 6,
    H: 7,
    I: 8,
    J: 9,
    K: 10,
    L: 11,
    M: 12,
    N: 13,
    O: 14,
    P: 15,
    Q: 16,
    R: 17,
    S: 18,
    T: 19,
    U: 20,
    V: 21,
    W: 22,
    X: 23,
    Y: 24,
    Z: 25
}
CFisc.tavola_carattere_di_controllo = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"
CFisc.calcola_carattere_di_controllo = function(codice_fiscale) {
    var i, val = 0
    for (i = 0; i < 15; i++) {
        var c = codice_fiscale[i]
        if (i % 2) val += this.tavola_carattere_di_controllo_valore_caratteri_pari[c]
        else val += this.tavola_carattere_di_controllo_valore_caratteri_dispari[c]
    }
    val = val % 26
    return this.tavola_carattere_di_controllo.charAt(val)
}
CFisc.affronta_omocodia = function(codice_fiscale, numero_omocodia) {
    // non funziona
    var cifre_disponibili = [14, 13, 12, 10, 9, 7, 6]
    var cifre_da_cambiare = []
    while (numero_omocodia > 0 && cifre_disponibili.length) {
        var i = numero_omocodia % cifre_disponibili.length
        numero_omocodia = Math.floor(numero_omocodia / cifre_disponibili.length)
        cifre_da_cambiare.push(cifre_disponibili.splice(i - 1, 1)[0])
    }
}
CFisc.ottieni_consonanti = function(str) {
    return str.replace(/[^BCDFGHJKLMNPQRSTVWXYZ]/gi, '')
}
CFisc.ottieni_vocali = function(str) {
    return str.replace(/[^AEIOU]/gi, '')
}
CFisc.calcola_codice_cognome = function(cognome) {
    var codice_cognome = this.ottieni_consonanti(cognome)
    codice_cognome += this.ottieni_vocali(cognome)
    codice_cognome += 'XXX'
    codice_cognome = codice_cognome.substr(0, 3)
    return codice_cognome.toUpperCase()
}
CFisc.calcola_codice_nome = function(nome) {
    var codice_nome = this.ottieni_consonanti(nome)
    if (codice_nome.length >= 4) {
        codice_nome = codice_nome.charAt(0) + codice_nome.charAt(2) + codice_nome.charAt(3)
    } else {
        codice_nome += this.ottieni_vocali(nome)
        codice_nome += 'XXX'
        codice_nome = codice_nome.substr(0, 3)
    }
    return codice_nome.toUpperCase()
}
CFisc.calcola_codice_data = function(gg, mm, aa, sesso) {
    var d = new Date()
    d.setYear(aa);
    d.setMonth(mm - 1);
    d.setDate(gg);
    var anno = "0" + d.getFullYear()
    anno = anno.substr(anno.length - 2, 2);
    var mese = this.tavola_mesi[d.getMonth()]
    var giorno = d.getDate()
    if (sesso.toUpperCase() == 'F') giorno += 40;
    giorno = "0" + giorno
    giorno = giorno.substr(giorno.length - 2, 2);
    return "" + anno + mese + giorno
}
CFisc.trova_comune = function(pattern_comune) {
    var codice, comune, ret = []
    var quoted = pattern_comune.replace(/([\\\.\+\*\?\[\^\]\$\(\)\{\}\=\!\<\>\|\:])/g, "\\$1");
    var re = new RegExp(quoted, 'i')
    for (codice in this.codici_catastali) {
        comune = this.codici_catastali[codice]
        if (comune.match(re)) ret.push([comune, codice])
    }
    return ret
}
CFisc.calcola_codice_comune = function(pattern_comune) {
    if (pattern_comune.match(/^[A-Z]\d\d\d$/i)) return pattern_comune;
    if (this.trova_comune(pattern_comune).length === 0) {
        alert('Impossibile calcolare codice fiscale');
    }
    return this.trova_comune(pattern_comune)[0][1];
}
CFisc.calcola_codice = function(nome, cognome, sesso, giorno, mese, anno, luogo) {
    console.log(CFisc.codici_catastali)
    var codice = this.calcola_codice_cognome(cognome) + this.calcola_codice_nome(nome) + this.calcola_codice_data(giorno, mese, anno, sesso) + this.calcola_codice_comune(luogo)
    codice += this.calcola_carattere_di_controllo(codice)
    return codice
}

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
/**
    Execute the operation before load controller
*/
lendinara.run(function($rootScope, $http, eventiService) {
    // Carica tendina eventi e relativi dati
    eventiService.get().success(function(data) {
        $rootScope.eventi = data;
    })
});
lendinara.controller('IscrizioneGaraCtrl', ['$scope', '$http', '$timeout', 'iscrittiService', 'eventiService', 'mySharedService',
    function($scope, $http, $timeout, iscrittiService, eventiService, sharedService) {
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
            return eventiService.getClassi($scope.selezionaEvento.nome, val).then(function(res) {
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
                eventiService.getNumeri($scope.selezionaEvento).success(function(data) {
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
                    $http({
                        url: 'controllo_numero.php',
                        method: 'GET',
                        params: {
                            numero: $scope.grandeNumero,
                            evento: $scope.selezionaEvento.nome
                        }
                    }).success(function(data) {
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
            $http({
                url: 'ricerca_testi.php',
                method: 'GET',
                params: {
                    tipo: posizione
                }
            }).success(function(data) {
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
                $http({
                    url: 'iscrivi_concorrente.php',
                    method: 'GET',
                    params: {
                        iscritto: iscritto,
                        doppioni: $scope.numeri_doppi
                    }
                }).success(function(data) {
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
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
lendinara.controller('IscrizioneLendinaraCtrl', ['$scope', '$http', '$timeout', '$rootScope', 'iscrittiService', 'mySharedService',
    function($scope, $http, $timeout, $rootScope, iscrittiService, sharedService) {
        $http.get('files/city.json').then(function(res) {
            $scope.cities = res.data;
        });
        $http.get('files/codiciCatastali.json').then(function(res) {
            CFisc.codici_catastali = res.data[0];
        });
        $scope.$on('handleBroadcast', function() {
            $scope.loadData(sharedService.iscritto);
        });
        $scope.stato = 'Mostra';
        $scope.classeStampa = 'hide';
        $scope.printable = 'unstamp';
        $scope.id = undefined;
        $scope.nuovoIscritto = undefined;
        $scope.iscritto = {};
        $scope.iscritto.sesso = 'M';
        $scope.getCommonVarie = function(val) {
            return $http.get('listaCommonVarie.php', {
                params: {
                    nome: val
                }
            }).then(function(res) {
                var varie = [];
                angular.forEach(res.data.risultato, function(item) {
                    if (item !== '0' && item !== '') {
                        varie.push(item);
                    }
                });
                return varie;
            });
        };
        $scope.findCap = function() {
            for (var i = 0; i < $scope.cities.length; i++) {
                if ($scope.cities[i].comune === $scope.iscritto.citta) {
                    $scope.iscritto.cap = $scope.cities[i].cap;
                }
            };
        };
        $scope.getIscritti = function(val) {
            return $http.get('listaNomi.php', {
                params: {
                    nome: val
                }
            }).then(function(res) {
                var nomi = [];
                angular.forEach(res.data.risultato, function(item) {
                    nomi.push(item.nome);
                });
                return nomi;
            });
        };
        $scope.calcolaCodiceFiscale = function() {
            var sesso = $scope.iscritto.sesso;
            var nome = $scope.iscritto.nome.split(" ");
            var data = $scope.iscritto.datanascita.split("-");
            $scope.iscritto.codicefiscale = CFisc.calcola_codice(nome[1], nome[0], sesso, data[2], data[1], data[0], $scope.iscritto.luogonascita);
        }
        $scope.loadData = function(val) {
            iscrittiService.get(val).then(function(res) {
                var data = res.data;
                console.log(data)
                if (data == 'false') {
                    $scope.nuovoIscritto = true;
                } else {
                    $scope.nuovoIscritto = false;
                    $scope.id = data.id;
                    $scope.iscritto = data;
                    $scope.iscritto.cap = parseFloat($scope.iscritto.cap, 2);
                    $scope.iscritto.sesso = 'M';
                    //Verifico se il certificato è scaduto
                    var oggi = new Date();
                    var scadenza = new Date($scope.iscritto.scadenza);
                    if (scadenza.setHours(0, 0, 0, 0) <= oggi.setHours(0, 0, 0, 0)) {
                        $scope.risultato = false;
                        $scope.messaggio = 'ATTENZIONE: Certificato medico scaduto';
                    }
                }
            })
        };
        $scope.reset = function(val) {
            $scope.iscritto = {};
            if (val == 1) {
                $timeout(function() {
                    $scope.messaggio = "";
                    $scope.risultato = undefined;
                }, 2500);
            } else {
                $scope.messaggio = "";
                $scope.risultato = undefined;
            }
        };
        controlloMinorenni = function(iscritto) {
            var datanascita = new Date(iscritto.datanascita);
            var ageDifMs = Date.now() - datanascita.getTime();
            var ageDate = new Date(ageDifMs); // miliseconds from epoch
            var anni = Math.abs(ageDate.getUTCFullYear() - 1970);
            if (anni < 1 || anni > 90) {
                alert("Non puoi avere " + anni + " anni!");
            } else {
                if (anni < 18) {
                    if (confirm("L'utente ha " + anni + " anni, far firmare consenso genitori?")) {
                        window.open("minore.php?nominativo=" + iscritto.nome + "&datanascita=" + iscritto.datanascita + "&luogonascita=" + iscritto.luogonascita + "&citta=" + iscritto.citta + "&via=" + iscritto.via);
                    }
                }
            }
        };
        getTesto2 = function(posizione) {
            $http({
                url: 'ricerca_testi.php',
                method: 'GET',
                params: {
                    tipo: posizione
                }
            }).success(function(data) {
                $scope.testi = data;
                console.log($scope.testi);
            })
        };
        $scope.stampa = function() {
            if (!$scope.nuovoIscritto) {
                $scope.salva($scope.iscritto, 'modifica');
            }
            getTesto2('tesseramento');
            var mediaQueryList2 = window.matchMedia('print');
            $scope.printable = '';
            $scope.classeStampa = 'list-group';
            $timeout(function() {
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
        $scope.salva = function(iscritto, tipo) {
            iscritto.funzione = tipo;
            if (!iscritto.hasOwnProperty('luogonascita')) {
                iscritto.luogonascita = '';
            }
            if (!iscritto.hasOwnProperty('datanascita')) {
                iscritto.datanascita = '';
            }
            if (!iscritto.hasOwnProperty('citta')) {
                iscritto.citta = '';
            }
            if (!iscritto.hasOwnProperty('via')) {
                iscritto.via = '';
            }
            if (!iscritto.hasOwnProperty('email')) {
                iscritto.email = '';
            }
            if (!iscritto.hasOwnProperty('telefono')) {
                iscritto.telefono = '';
            }
            if (!iscritto.hasOwnProperty('scadenza')) {
                iscritto.scadenza = '';
            }
            if (!iscritto.hasOwnProperty('varie')) {
                iscritto.varie = '';
            }
            if (!iscritto.hasOwnProperty('cap')) {
                iscritto.cap = '';
            }
            if (!iscritto.hasOwnProperty('codicefiscale')) {
                iscritto.codicefiscale = '';
            }
            if (!iscritto.hasOwnProperty('tessera_el')) {
                iscritto.tessera_el = '';
            }
            if (!iscritto.hasOwnProperty('data_el')) {
                iscritto.data_el = '';
            }
            if (!iscritto.hasOwnProperty('tessera_csen')) {
                iscritto.tessera_csen = '';
            }
            if (!iscritto.hasOwnProperty('data_csen')) {
                iscritto.data_csen = '';
            }
            if (!iscritto.hasOwnProperty('tessera_fmi')) {
                iscritto.tessera_fmi = '';
            }
            if (!iscritto.hasOwnProperty('data_fmi')) {
                iscritto.data_fmi = '';
            }
            if (!iscritto.hasOwnProperty('tessera_sport')) {
                iscritto.tessera_sport = '';
            }
            if (!iscritto.hasOwnProperty('data_sport')) {
                iscritto.data_sport = '';
            }
            if (!iscritto.hasOwnProperty('licenza')) {
                iscritto.licenza = '';
            }
            if (!iscritto.hasOwnProperty('data_licenza')) {
                iscritto.data_licenza = '';
            }
            iscritto.nome = iscritto.nome.toUpperCase();
            iscritto.via = iscritto.via.toUpperCase();
            iscritto.luogonascita = iscritto.luogonascita.toUpperCase();
            iscritto.citta = iscritto.citta.toUpperCase();
            iscritto.varie = iscritto.varie.toUpperCase();
            iscritto.codicefiscale = iscritto.codicefiscale.toUpperCase();
            controlloMinorenni(iscritto);
            $http({
                url: 'iscrivi.php',
                method: 'GET',
                params: {
                    iscritto: $scope.iscritto
                }
            }).success(function(data) {
                if (data == 'true') {
                    $scope.risultato = true;
                    if (tipo == 'salva') {
                        $scope.messaggio = iscritto.nome + ' è stato iscritto con successo';
                        $scope.stampa();
                    } else {
                        $scope.messaggio = iscritto.nome + ' è stato modificato con successo';
                        //$scope.reset(1);
                    }
                } else {
                    console.log(data)
                    $scope.risultato = false;
                    $scope.messaggio = data;
                }
            })
        }
        $scope.elimina = function(iscritto) {
            if (confirm('Sicuro di voler eliminare ' + iscritto.nome + '? Tutti i dati andranno persi')) {
                iscrittiService.del($scope.id).success(function(data) {
                    console.log(data);
                    if (data == 'true') {
                        $scope.risultato = true;
                        $scope.messaggio = iscritto.nome + ' eliminato con successo';
                        location.reload();
                    } else {
                        $scope.risultato = false;
                        $scope.messaggio = data;
                    }
                })
            }
        }
        $scope.gestioneTessere = function() {
            if ($scope.stato == 'Mostra') {
                $scope.stato = 'Nascondi';
            } else {
                $scope.stato = 'Mostra';
            }
        }
    }
]);