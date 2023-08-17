<div class="container-fluid my-5">
    <div class="row my-2">
        <div class="col-md-8">
            <form>
                <div class="form row">
                    <div class="col ">
                        <select class="form-control">
                            <option value="">Selecciona un Vendedor</option>
                        </select>
                    </div>
                    <div class="col ">
                        <select class="form-control">
                            <option value="">Selecciona un Desarrollo</option>
                        </select>
                    </div>
                    <div class="col">
                        <input type="text" name="daterange" class="form-control" value="" />
                    </div>
                    <button type="submit" class="btn btn-success">Filtrar</button>
                </div>
            </form>
        </div>
        <div class="col-md-4 d-flex justify-content-end">
            <button class="btn btn-secondary mx-2">Exportar</button>
            <button class="btn btn-success mx-2">Asociar</button>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function(){
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
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });

</script>