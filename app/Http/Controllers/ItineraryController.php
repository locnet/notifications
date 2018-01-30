<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Itinerary;
use App\Passenger;
use App\Pnr;
use DB;
use Input;
use Carbon\Carbon;

class ItineraryController extends Controller
{
    private $passenger;
    private $itinerary;
    private $pnr;
    /**
     * constructor
     * @return void
     */

    public function __construct(Passenger $passenger ,Itinerary $itinerary, Pnr $pnr) {
        $this->middleware('auth');

        $this->passenger = $passenger;
        $this->itinerary = $itinerary;
        $this->pnr = $pnr;
    }

    /**
     * Devuelve todos los itinerarios.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itineraries = $this->itinerary::all();
        
        return view('itineraries.index',compact('itineraries'));
    }

    /**
     * Eseña el formulario para crear un nuevo itinerario
     *
     * @return \Illuminate\Http\Response
     */

    public function create() {
        // array pasageros
        $passenger_array = $this->passenger->pluck('name','id')->sort();
        
        return view('itineraries.create',compact('passenger_array'));
    }
    

    /**
     * Crea una nueva entrada en tabla 'itineraries'
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request) {

        // validamos formulario
        $validatedData = $this->validate($request,[
            'title' =>    'required',
            'carrier' => 'required',
            'departure_station' => 'required',
            'arrival_station' => 'required',
            'return_flight' => 'required',
            'outbound_dep_date' => 'required',
            'outbound_dep_hour' => 'required',
            'outbound_arr_date' => 'required',
            'outbound_arr_hour' => 'required'
        ]);

        // datos para insertar en la base de datos
        $data = [
            'title' => $request->title,
            'carrier' => $request->carrier,
            'departure_station' => $request->departure_station,
            'arrival_station' => $request->arrival_station,
            'return_flight' => $request->return_flight,
            'outbound_dep_time' => $request->outbound_dep_date.' '.$request->outbound_dep_hour,
            'outbound_arr_time' => $request->outbound_arr_date.' '.$request->outbound_arr_hour,
            'outbound_scale' => $request->outbound_scale,
            'outbound_scale_station' => $request->outbound_scale_station,
            'return_scale' => $request->return_scale,
            'return_scale_station' => $request->return_scale_station      
        ];

        // si el vuelo de ida tiene escala
        if ($request->outbound_scale == 1) {
            $this->validate($request,[
                'outbound_scale_station' => 'required',
                'outbound_scale_start_date' => 'required',
                'outbound_scale_start_hour' => 'required',
                'outbound_scale_end_date' => 'required',
                'outbound_scale_end_hour' => 'required'
                ]);

            // db
            $data['outbound_scale_start_time'] = $request->outbound_scale_start_date
                                                .' '.$request->outbound_scale_start_hour;
            $data['outbound_scale_end_time'] = $request->outbound_scale_end_date
                                                .' '.$request->outbound_scale_end_hour;
        } else {
            $data['outbound_scale_start_time'] = '1900-01-01 00:00:00';
            $data['outbound_scale_end_time'] = '1900-01-01 00:00:00';
        }

        // si el vuelo es ida y vuelta
        if ($request->return_flight == 1) { 
            $this->validate($request,[
                'return_dep_date' => 'required',
                'return_dep_hour' => 'required',
                'return_arr_date' => 'required',
                'return_arr_hour' => 'required'
            ]);

            // db
            $data['return_dep_time'] = $request->return_dep_date.' '.$request->return_dep_hour;
            $data['return_arr_time'] = $request->return_arr_date.' '.$request->return_arr_hour;
        } else {
            $data['return_dep_time'] = '1900-01-01 00:00:00';
            $data['return_arr_time'] = '1900-01-01 00:00:00';
        }

        // si el vuelo de vuelta tiene escala
        if ($request->return_scale == 1) {
            $this->validate($request,[
                'return_scale_station' => 'required',
                'return_scale_start_date' => 'required',
                'return_scale_start_hour' => 'required',
                'return_scale_end_date' => 'required',
                'return_scale_end_hour' => 'required'
            ]);
            
            //db
            $data['return_scale_start_time'] = $request->return_scale_start_date.' '.$request->return_scale_start_hour;
            $data['return_scale_end_time'] = $request->return_scale_end_date.' '.$request->return_scale_end_hour;
        } else {
            $data['return_scale_start_time'] = '1900-01-01 00:00:00';
            $data['return_scale_end_time'] = '1900-01-01 00:00:00';
        }
        
        // si el itinerario se ha creado corectamente el siguiente paso es 
        // crear el cambio que afecta al itinerario
        if ( $itinerary = $this->itinerary::firstOrCreate($data)) {
            return redirect('change/create/'.$itinerary->id);
        }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $pnr = $this->pnr->find($id);
        $old_comments = $pnr->comments. "&";

        // utilizando la relacion belongsTo sacamos el cambio que afecta al pnr
        $change = $pnr->change;

        // el mismo methodo belongsTo para sacar el itinerario original
        $itinerary = $change->itinerary;

        return view('itineraries.show',compact('pnr','change','itinerary','old_comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
