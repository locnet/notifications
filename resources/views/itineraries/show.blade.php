@extends('layouts.app')

@section('content')
    <div class="col-md-10 col-xs-12 animated fadeIn">
        <app-change-pnr-component 
                    pnr="{{ $pnr }}"
                    copy-url = "{{  url('pnr/create/'.$change->id) }}">
        </app-change-pnr-component>
        <app-change-departure-component
                    itinerary="{{ $itinerary }}"
                    change="{{ $change }}"></app-change-departure-component>

        @if ($itinerary->outbound_scale === 1)
            <app-change-departure-scale-component
                    itinerary="{{ $itinerary }}"
                    change="{{ $change }}"></app-change-departure-scale-component>
        @endif

        @if ($itinerary->return_flight === 1)
            <app-change-return-component
                    itinerary="{{ $itinerary }}"
                    change="{{ $change }}"></app-change-return-component>
        @endif

        @if ($itinerary->return_scale === 1)
            <app-change-return-scale-component
                    itinerary="{{ $itinerary }}"
                    change="{{ $change }}"></app-change-return-scale-component>
        @endif
        
        <app-change-comments-component
                    pnr="{{  $pnr }}"
                    old_comments ="{{ $old_comments }}"
                    close_notification_url="{{ url('pnr/close/'.$pnr->id) }}"
                    open_notification_url="{{ url('pnr/open/'.$pnr->id) }}">
        </app-change-comments-component>

                           
    </div>
@endsection