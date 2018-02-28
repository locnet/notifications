<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Passenger;

class PassengerController extends Controller
{
    private $passenger;

    function __construct(Passenger $passenger) {
        $this->middleware('auth');
        
        $this->passenger = $passenger;
    }

    /**
     * @param 
     * @return @return \Illuminate\Http\Response
     */
    public function index() {
        $passenger = $this->passenger->all();dd($passenger);
    }
}
