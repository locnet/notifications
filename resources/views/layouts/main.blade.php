@extends('layouts.app')

@section('content')
   
    <div class="col-md-10 col-xs-12">
        <app-main-component 
                itinerary= "{{ $itinerary }}"
                changes = "{{ $changes }}"
                pnrs = "{{ $pnrs }}"
                base-url = "{{ url('itineraries') }}">
        </app-main-component>
        <router-view></router-view>
    </div>

@endsection
