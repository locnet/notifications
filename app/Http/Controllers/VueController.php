<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Itinerary;
use App\Change;
use App\Pnr;

class VueController extends Controller
{
    private $itinerary;
    private $pnr;
    private $change;

    /**
     * Constructor
     *
     * @param Itinerary $itinerary
     * @param Pnr $pnr
     * @return void
     */
    public function __construct(Itinerary $itinerary, Pnr $pnr, Change $change) {
        $this->itinerary = $itinerary;
        $this->pnr = $pnr;
        $this->change = $change;

        $this->middleware('auth');

    }
    /**
     * Undocumented function
     *
     * @return view
     */
    public function index() {
        $itinerary = $this->itinerary->find(1);
        $pnrs = $this->pnr->all();
        $changes = $this->change->getChangesWithPnrs();

        return view('layouts.vue',compact('itinerary' ,'changes','pnrs'));
    }
}
