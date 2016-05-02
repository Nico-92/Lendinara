function JSONToCSVConvertor(e, r, t) {
    for (var i = 0; i < e.length; i++) {
        delete e[i].fields.id;
        e[i].fields['Nome cane'] = '';
        e[i].fields['Razza cane'] = '';
        e[i].fields['Microchip / tatuaggio'] = '';
        e[i].fields['Cod.Aff.Societa'] = '30119';
        e[i] = e[i].fields;
    }
    var a = "object" != typeof e ? JSON.parse(e) : e,
        n = "";
    if (n += r, t) {
        var o = "";
        for (var i in a[0]) o += i + ";";
        o = o.slice(0, -1), n += o + "\r\n";
    }
    for (var c = 0; c < a.length; c++) {
        var o = "";
        for (var i in a[c]) o += a[c][i] + ';';
        o.slice(0, o.length - 1), n += o + "\r\n";
    }
    if ("" == n) return void alert("Invalid data");
    var d = "Elenco iscritto ";
    d += r.replace(/ /g, "_");
    var l = "data:text/csv;charset=utf-8," + escape(n),
        v = document.createElement("a");
    v.href = l, v.style = "visibility:hidden", v.download = d + ".csv", document.body.appendChild(v), v.click(), document.body.removeChild(v);
}
lendinara.controller('RiassuntoIscrittiCtrl', ['$scope', '$http', '$rootScope', 'iscrittiService', 'ipCookie', 'tessereService',
    function($scope, $http, $rootScope, iscrittiService, ipCookie, tessereService) {
        $scope.showMore = false;
        $scope.filtro = {};
        $scope.filtro.tipoTessere = {
            lendinara: true,
            csen: true,
            nonTesserati: true
        };
        $scope.filtro.inizio = moment("2010-01-01").format("YYYY-MM-DD");
        $scope.filtro.fine = moment().add(1, 'days').format("YYYY-MM-DD");
        var doc = new jsPDF('p', 'mm', [50, 100]);
        doc.setFontSize(12);
        var start = 10;
        var barcodeOptions = {
            format: "CODE128",
            lineColor: "#000",
            width: 1,
            height: 50,
            displayValue: false,
            textMargin: 0
        };
        $scope.tesserati = function() {
            $scope.erroreDate = false;
            return iscrittiService.getIscritti().success(function(data) {
                $scope.iscritti = data.risultato;
                iscritti = data.risultato;
            });
        };
        $scope.esporta = function() {
            JSONToCSVConvertor($scope.iscritti, "", true);
        };
        $scope.tesseratiOggi = function() {
            $scope.filtro.inizio = moment().format("YYYY-MM-DD");
            $scope.filtro.fine = moment().format("YYYY-MM-DD");
            $scope.filtraDate();
        };
        $scope.config = {
            title: '',
            tooltips: true,
            labels: false,
            mouseover: function() {},
            mouseout: function() {},
            click: function() {},
            legend: {
                display: true,
                //could be 'left, right'
                position: 'left'
            },
            innerRadius: 0, // applicable on pieCharts, can be a percentage like '50%'
            lineLegend: 'lineEnd' // can be also 'traditional'
        };
        $scope.tesserati();
        $scope.filtraDateDa = function() {
            var tesserati = [];
            if ($scope.filtro.inizio && moment($scope.filtro.inizio).isValid() && moment($scope.filtro.inizio, "YYYY-MM-DD").isBetween(moment("2009-12-31"), moment().format("YYYY-MM-DD"))) {
                for (i = 0; i < $scope.iscritti.length; i++) {
                    if ($scope.iscritti[i].fields['Data emissione']) {
                        if (moment($scope.iscritti[i].fields['Data emissione'], "DD/MM/YYYY").isAfter(moment($scope.filtro.inizio, 'YYYY-MM-DD'))) {
                            tesserati.push($scope.iscritti[i]);
                        }
                    }
                }
                $scope.iscritti = tesserati;
            } else {
                $scope.erroreDate = true;
            }
        };
        $scope.filtraDateA = function() {
            var tesserati = [];
            if ($scope.filtro.fine && moment($scope.filtro.fine).isValid() && moment($scope.filtro.fine, "YYYY-MM-DD").isAfter($scope.filtro.inizio, "YYYY-MM-DD")) {
                for (i = 0; i < $scope.iscritti.length; i++) {
                    if ($scope.iscritti[i].fields['Data emissione']) {
                        if (moment($scope.iscritti[i].fields['Data emissione'], "DD/MM/YYYY").isBefore(moment($scope.filtro.fine, 'YYYY-MM-DD'))) {
                            tesserati.push($scope.iscritti[i]);
                        }
                    }
                }
                $scope.iscritti = tesserati;
            } else {
                $scope.erroreDate = true;
            }
        };
        $scope.filtra = function() {
            var tesserati = [];
            if ($scope.filtro.tesserati) {
                for (i = 0; i < $scope.iscritti.length; i++) {
                    if ($scope.iscritti[i].tessera !== '') {
                        tesserati.push($scope.iscritti[i]);
                    }
                }
                $scope.iscritti = tesserati;
            } else {
                $scope.tesserati();
            }
        };
        //Genera pdf dell'etichetta tessera
        function stampa(imgData, iscritto) {
            doc.text(2, start, "ENDURO LENDINARA");
            doc.addImage(imgData, 'JPEG', 0, start + 6, 50, 20);
            doc.text(2, start + 35, iscritto.Cognome + ' ' + iscritto.Nome);
            doc.text(2, start + 45, 'Data di nascita:');
            doc.text(2, start + 50, iscritto.datanascita);
            doc.text(2, start + 60, 'Data di rilascio:');
            doc.text(2, start + 65, iscritto['Data emissione']);
            doc.text(2, start + 75, 'Qual. socio - Sport: Moto');
            doc.text(2, start + 80, 'Comitato provinciale: PD');
        }
        // Stampa l'etichetta della tessera di tutti gli iscritti nello scope.iscritti
        $scope.stampaTessere = function() {
            var imgData = '';
            for (var i = 0; i < $scope.iscritti.length; i++) {
                if ($scope.iscritti[i].fields.barcode) {
                    $("#barcode").JsBarcode($scope.iscritti[i].fields.barcode, barcodeOptions);
                    imgData = $('#barcode').attr('src');
                    stampa(imgData, $scope.iscritti[i].fields);
                    if (i < $scope.iscritti.length - 1) {
                        doc.addPage();
                    }
                } else {
                    var text = "";
                    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
                    for (var j = 0; j < 4; j++) {
                        text += possible.charAt(Math.floor(Math.random() * possible.length));
                    }
                    iscrittiService.updateField('iscritti', 'barcode', text, 'id', $scope.iscritti[i].fields.id);
                    $("#barcode").JsBarcode(text, barcodeOptions);
                    imgData = $('#barcode').attr('src');
                    stampa(imgData, $scope.iscritti[i].fields);
                    if (i < $scope.iscritti.length - 1) {
                        doc.addPage();
                    }
                }
            }
            doc.autoPrint();
            window.open(doc.output('bloburl'), '_blank');
        };

        function dateSort(dataUno, dataDue) {
            var arrayUno = dataUno.split('-');
            var arrayDue = dataDue.split('-');
            dataUno = new Date(arrayUno[2], arrayUno[1] - 1, arrayUno[0]);
            dataDue = new Date(arrayDue[2], arrayDue[1] - 1, arrayDue[0]);
            if (dataUno < dataDue) {
                return -1;
            } else if (dataUno > dataDue) {
                return 1;
            } else {
                return 0;
            }
        }
        $scope.resetFiltri = function() {
            $scope.filtro = {};
            $scope.filtro.fine = moment().add(1, 'days').format("YYYY-MM-DD");
            $scope.filtro.inizio = moment("2010-01-01").format("YYYY-MM-DD");
            $scope.erroreDate = false;
            $scope.iscritti = iscritti;
            $scope.filtro.tipoTessere = {
                lendinara: true,
                csen: true,
                nonTesserati: true
            };
        };
        $scope.cambiaTipoTessere = function() {
            var tesserati = [];
            if ($scope.filtro.tipoTessere.lendinara === true && $scope.filtro.tipoTessere.csen === true && $scope.filtro.tipoTessere.nonTesserati === true) {
                // Tutto
                $scope.iscritti = iscritti;
            } else {
                if ($scope.filtro.tipoTessere.lendinara === true) {
                    for (i = 0; i < $scope.iscritti.length; i++) {
                        if ($scope.iscritti[i].fields.Tipo === 'Lendinara') {
                            tesserati.push($scope.iscritti[i]);
                        }
                    }
                }
                if ($scope.filtro.tipoTessere.csen === true) {
                    for (i = 0; i < $scope.iscritti.length; i++) {
                        if ($scope.iscritti[i].fields.Tipo === 'csen') {
                            tesserati.push($scope.iscritti[i]);
                        }
                    }
                }
                if ($scope.filtro.tipoTessere.nonTesserati === true) {
                    for (i = 0; i < $scope.iscritti.length; i++) {
                        if ($scope.iscritti[i].fields.Tipo === '') {
                            tesserati.push($scope.iscritti[i]);
                        }
                    }
                }
                $scope.iscritti = tesserati;
            }
            if ($scope.filtro.tipoTessere.lendinara === false && $scope.filtro.tipoTessere.csen === false && $scope.filtro.tipoTessere.nonTesserati === false) {
                // Niente
                $scope.iscritti = [];
            }
        };
        $scope.vaiAModulo = function(row) {
            ipCookie('iscritto', row.getProperty("fields['Cognome']") + ' ' + row.getProperty("fields['Nome']", { path: '/' }));
            console.log(ipCookie('iscritto'))
            window.open("modulo.php");
        };
        $scope.$on('ngGridEventEndCellEdit', function(evt) {
            tessereService.update(evt.targetScope.row.entity.fields).success(function(data) {
                console.log(data);
            });
            console.log(evt.targetScope.row.entity.fields); // the underlying data bound to the row
            // Detect changes and send entity to server 
        });
        $scope.gridOptions = {
            data: 'iscritti',
            selectedItems: $scope.mySelections,
            enableCellEditOnFocus: false,
            columnDefs: [{
                    field: "fields['Cognome']",
                    displayName: 'Cognome',
                    cellTemplate: '<div  ng-click="vaiAModulo(row)" ng-bind="row.getProperty(col.field)"></div>',
                    enableCellEdit: false
                }, {
                    field: "fields['Nome']",
                    displayName: 'Nome',
                    cellTemplate: '<div  ng-click="vaiAModulo(row)" ng-bind="row.getProperty(col.field)"></div>',
                    enableCellEdit: false
                },
                /* {
                                field: 'datanascita',
                                displayName: 'Data nascita',
                                sortFn: dateSort
                            }, {
                                field: 'luogonascita',
                                displayName: 'Luogo nascita'
                            }, {
                                field: 'tessera',
                                displayName: 'Tessera'
                            }, {
                                field: 'data',
                                displayName: 'Data di rilascio',
                                sortFn: dateSort
                            }, {
                                field: 'telefono',
                                displayName: 'Telefono'
                            }, {
                                field: 'email',
                                displayName: 'Email'
                            }*/
                {
                    field: "fields['Codice fiscale']",
                    displayName: 'Codice fiscale',
                    enableCellEdit: false,
                }, {
                    field: "fields['Data emissione']",
                    displayName: 'Data Emissione',
                    sortFn: dateSort
                }, {
                    field: "fields['Data Scadenza']",
                    displayName: 'Data Scadenza'
                }, {
                    field: "fields['Tipo assicurazione']",
                    displayName: 'Tipo assicurazione'
                }, {
                    field: "fields['Numero Tessera']",
                    displayName: 'Numero Tessera'
                }
            ]
        };
    }
]);