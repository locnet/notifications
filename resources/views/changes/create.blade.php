@extends('layouts.app')
@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/anytime.css') }}" />
@endsection
@section('content')    
    <div class="col-md-10 col-xs-12">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="text-center">Crear nueva notificacion de cambios en el itinerario:
                     "{{ $itinerary->title }}"</h3>
            </div>

            <div class="panel-body">
                {!! Form::open(array('url' => 'change/store','method' => 'POST')) !!}
                    {{ csrf_field() }} 
                    {!! Form::hidden('itinerary_id',$itinerary->id) !!}
                                                                                                             
                    <app-form-header old_title="{{ $itinerary->title }}"
                                    old_return_flight="{{ $itinerary->return_flight }}"
                                    old_departure_station="{{ $itinerary->departure_station }}"
                                    old_arrival_station="{{ $itinerary->arrival_station }}"
                                    old_carrier="{{ $itinerary->carrier }}"
                                    errors="{{ $errors }}">
                    </app-form-header>
                    
                    <app-form-outbound-direct-fly
                            errors="{{ $errors }}"
                            old_outbound_scale="{{ $itinerary->outbound_scale }}"
                            outbound_dep_date="{{ \Carbon\Carbon::parse($itinerary->outbound_dep_time)->toDateString() }}"
                            outbound_dep_hour="{{  \Carbon\Carbon::parse($itinerary->outbound_dep_time)->toTimeString()}}"
                            outbound_arr_date="{{ \Carbon\Carbon::parse($itinerary->outbound_arr_time)->toDateString() }}"
                            outbound_arr_hour="{{ \Carbon\Carbon::parse($itinerary->outbound_arr_time)->toTimeString() }}">
                    </app-form-outbound-direct-fly>

                    <app-form-outbound-scale-fly
                            errors="{{ $errors }}"
                            old_outbound_scale="{{ $itinerary->outbound_scale }}"
                            outbound_scale_station="{{ $itinerary->outbound_scale_station }}" 
                            outbound_scale_start_date="{{ \Carbon\Carbon::parse($itinerary->outbound_scale_start_time)->toDateString() }}"
                            outbound_scale_start_hour="{{ \Carbon\Carbon::parse($itinerary->outbound_scale_start_time)->toTimeString() }}"
                            outbound_scale_end_date="{{ \Carbon\Carbon::parse($itinerary->outbound_scale_end_time)->toDateString() }}"
                            outbound_scale_end_hour="{{ \Carbon\Carbon::parse($itinerary->outbound_scale_end_time)->toTimeString() }}">
                    </app-form-outbound-scale-fly>

                    <app-form-return-direct-fly
                            old_return_scale="{{ $itinerary->return_scale }}"
                            old_flight_type="{{ $itinerary->return }}"
                            errors="{{ $errors }}"
                            return_dep_date="{{ \Carbon\Carbon::parse($itinerary->return_dep_time)->toDateString() }}"
                            return_dep_hour="{{ \Carbon\Carbon::parse($itinerary->return_dep_time)->toTimeString() }}"
                            return_arr_date="{{ \Carbon\Carbon::parse($itinerary->return_arr_time)->toDateString() }}"
                            return_arr_hour="{{ \Carbon\Carbon::parse($itinerary->return_arr_time)->toTimeString() }}">
                    </app-form-return-direct-fly>

                    <app-form-return-scale-fly
                            errors="{{ $errors }}"
                            old_return_scale="{{ $itinerary->return_scale }}"
                            return_scale_station="{{ $itinerary->return_scale_station }}"
                            return_scale_start_date="{{ \Carbon\Carbon::parse($itinerary->return_scale_start_time)->toDateString() }}"
                            return_scale_start_hour="{{ \Carbon\Carbon::parse($itinerary->return_scale_start_time)->toTimeString() }}"
                            return_scale_end_date="{{ \Carbon\Carbon::parse($itinerary->return_scale_end_time)->toDateString() }}"
                            return_scale_end_hour="{{ \Carbon\Carbon::parse($itinerary->return_scale_end_time)->toTimeString() }}">
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
    var diasAbb = ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'];
    var meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
                    'Julio','Agosto','Septembre','Octubre','Noviembre','Diciembre'];
    var mesesAbb = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sept',
                    'Oct','Nov','Dic'];

    /*--------- VUELO IDA --------*/
    $('#outbound_dep_date').AnyTime_picker(
        { 
            format: "%Y-%m-%d",
            firstDOW: 1,
            dayNames: dias,
            dayAbbreviations: diasAbb,
            monthNames: meses,
            monthAbbreviations: mesesAbb
        });

    $("#outbound_dep_hour").AnyTime_picker(
        { 
            format: "%H:%i", labelTitle: "Hora",
            labelHour: "Hora", labelMinute: "Minuto" 
        });
    
         $('#outbound_arr_date').AnyTime_picker(
        { 
            format: "%Y-%m-%d",
            firstDOW: 1,
            dayNames: dias,
            dayAbbreviations: diasAbb,
            monthNames: meses,
            monthAbbreviations: mesesAbb
        });

    $("#outbound_arr_hour").AnyTime_picker(
        { 
            format: "%H:%i", labelTitle: "Hora",
            labelHour: "Hora", labelMinute: "Minuto" 
        });
    /* ------------- ESCALA IDA ----------------*/
    $('#outbound_scale_start_date').AnyTime_picker(
        { 
            format: "%Y-%m-%d",
            firstDOW: 1,
            dayNames: dias,
            dayAbbreviations: diasAbb,
            monthNames: meses,
            monthAbbreviations: mesesAbb
        });

    $("#outbound_scale_start_hour").AnyTime_picker(
        { 
            format: "%H:%i", labelTitle: "Hora",
            labelHour: "Hora", labelMinute: "Minuto" 
        });
    
         $('#outbound_scale_end_date').AnyTime_picker(
        { 
            format: "%Y-%m-%d",
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
            format: "%Y-%m-%d",
            firstDOW: 1,
            dayNames: dias,
            dayAbbreviations: diasAbb,
            monthNames: meses,
            monthAbbreviations: mesesAbb
        });

    $("#return_dep_hour").AnyTime_picker(
        { 
            format: "%H:%i", labelTitle: "Hora",
            labelHour: "Hora", labelMinute: "Minuto" 
        });

    $('#return_arr_date').AnyTime_picker(
        { 
            format: "%Y-%m-%d",
            firstDOW: 1,
            dayNames: dias,
            dayAbbreviations: diasAbb,
            monthNames: meses,
            monthAbbreviations: mesesAbb
        });

    $("#return_arr_hour").AnyTime_picker(
        { 
            format: "%H:%i", labelTitle: "Hora",
            labelHour: "Hora", labelMinute: "Minuto" 
        });

    /*-----------ESCALA VUELO DE VUELTA ---------------*/
    $('#return_scale_start_date').AnyTime_picker(
        { 
            format: "%Y-%m-%d",
            firstDOW: 1,
            dayNames: dias,
            dayAbbreviations: diasAbb,
            monthNames: meses,
            monthAbbreviations: mesesAbb
        });

    $("#return_scale_start_hour").AnyTime_picker(
        { 
            format: "%H:%i", labelTitle: "Hora",
            labelHour: "Hora", labelMinute: "Minuto" 
        });

    $('#return_scale_end_date').AnyTime_picker(
        { 
            format: "%Y-%m-%d",
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