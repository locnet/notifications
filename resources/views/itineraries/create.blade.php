@extends('layouts.app')
@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/anytime.css') }}" />
@endsection
@section('content')    
    <div class="col-md-10 col-xs-12 animated fadeIn">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="text-center">Crear nuevo itinerario</h3>
            </div>

            <div class="panel-body">
                {!! Form::open(array('url' => 'itineraries/store','method' => 'POST')) !!}
                    {{ csrf_field() }} 
                                                                                                                
                    <app-form-header old_title="{{ old('title') }}"
                                    old_return_flight="{{ old('return_flight') }}"
                                    old_departure_station="{{ old('departure_station') }}"
                                    old_arrival_station="{{ old('arrival_station') }}"
                                    old_carrier="{{ old('carrier') }}"
                                    errors="{{ $errors }}">
                    </app-form-header>

                    <app-form-outbound-direct-fly
                            errors="{{ $errors }}"
                            old_outbound_scale="{{ old('outbound_scale') }}"
                            outbound_dep_date="{{ old('outbound_dep_date') }}"
                            outbound_dep_hour="{{ old('outbound_dep_hour') }}"
                            outbound_arr_date="{{ old('outbound_arr_date') }}"
                            outbound_arr_hour="{{ old('outbound_arr_hour') }}">
                    </app-form-outbound-direct-fly>

                    <app-form-outbound-scale-fly
                            errors="{{ $errors }}"
                            old_outbound_scale="{{ old('outbound_scale') }}"
                            outbound_scale_station="{{ old('outbound_scale_station') }}" 
                            outbound_scale_start_date="{{ old('outbound_scale_start_date') }}"
                            outbound_scale_start_hour="{{ old('outbound_scale_start_hour') }}"
                            outbound_scale_end_date="{{ old('outbound_scale_end_date') }}"
                            outbound_scale_end_hour="{{ old('outbound_scale_end_hour') }}">
                    </app-form-outbound-scale-fly>

                    <app-form-return-direct-fly
                            old_return_scale="{{ old('return_scale') }}"
                            old_flight_type="{{ old('return') }}"
                            errors="{{ $errors }}"
                            return_dep_date="{{ old('return_dep_date') }}"
                            return_dep_hour="{{ old('return_dep_hour') }}"
                            return_arr_date="{{ old('return_arr_date') }}"
                            return_arr_hour="{{ old('return_arr_hour') }}">
                    </app-form-return-direct-fly>

                    <app-form-return-scale-fly
                            errors="{{ $errors }}"
                            old_return_scale="{{ old('return_scale') }}"
                            return_scale_station="{{ old('return_scale_station') }}"
                            return_scale_start_date="{{ old('return_scale_start_date') }}"
                            return_scale_start_hour="{{ old('return_scale_start_hour') }}"
                            return_scale_end_date="{{ old('return_scale_end_date') }}"
                            return_scale_end_hour="{{ old('return_scale_end_hour') }}">
                    </app-form-return-scale-fly> 

                    <div class="row" style="margin-top:35px">
                        <div class="col-md-6 col-xs-6 col-xs-offset-5">  
                            <div class="form-group">                                                                     
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-database"></i>Guardar
                                </button>
                            </div>
                        </div>
                    </div> 
                {{ Form::close() }}
            </div>
        </div> 
    </div>
@endsection
@section('custom_js')
<script src="{{ asset('js/anytime.js') }}"></script>

