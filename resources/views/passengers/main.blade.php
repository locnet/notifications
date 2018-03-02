@extends('layouts.app')

@section('content')
     <app-passengers-component
        passengers = "{{ $passenger }}">
         
     </app-passengers-component>

     <app-pnr-component></app-pnr-component>
@endsection