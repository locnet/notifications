<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Change;
use App\Itinerary;
use App\Pnr;
use DB;
use Input;
use Carbon\Carbon;

class ChangeController extends Controller
{
    protected $change;
    protected $itinerary;
    protected $pnr;

    public function __construct (Change $change, Itinerary $itinerary, Pnr $pnr) {
        $this->middleware('auth');

        $this->change = $change;
        $this->itinerary = $itinerary;
        $this->pnr = $pnr;
    }

    /**
     * devuelve la pagina principal de los cambios
     *
     * @return \Illuminate\Http\Response     
     * 
     */
    public function index() {
        return $this->change->find(1)->first();
    }

    /**
     * formulario para crear una nueva entrada
     *
     * @param int $itinerary_id
     * @return \Illuminate\Http\Response
     */
    public function create($itinerary_id) {

        $itinerary = $this->itinerary->find($itinerary_id);
        
        return view('changes.create', compact('itinerary'));;
    }

    /**
     * inserta un nuevo cambio en la base de datos
     *
     * @param Request $request
     * @return App\Change
     */
    public function store(Request $request) {
        // validamos formulario
        $validatedData = $this->validate($request,[
            'itinerary_id' => 'required',
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
            'itinerary_id' => $request->itinerary_id,
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
        }

        // si el itinerario se ha creado corectamente el siguiente paso es 
        // crear el cambio que afecta al itinerario
        if ( $c = $this->change::firstOrCreate($data)) {
            return redirect('pnr/create/'.$c->id);
        }
    }
    /**
     * devuelve el cambio que afecta un vuelo
     *
     * @param [type] $pnr
     * @return \Illuminate\Http\Response
     */
    public function getChangeByPnr($pnr) {
        return $this->pnr::where('pnr',$pnr)->first()->change;
    }
}