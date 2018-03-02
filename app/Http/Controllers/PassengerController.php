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

    /**
     * @param 
     * @return @return \Illuminate\Http\Response
     */
    public function index() {
        $passenger = $this->passenger->all();
        return view('passengers.main',compact('passenger'));
    }

    /**
     * @param integer $id el id del pasagero
     */
    public function getAllPnrs($id) {
        //$id = $request->id;
        $pax = $this->passenger->find($id);
        return $this->pnr->where('passenger',$id)->get();
    }
}
