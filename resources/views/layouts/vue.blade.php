@extends('layouts.app')

@section('content')
    <main-component itinerary= "{{ $itinerary }}"
                    changes = "{{ $changes }}"
                    pnrs = "{{ $pnrs }}">
    </main-component>
@endsection
