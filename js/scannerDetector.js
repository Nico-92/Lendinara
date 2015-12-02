jQuery(document).ready(function($) {
    $(window).scannerDetection();
    $(window).bind('scannerDetectionComplete', function(e, data) {
            $.ajax({
                url: 'backend/iscritti/ricerca_codice_barre.php',
                methos: 'GET',
                data: {
                    codice: data.string
                }
            }).done(function(nome) {
                jQuery('#nominativoGara').val(nome);
                jQuery('#nominativoGara').trigger('input');
            });
        }).bind('scannerDetectionError', function(e, data) {
            $.ajax({
                url: 'backend/iscritti/ricerca_codice_barre.php',
                methos: 'GET',
                data: {
                    codice: data.string
                }
            }).done(function(nome) {
                if (nome.indexOf('Warning') === -1) {
                    jQuery('#nominativoGara').val(nome);
                    jQuery('#nominativoGara').trigger('input');
                }
            });
        })
        /*.bind('scannerDetectionReceive', function(e, data) {
                console.log(data);
            })*/
});