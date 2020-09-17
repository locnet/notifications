@extends('layouts.app')

@section('content')
     <div class="col-md-10 col-xs-12 animated fadeIn">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="text-center">Crear nuevo pasagero</h3>
            </div>
            <div class="panel-body">
                {!! Form::open(array('url' => 'passenger/store','method' => 'POST')) !!}
                    {{ csrf_field() }}
                <app-create-passenger
                    old_loc = "{{ old('loc') }}"
                    old_mobil = "{{ old('mobil') }}"
                    old_fijo = "{{ old('fijo') }}"
                    old_company = "{{ old('company') }}"
                    errors = "{{ $errors }}">
                </app-create-passenger>

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