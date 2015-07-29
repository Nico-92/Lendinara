function JSONToCSVConvertor(JSONData, ReportTitle, ShowLabel) {
    //If JSONData is not an object then JSON.parse will parse the JSON string in an Object
    var arrData = typeof JSONData != 'object' ? JSON.parse(JSONData) : JSONData;
    var CSV = '';
    //Set Report title in first row or line
    CSV += ReportTitle + '\r\n\n';
    //This condition will generate the Label/Header
    if (ShowLabel) {
        var row = "";
        //This loop will extract the label from 1st index of on array
        for (var index in arrData[0]) {
            //Now convert each value to string and comma-seprated
            row += index + ',';
        }
        row = row.slice(0, -1);
        //append Label row with line break
        CSV += row + '\r\n';
    }
    //1st loop is to extract each row
    for (var i = 0; i < arrData.length; i++) {
        var row = "";
        //2nd loop will extract each column and convert it in string comma-seprated
        for (var index in arrData[i]) {
            row += '"' + arrData[i][index] + '",';
        }
        row.slice(0, row.length - 1);
       //add a line break after each row
        CSV += row + '\r\n';
    }
    if (CSV == '') {
        alert("Invalid data");
        return;
    }
    //Generate a file name
    var fileName = "MyReport_";
    //this will remove the blank-spaces from the title and replace it with an underscore
    fileName += ReportTitle.replace(/ /g, "_");
    //Initialize file format you want csv or xls
    var uri = 'data:text/csv;charset=utf-8,' + escape(CSV);
    // Now the little tricky part.
    // you can use either>> window.open(uri);
    // but this will not work in some browsers
    // or you will not get the correct file extension    
    //this trick will generate a temp <a /> tag
    var link = document.createElement("a");
    link.href = uri;
    //set the visibility hidden so it will not effect on your web-layout
    link.style = "visibility:hidden";
    link.download = fileName + ".csv";
    //this part will append the anchor tag and remove it after automatic click
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

angular.module('riassuntoControllers').controller('RiassuntoIscrittiCtrl', ['$scope', '$http', '$rootScope', 'tesseratiService',
    function($scope, $http, $rootScope, tesseratiService) {
        $scope.tesserati = function() {
            return tesseratiService.query()
                .success(function(data) {
                    $scope.iscritti = data.risultato;
                });
        }
        $scope.esporta = function() {
            JSONToCSVConvertor($scope.iscritti, "Iscritti lendinara", true);
        }
        $scope.tesserati();
        $scope.filtraDate = function() {
            var tesserati = [];
            if ($scope.filtro.inizio) {
                var inizio = new Date($scope.filtro.inizio);
                inizio = inizio.getTime();
                console.log($scope.filtro.inizio + ' ' + inizio)
                var datatessera;
                var arrayData = [];
                for (i = 0; i < $scope.iscritti.length; i++) {
                    if ($scope.iscritti[i].data) {
                        arrayData = $scope.iscritti[i].data.split('-');
                        datatessera = new Date(arrayData[2] + '-' + arrayData[1] + '-' + arrayData[0]);
                        datatessera = datatessera.getTime();
                        console.log($scope.iscritti[i].nome + ' ' + $scope.iscritti[i].data + ' ' + datatessera)
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
                var datatessera;
                var arrayData = [];
                for (i = 0; i < $scope.iscritti.length; i++) {
                    if ($scope.iscritti[i].data) {
                        arrayData = $scope.iscritti[i].data.split('-');
                        datatessera = new Date(arrayData[2] + '-' + arrayData[1] + '-' + arrayData[0]);
                        datatessera = datatessera.getTime();
                        if (datatessera <= fine) {
                            tesserati.push($scope.iscritti[i]);
                        }
                    }
                }
                $scope.iscritti = tesserati;
            }
        }
        $scope.filtra = function() {
            var tesserati = [];
            if ($scope.filtro.tesserati) {
                for (i = 0; i < $scope.iscritti.length; i++) {
                    if ($scope.iscritti[i].tessera != '') {
                        tesserati.push($scope.iscritti[i]);
                    }
                }
                $scope.iscritti = tesserati;
            } else {
                $scope.tesserati();
            }
        }
        $scope.gridOptions = {
            data: 'iscritti',
            columnDefs: [{
                field: 'nome',
                displayName: 'Nome e cognome'
            }, {
                field: 'datanascita',
                displayName: 'Data nascita'
            }, {
                field: 'luogonascita',
                displayName: 'Luogo nascita'
            }, {
                field: 'tessera',
                displayName: 'Tessera'
            }, {
                field: 'data',
                displayName: 'Data di rilascio'
            }, {
                field: 'telefono',
                displayName: 'Telefono'
            }, {
                field: 'email',
                displayName: 'Email'
            }]
        };

    }
]);