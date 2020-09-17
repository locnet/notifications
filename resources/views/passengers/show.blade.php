@extends('layouts.app')

@section('content')
     <div class="col-md-10 col-xs-12 animated fadeIn">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="text-center">Detalles contacto </h3>
            </div>
            <div class="panel-body">
                @foreach ($contact as $c)
                    <p><strong>Localizador: </strong>{{ $c->loc }}</p>
                    <p><strong>Compania: </strong>{{ $c->company }}</p>
                    <p><strong>Movil: </strong>{{ $c->mobil }}</p>
                    <p><strong>Fijo: </strong>{{ $c->fijo }}</p>
                @endforeach
            </div>
        </div>
    </div>
    
@endsection