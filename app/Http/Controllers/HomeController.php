<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Itinerary;
use App\Change;
use App\Pnr;

class HomeController extends Controller
{
    private $itinerary;
    private $pnr;
    private $change;

    /**
     * Constructor
     *
     * @param Itinerary $itinerary
     * @param Pnr $pnr
     * @param Change $change
     * @return void
     */
    public function __construct(Itinerary $itinerary, Pnr $pnr, Change $change) {
        $this->middleware('auth');

        $this->itinerary = $itinerary;
        $this->pnr = $pnr;
        $this->change = $change;
    }
    
    /**
     * Devuelve la view principal con algunas colleciones de datos
     *
     * @return view
     */
    public function index() {
        $itinerary = $this->itinerary->all();
        $pnrs = $this->pnr->all();
        $changes = $this->change->getChangesWithPnrs();

        return view('layouts.main',compact('itinerary' ,'changes','pnrs'));
    }
}
