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
        var doc = new jsPDF('p', 'mm', [50, 100]);
        doc.setFontSize(12);
        var start = 10;
        var barcodeOptions = {
                    format: "CODE128",
                    lineColor: "#000",
                    width:1,
                    height:50,
                    displayValue: false,
                    textMargin: 0
                };
        $scope.tesserati = function() {
            return iscrittiService.getIscritti().success(function(data) {
                $scope.iscritti = data.risultato;
                iscritti = data.risultato;
                console.log($scope.iscritti)
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
        }
        $scope.tesserati();
        $scope.filtraDate = function() {
            var tesserati = [];
            var arrayData = [];
            var datatessera;
            if ($scope.filtro.inizio) {
                var inizio = moment($scope.filtro.inizio, 'YYYY-MM-DD').valueOf();
                for (i = 0; i < $scope.iscritti.length; i++) {
                    if ($scope.iscritti[i].fields['Data emissione']) {
                        arrayData = $scope.iscritti[i].fields['Data emissione'].split('-');
                        datatessera = moment($scope.iscritti[i].fields['Data emissione'], "DD/MM/YYYY").valueOf();
                        // console.log(datatessera)
                        if (datatessera >= inizio) {
                            tesserati.push($scope.iscritti[i]);
                        }
                    }
                }
                $scope.iscritti = tesserati;
            }
            if ($scope.filtro.fine) {
                var fine = new Date($scope.filtro.fine);
                fine = fine.getTime();
                for (i = 0; i < $scope.iscritti.length; i++) {
                    if ($scope.iscritti[i].fields['Data emissione']) {
                        arrayData = $scope.iscritti[i].fields['Data emissione'].split('-');
                        datatessera = new Date(arrayData[2] + '-' + arrayData[1] + '-' + arrayData[0]);
                        datatessera = datatessera.getTime();
                        if (datatessera <= fine) {
                            tesserati.push($scope.iscritti[i]);
                        }
                    }
                }
                $scope.iscritti = tesserati;
            }
        };
        $scope.filtra = function() {
            var tesserati = [];
            console.log($scope.filtro.tesserati)
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

        function stampa(imgData, iscritto){
            doc.text(2, start, "ENDURO LENDINARA");
            doc.addImage(imgData, 'JPEG', 0, start + 6, 50, 20);
            doc.text(2, start + 35, iscritto.Cognome + ' ' + iscritto.Nome);
            doc.text(2, start + 45, 'Data di nascita:');
            doc.text(2, start + 50, iscritto.datanascita);
            doc.text(2, start + 60, 'Data di rilascio:');
            doc.text(2, start + 65, iscritto['Data emissione']);
            doc.text(2, start + 75, 'Qual. socio - Sport: Moto');
            doc.text(2, start + 80, 'Comitato provinciale: PD');
        };
        $scope.stampaTessere = function(){
            var imgData = '';
            for (var i = 0; i < $scope.iscritti.length; i++) {
                if($scope.iscritti[i].fields.barcode){
                    $("#barcode").JsBarcode($scope.iscritti[i].fields.barcode, barcodeOptions);
                    imgData = $('#barcode').attr('src');
                    stampa(imgData, $scope.iscritti[i].fields);
                    if(i != $scope.iscritti.length -1 ){
                        doc.addPage();
                    }
                }else{
                    var text = "";
                    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
                    for (var j = 0; j < 4; j++) {
                        text += possible.charAt(Math.floor(Math.random() * possible.length));
                    }
                    iscrittiService.updateField('iscritti', 'barcode', text, 'id', $scope.iscritti[i].fields.id);
                    $("#barcode").JsBarcode(text, barcodeOptions);
                    imgData = $('#barcode').attr('src');
                    stampa(imgData, $scope.iscritti[i].fields);
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
            ipCookie('iscritto', row.getProperty("fields['Cognome']") + ' ' + row.getProperty("fields['Nome']"))
            window.open("modulo.php");
        };
        $scope.$on('ngGridEventEndCellEdit', function(evt) {
            tessereService.update(evt.targetScope.row.entity.fields).success(function(data) {
                console.log(data)
            });
            console.log(evt.targetScope.row.entity.fields); // the underlying data bound to the row
            // Detect changes and send entity to server 
        });
        $scope.gridOptions = {
            data: 'iscritti',
            selectedItems: $scope.mySelections,
            enableCellEditOnFocus: true,
            columnDefs: [{
                    field: "fields['Cognome']",
                    displayName: 'Cognome',
                    cellTemplate: '<div  ng-click="vaiAModulo(row)" ng-bind="row.getProperty(col.field)"></div>'
                }, {
                    field: "fields['Nome']",
                    displayName: 'Nome',
                    cellTemplate: '<div  ng-click="vaiAModulo(row)" ng-bind="row.getProperty(col.field)"></div>'
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