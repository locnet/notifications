<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Passenger;
use App\Pnr;
use App\Itinerary;

class PassengerController extends Controller
{
    protected $passenger;
    protected $pnr;
    protected $itinerary;

    function __construct(Passenger $passenger,Itinerary $itinerary, Pnr $pnr) {
        $this->middleware('auth');
        
        $this->passenger = $passenger;
        $this->pnr = $pnr;
        $this->itinerary = $itinerary;
    }

}