<script type="text/javascript">
    var dias = ['Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo'];
    var diasAbb = ['Lun','Mar','Mie','Jue','Vie','Sab','Dom'];
    var meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
                    'Julio','Agosto','Septembre','Octubre','Noviembre','Diciembre'];
    var mesesAbb = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sept',
                    'Oct','Nov','Dic'];

    var dateFormat = "%Y-%m-%d";
    var rangeConv = new AnyTime.Converter({ format: dateFormat });
    var minDay = '';
    var dayLater = '';
    var arrivalDay = '';
    var scaleDay = '';
    /*--------- VUELO IDA --------*/
    $('#outbound_dep_date').AnyTime_picker(
        { 
            format: dateFormat,
            firstDOW: 1,
            dayNames: dias,
            dayAbbreviations: diasAbb,
            monthNames: meses,
            monthAbbreviations: mesesAbb
        });

    // cuando se establece la fecha de salida me aseguro
    // que no pueda seleccionar un dia anterior para la fecha de llegada
    $('#outbound_dep_date').change(
        function (e) {
            var oneDay = 24*60*60*1000;   // milisecundos de un dia            
            var actualDay = rangeConv.parse($("#outbound_dep_date").val()).getTime();
            minDay = new Date(actualDay);
            dayLater = new Date(actualDay + oneDay);  // para el vuelo de vuelta
            $('#outbound_arr_date').AnyTime_noPicker()
                                    .val(rangeConv.format(minDay))
                                    .AnyTime_picker(
                                        {
                                            earliest: minDay,
                                            format: dateFormat
                                        }
                                    );
            // habilito el picker de la fecha del llegada (por defecto esta desabilitado
            // hasta que se elige una fecha de salida)
            $('#outbound_arr_date').removeAttr('disabled','disabled');

            // me aseguro que no se pueda elegir para el vuelo de vuelta un 
            // dia anterior al vuelo de ida
            $('#return_dep_date').AnyTime_noPicker()
                                .val(rangeConv.format(dayLater))
                                .AnyTime_picker(
                                    {
                                        earliest: dayLater,
                                        format: dateFormat
                                    }
                                );

            // cuando se elige una fecha para el vuelo de ida hay que poner esta
            // fecha como fecha minima en los pickers de la (eventual) escala
            // en el caso de que la fecha de llegada no es la misma que la fecha de ida
            // cambiamos la fecha minima de los pickers de escala mas abajo
            // en el listener change del outbound_arr_date

            arrivalDay = rangeConv.parse($("#outbound_arr_date").val()).getTime();
            scaleDay = new Date(arrivalDay);
            $('#outbound_scale_start_date').AnyTime_noPicker()
                                        .val(rangeConv.format(scaleDay))
                                        .AnyTime_picker({
                                            earliest: scaleDay,
                                            format: dateFormat
                                        });

            $('#outbound_scale_end_date').AnyTime_noPicker()
                                        .val(rangeConv.format(scaleDay))
                                        .AnyTime_picker({
                                            earliest: scaleDay,
                                            format: dateFormat
                                        });
        }
        
    );

    $("#outbound_dep_hour").AnyTime_picker(
        { 
            format: "%H:%i", labelTitle: "Hora",
            labelHour: "Hora", labelMinute: "Minuto" 
        });

    // fecha llegada del vuelo de ida
    // por defecto esta desabilitado, se habilita cuando selecionamos fecha salida
    $('#outbound_arr_date').AnyTime_picker(
        { 
            format: dateFormat,
            firstDOW: 1,
            dayNames: dias,
            dayAbbreviations: diasAbb,
            monthNames: meses,
            monthAbbreviations: mesesAbb
        }).attr('disabled',true);

    
    $("#outbound_arr_hour").AnyTime_picker(
        { 
            format: "%H:%i", labelTitle: "Hora",
            labelHour: "Hora", labelMinute: "Minuto" 
        });

    /* ------------- ESCALA IDA ----------------*/
    $('#outbound_scale_start_date').AnyTime_picker(
        { 
            format: dateFormat,
            firstDOW: 1,
            dayNames: dias,
            dayAbbreviations: diasAbb,
            monthNames: meses,
            monthAbbreviations: mesesAbb
        });
    // cuando se establece la fecha de salida me aseguro
    // que no pueda seleccionar un dia anterior para la fecha de llegada
    $('#outbound_scale_start_date').change(
        function (e) {
            var actualDay = rangeConv.parse($("#outbound_scale_start_date").val()).getTime();
            minDay = new Date(actualDay);
            $('#outbound_scale_end_date').AnyTime_noPicker()
                                    .val(rangeConv.format(minDay))
                                    .AnyTime_picker(
                                        {
                                            earliest: minDay,
                                            format: dateFormat
                                        }
                                    );
            
        }
    );
    $("#outbound_scale_start_hour").AnyTime_picker(
        { 
            format: "%H:%i", labelTitle: "Hora",
            labelHour: "Hora", labelMinute: "Minuto" 
        });
    
    $('#outbound_scale_end_date').AnyTime_picker(
        { 
            format: dateFormat,
            firstDOW: 1,
            dayNames: dias,
            dayAbbreviations: diasAbb,
            monthNames: meses,
            monthAbbreviations: mesesAbb
        });

    $("#outbound_scale_end_hour").AnyTime_picker(
        { 
            format: "%H:%i", labelTitle: "Hora",
            labelHour: "Hora", labelMinute: "Minuto" 
        });

    /*----------- VUELO DE VUELTA ---------------*/
    

    $('#return_dep_date').AnyTime_picker(
        { 
            format: dateFormat,
            firstDOW: 1,
            dayNames: dias,
            dayAbbreviations: diasAbb,
            monthNames: meses,
            monthAbbreviations: mesesAbb,
            earliest: dayLater
        });

    // cuando se establece la fecha de salida me aseguro
    // que no pueda seleccionar un dia anterior para la fecha de llegada
    $('#return_dep_date').change(
        function (e) {
            var actualDay = rangeConv.parse($("#return_dep_date").val()).getTime();
            minDay = new Date(actualDay);
            $('#return_arr_date').AnyTime_noPicker()
                                    .val(rangeConv.format(minDay))
                                    .AnyTime_picker(
                                        {
                                            earliest: minDay,
                                            format: dateFormat
                                        }
                                    );
            // habilito el picker de la fecha del llegada (por defecto esta desactivado
            // hasta que se elige una fecha de salida)
            $('#return_arr_date').removeAttr('disabled','disabled');

            // cuando se elige una fecha para el vuelo de vuelta hay que poner esta
            // fecha como fecha minima en los pickers de la (eventual) escala
            $('#return_scale_start_date').AnyTime_noPicker()
                                        .val(rangeConv.format(minDay))
                                        .AnyTime_picker({
                                            earliest: minDay,
                                            format: dateFormat
                                        });

            $('#return_scale_end_date').AnyTime_noPicker()
                                        .val(rangeConv.format(minDay))
                                        .AnyTime_picker({
                                            earliest: minDay,
                                            format: dateFormat
                                        });
        }
    );
    $("#return_dep_hour").AnyTime_picker(
        { 
            format: "%H:%i", labelTitle: "Hora",
            labelHour: "Hora", labelMinute: "Minuto" 
        });
    // hora fecha y hora llegada vuelo de vuelta
    $('#return_arr_date').AnyTime_picker(
        { 
            format: dateFormat,
            firstDOW: 1,
            dayNames: dias,
            dayAbbreviations: diasAbb,
            monthNames: meses,
            monthAbbreviations: mesesAbb
        }).attr('disabled',true);
    
    // hora llegada vuelo de vuelta
    $("#return_arr_hour").AnyTime_picker(
        { 
            format: "%H:%i", labelTitle: "Hora",
            labelHour: "Hora", labelMinute: "Minuto" 
        });

    /*-----------ESCALA VUELO DE VUELTA ---------------*/
    $('#return_scale_start_date').AnyTime_picker(
        { 
            format: dateFormat,
            firstDOW: 1,
            dayNames: dias,
            dayAbbreviations: diasAbb,
            monthNames: meses,
            monthAbbreviations: mesesAbb
        });

    // cuando se establece la fecha de salida me aseguro
    // que no pueda seleccionar un dia anterior para la fecha de llegada
    $('#return_scale_start_date').change(
        function (e) {
            var actualDay = rangeConv.parse($("#return_scale_start_date").val()).getTime();
            minDay = new Date(actualDay);
            $('#return_scale_end_date').AnyTime_noPicker()
                                    .val(rangeConv.format(minDay))
                                    .AnyTime_picker(
                                        {
                                            earliest: minDay,
                                            format: dateFormat
                                        }
                                    );
            
        }
    );
    $("#return_scale_start_hour").AnyTime_picker(
        { 
            format: "%H:%i", labelTitle: "Hora",
            labelHour: "Hora", labelMinute: "Minuto" 
        });

    $('#return_scale_end_date').AnyTime_picker(
        { 
            format: dateFormat,
            firstDOW: 1,
            dayNames: dias,
            dayAbbreviations: diasAbb,
            monthNames: meses,
            monthAbbreviations: mesesAbb
        });

    $("#return_scale_end_hour").AnyTime_picker(
        { 
            format: "%H:%i", labelTitle: "Hora",
            labelHour: "Hora", labelMinute: "Minuto" 
        });
</script>
@endsection