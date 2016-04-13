function JSONToCSVConvertor(e, r, t) {
    var a = "object" != typeof e ? JSON.parse(e) : e,
        n = "";
    if (n += r + "\r\n\n", t) {
        var o = "";
        for (var i in a[0]) o += i + ";";
        o = o.slice(0, -1), n += o + "\r\n"
    }
    for (var c = 0; c < a.length; c++) {
        var o = "";
        for (var i in a[c]) o += '"' + a[c][i] + '";';
        o.slice(0, o.length - 1), n += o + "\r\n"
    }
    if ("" == n) return void alert("Invalid data");
    var d = "Elenco iscritto ";
    d += r.replace(/ /g, "_");
    var l = "data:text/csv;charset=utf-8," + escape(n),
        v = document.createElement("a");
    v.href = l, v.style = "visibility:hidden", v.download = d + ".csv", document.body.appendChild(v), v.click(), document.body.removeChild(v)
}
lendinara.directive("ngFileSelect", function() {
    return {
        link: function($scope, el) {
            el.bind("change", function(e) {
                $scope.file = (e.srcElement || e.target).files[0];
                $scope.getFile();
            })
        }
    }
})
lendinara.controller('stampaIscritti', ['$scope', '$http', '$location', 'gareService', function($scope, $http, $location, gareService) {
    $scope.deleteColumn = function(indice) {
        $scope.properties.splice(indice, 1);
    };
    var parametro = $location.search()['evento'];
    $scope.evento = parametro;
    $scope.predicato = 'numero';
    $scope.reverse = false;
    $scope.condizione_modifica = "Modifica";
    $scope.modifica_attiva = false;
    getIscritti();
    $scope.modifica = function() {
        if ($scope.modifica_attiva == false) {
            $scope.modifica_attiva = true;
            $scope.condizione_modifica = "Salva";
        } else {
            $scope.modifica_attiva = false;
            $scope.condizione_modifica = "Modifica";
            $http({
                url: 'salva_iscritti.php',
                method: 'GET',
                params: {
                    iscritti: JSON.stringify($scope.iscritti),
                    evento: $scope.evento
                }
            }).success(function(data) {
                console.log(data);
            }).error(function(data) {
                console.log(data);
            });
        }
    }
    $scope.elimina = function(iscritto) {
        gareService.delete(iscritto.nome, iscritto.numero, $scope.evento).success(function(data) {
            if (data === '1') {
                getIscritti();
            }
        });
    }
    $scope.ordina_colonne = function(property, ordine) {
        $scope.predicato = property;
        $scope.reverse = !$scope.reverse;
    }
    $scope.moveColumn = function(direzione, indice) {
        var appoggio;
        if (direzione === 'dx') {
            if (indice < $scope.properties.length - 1) {
                appoggio = $scope.properties[indice + 1];
                $scope.properties[indice + 1] = $scope.properties[indice];
                $scope.properties[indice] = appoggio;
            }
        } else {
            if (indice > 0) {
                appoggio = $scope.properties[indice - 1];
                $scope.properties[indice - 1] = $scope.properties[indice];
                $scope.properties[indice] = appoggio;
            }
        }
    }

    function getIscritti() {
        gareService.getIscritti(parametro).success(function(data) {
            $scope.numero_iscritti = data.length;
            $scope.iscritti = data;
            $scope.properties = Object.keys(data[0]);
        }).error(function(data) {
            console.log(data);
        });
    }
    $scope.formato = 'csv';
    $scope.esporta = function() {
        JSONToCSVConvertor($scope.iscritti, "Iscritti gara ", true);
    };
    $scope.stampa = function() {
        window.print();
    };
    // $scope.getFile = function() {
    //     $scope.progress = 0;
    //     fileReader.readAsDataUrl($scope.file, $scope).then(function(result) {
    //         console.log(result)
    //         $scope.imageSrc = result;
    //     });
    // };
}]);