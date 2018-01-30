@extends('layouts.app')

@section('content')   
    
    <div class="col-md-10 col-xs-12 tabel-responsive">
         <table class="table table-bordered table-striped animated fadeIn">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th>ID</th>
                    <th>TITULO</th>
                    <th>COMPANIA</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($itineraries as $itinerary)
                <tr>
                    <td>{{ $itinerary->id }}</td>
                    <td>{{ $itinerary->title }}</td>
                    <td><a href=""></a>{{ $itinerary->carrier }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
        
@endsection