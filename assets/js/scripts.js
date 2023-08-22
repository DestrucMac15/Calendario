$(document).ready(function(){

    const ruta = $('body').data('ruta');

    $('.btnAgregar').click(function(event){

        event.preventDefault();

        $('#modalAgregar').modal('show');

    });

    $('input[name="daterange"]').daterangepicker({
        opens: 'left',
        "locale": {
            "format": "YYYY-MM-DD",
            "separator": " - ",
            "applyLabel": "Guardar",
            "cancelLabel": "Cancelar",
            "fromLabel": "Desde",
            "toLabel": "Hasta",
            "customRangeLabel": "Personalizar",
            "daysOfWeek": [
                "Do",
                "Lu",
                "Ma",
                "Mi",
                "Ju",
                "Vi",
                "Sa"
        ],
        "monthNames": [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Setiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ],
        "firstDay": 1
    },
    }, function(start, end, label) {
        //console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        $(location).attr('href', ruta+'?inicio='+start.format('YYYY-MM-DD')+'&final='+ end.format('YYYY-MM-DD'));
    });

    $('#form_filtro').submit(function(event){
        event.preventDefault();
    });
});