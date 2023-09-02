$(document).ready(function(){

    const ruta = $('body').data('ruta');

    $('.btnAgregar').click(function(event){

        event.preventDefault();

        $('#formCalendario')[0].reset();

        $('#modalAgregar').modal('show');

    });

    $('.btnAsignar').click(function(event){

        event.preventDefault();

        $('#formCalendario')[0].reset();

        $('#desarrollo').val($(this).data('desarrollo'));
        $('#fecha').val($(this).data('fecha'));

        $('#modalAgregar').modal('show');

    });

    $('.btnEditar').click(function(event){

        event.preventDefault();

        $('#formCalendario')[0].reset();

        $('#id').val($(this).data('id'));
        $('#desarrollo').val($(this).data('desarrollo'));
        $('#fecha').val($(this).data('fecha'));
        $('#vendedor').val($(this).data('vendedor'));
        $('#tipo').val($(this).data('tipo'));
        $('#observaciones').val($(this).data('observaciones'));

        $('#modalAgregar').modal('show');

    });

    $('#formCalendario').submit(function(event){

        event.preventDefault();

        let data = $(this).serialize();

        $.ajax({
            url: ruta+'calendario/save',
            method: 'POST',
            dataType: 'JSON',
            data: data
        }).done(function(respuesta){

            if(respuesta.estatus){

            }else{

                iziToast.error({
                    title: 'Atención!',
                    message: 'Error al guardar.',
                });

            }

        });

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
        
        $(location).attr('href', ruta+'?inicio='+start.format('YYYY-MM-DD')+'&final='+ end.format('YYYY-MM-DD'));
    });

    $('#formFiltro').submit(function(event){

        event.preventDefault();

        let date_range = $('#daterange').val();

        let dates = date_range.split(" - ");

        let inicio = dates[0];
        let final = dates[1];
        let desarrollo = $('#filtro_desarrollo').val();
        let vendedor = $('#filtro_vendedor').val();

        if(desarrollo == "" && vendedor == ""){

            $(location).attr('href', ruta+'?inicio='+inicio+'&final='+final);

        }else if (desarrollo != "" && vendedor == "") {

            $(location).attr('href', ruta+'?inicio='+inicio+'&final='+final+'&desarrollo='+desarrollo);
            
        }else if (desarrollo == "" && vendedor != "") {

            $(location).attr('href', ruta+'?inicio='+inicio+'&final='+final+'&vendedor='+vendedor);

        } else if (desarrollo != "" && vendedor != "") {

            $(location).attr('href', ruta+'?inicio='+inicio+'&final='+final+'&desarrollo='+desarrollo+'&vendedor='+vendedor);

        }





    });
});