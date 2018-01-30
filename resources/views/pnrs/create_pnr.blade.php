@extends('layouts.app')

@section('content')
    <div class="col-md-10 col-xs-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="text-center">Cambio {{ $change->id }}</h3>
            </div>

            <div class="panel-body">
                {!! Form::open(['url' => 'pnr/store', 'method' => 'POST',
                                'class' => 'form-horizontal']) !!}
                {{ csrf_field() }}
                {!! Form::hidden('change_id',$change->id) !!}
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="form-group{{ $errors->has('pnr') ? ' has-error' : '' }}">
                            <div class="col-md-4 control-label">
                                {!! Form::label('pnr','Pnr') !!}
                            </div>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="fa fa-ticket"></span>
                                    </div> 
                                        {!! Form::input('text','pnr',old('pnr'), 
                                                        ['class' => 'form-control']) 
                                        !!} 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8 col-xs-12">
                        <div class="form-group{{ $errors->has('passenger') ? ' has-error' : '' }}">
                            <div class="col-md-4 control-label">
                                {!! Form::label('passenger','Pasagero') !!}
                            </div>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="fa fa-male"></span>
                                    </div> 
                                        {!! Form::input('text','passenger',old('passenger'), 
                                                        ['class' => 'form-control']) 
                                        !!} 
                                </div>
                               
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-xs-12">
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <div class="col-md-4 control-label">
                                {!! Form::label('phone','Telefono') !!}
                            </div>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="fa fa-phone"></span>
                                    </div> 
                                        {!! Form::input('text','phone',old('phone'), 
                                                        ['class' => 'form-control']) 
                                        !!} 
                                </div>                               
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8 col-xs-12">
                        <div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
                            <div class="col-md-4 control-label">
                                {!! Form::label('comments','Detalles') !!}
                            </div>
                            <div class="col-md-8">
                                <div class="input-group">
                                    
                                        {!! Form::textarea('comments',old('comments'), 
                                                        ['class' => 'form-control',
                                                        'cols' => 80,
                                                        'rows' => 5]) 
                                        !!} 
                                </div>                               
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top:35px">
                    <div class="col-md-6 col-xs-6 col-xs-offset-5">  
                        <div class="form-group">                                                                     
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-database"></i>Guardar
                            </button>
                        </div>
                    </div>
                </div> 
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection