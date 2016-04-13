lendinara.controller('tesseramentoCtrl', ['$scope', '$http', '$timeout', '$rootScope', 'iscrittiService', 'mySharedService', 'testiService', 'translationService', 'ipCookie',
    function($scope, $http, $timeout, $rootScope, iscrittiService, sharedService, testiService, translationService, ipCookie) {
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
        $scope.$on('translationBroadcast', function() {
            $scope.translation = translationService.translation;
        });
        $scope.iscritto.dataacconto = moment().format("YYYY-MM-DD");
        // Inzializzo tessera vuota
        $scope.tessere = [{
            tipo: 'Lendinara',
            tessera: '',
            assicurazione: 'Base',
            dataemissione: moment().format("YYYY-MM-DD"),
            datascadenza: moment().add(1, 'year').subtract(1, "days").format("YYYY-MM-DD")
        }];
        testiService.getOptions().success(function(data) {
            $scope.avanzatePresenti = false;
            for (var key in data) {
                if (data[key] === '1') {
                    data[key] = true;
                    $scope.avanzatePresenti = true;
                }
            }
            $scope.options = data;
            $scope.options.avanzate = true;
        });
        $scope.loadData = function(val) {
            iscrittiService.get(val).then(function(res) {
                var data = res.data;
                console.log(data)
                if (data == 'false') {
                    $scope.nuovoIscritto = true;
                } else {
                    $scope.tessere = [];
                    if (data.tessere.tessera !== '') {
                        if(data.tessere.datascadenza === ''){
                            data.tessere.datascadenza = moment(data.tessere.dataemissione).add(1, 'year').format("YYYY-MM-DD");
                        }
                        $scope.tessere.push(data.tessere);
                    } else {
                        $scope.tesseraMancante = true;
                        $scope.tessere = [{
                            tipo: 'Lendinara',
                            tessera: '',
                            assicurazione: 'Base',
                            dataemissione: moment().format("YYYY-MM-DD"),
                            datascadenza: moment().add(1, 'year').subtract(1, "days").format("YYYY-MM-DD")
                        }];
                    }
                    $scope.nuovoIscritto = false;
                    $scope.id = data.id;
                    $scope.iscritto = data;
                    $scope.iscritto.cap = parseFloat($scope.iscritto.cap, 2);
                    $scope.iscritto.sesso = 'M';
                    if ($scope.iscritto.dataacconto == '') {
                        $scope.iscritto.dataacconto = moment().format("YYYY-MM-DD");
                    }
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
         iscrittoCookie = ipCookie('iscritto');
        if (iscrittoCookie) {
            ipCookie.remove('iscritto');
            $scope.loadData(iscrittoCookie);
        }
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
            return iscrittiService.query(val).then(function(res) {
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
        
        $scope.reset = function(val) {
            $scope.iscritto = {};
            $scope.iscritto.dataacconto = moment().format("YYYY-MM-DD");
            $scope.tesseraMancante = false;
            if (val == 1) {
                $timeout(function() {
                    $scope.messaggio = "";
                    $scope.risultato = undefined;
                }, 2500);
            } else {
                $scope.messaggio = "";
                $scope.risultato = undefined;
            }
            $scope.tessere = [{
                tipo: 'Lendinara',
                tessera: '',
                assicurazione: 'Base',
                dataemissione: moment().format("YYYY-MM-DD"),
                datascadenza: moment().add(1, 'year').subtract(1, "days").format("YYYY-MM-DD")
            }];
            console.log($scope.tessere)
        };
        $scope.apriLiberatoria = function(iscritto) {
            window.open("minore.php?nominativo=" + iscritto.nome + "&datanascita=" + iscritto.datanascita + "&luogonascita=" + iscritto.luogonascita + "&citta=" + iscritto.citta + "&via=" + iscritto.via);
        }
        $scope.controlloMinorenni = function(iscritto, dom) {
            var datanascita = new Date(iscritto.datanascita);
            var ageDifMs = Date.now() - datanascita.getTime();
            var ageDate = new Date(ageDifMs); // miliseconds from epoch
            var anni = Math.abs(ageDate.getUTCFullYear() - 1970);
            if (!dom) {
                if (anni < 1 || anni > 90) {
                    alert("Non puoi avere " + anni + " anni!");
                } else {
                    if (anni < 18) {
                        if (confirm("L'utente ha " + anni + " anni, far firmare consenso genitori?")) {
                            $scope.apriLiberatoria(iscritto);
                        }
                    }
                }
            } else {
                if (anni < 18) {
                    return true;
                } else {
                    return false;
                }
            }
        };
        getTesto2 = function(posizione) {
            $http({
                url: 'backend/testi/ricerca_testi.php',
                method: 'GET',
                params: {
                    tipo: posizione
                }
            }).success(function(data) {
                $scope.blocco1 = data[0].testo;
                $scope.blocco2 = data[1].testo;
                console.log($scope.blocco2);
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
            if (!iscritto.hasOwnProperty('acconto')) {
                iscritto.acconto = '';
            }
            if (!iscritto.hasOwnProperty('dataacconto')) {
                iscritto.dataacconto = '';
            }
            if (!iscritto.hasOwnProperty('cauzione')) {
                iscritto.cauzione = '';
            }
            if (!iscritto.hasOwnProperty('datacauzione')) {
                iscritto.datacauzione = '';
            }
            if (!iscritto.hasOwnProperty('codicefiscale')) {
                iscritto.codicefiscale = '';
            }
            // if (!iscritto.hasOwnProperty('assicurazione')) {
            //     iscritto.assicurazione = 'Base';
            // }
            /* if (!iscritto.hasOwnProperty('tessera_el')) {
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
             }*/
            iscritto.nome = iscritto.nome.toUpperCase();
            iscritto.via = iscritto.via.toUpperCase();
            iscritto.luogonascita = iscritto.luogonascita.toUpperCase();
            iscritto.citta = iscritto.citta.toUpperCase();
            iscritto.varie = iscritto.varie.toUpperCase();
            iscritto.codicefiscale = iscritto.codicefiscale.toUpperCase();
            $scope.controlloMinorenni(iscritto, false);
            console.log($scope.tessere)
            iscrittiService.post(iscritto, $scope.tessere).success(function(data) {
                console.log(data)
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
        };
        $scope.aggiornaDataScadenza = function(){
             $scope.tessere[0].datascadenza =moment( $scope.tessere[0].dataemissione).add(1, 'year').subtract(1, "days").format("YYYY-MM-DD");
        }
    }
]);
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