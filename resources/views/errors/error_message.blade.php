@extends('layouts.app')

@section('content')
	<div class="col-md-10 col-xs-12 animated fadeIn">
        <div class="panel panel-danger">
        	<div class="panel-heading">
        		<h3>Ha ocurido el siguiente eror:</h3>
        	</div>
        	<div class="panel-body">
        		<p>{{ $message }}</p>
        	</div>
        </div>
    </div>
@endsection