@extends('layouts.app')

@section('content')
     <app-passengers-component
        passengers = "{{ $passenger }}">
         
     </app-passengers-component>

     <app-pnr-component 
     		base-url = "{{ url('itineraries') }}">
     			
	</app-pnr-component>
@endsection