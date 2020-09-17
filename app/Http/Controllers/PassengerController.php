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
     * Eseña el formulario para crear un nuevo pasagero
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('passengers.create');
    }

    /**
     * guarda un nueva entrada en la tabla "passengers"
     *  @return \Illuminate\Http\Response
     */

    public function store(Request $request) {
     
        // validamos formulario
        $validatedData = $this->validate($request,[
            'loc' => 'required | max:6 | min:5',
            'mobil' => 'required | min:9',
            'fijo' => 'min:9',
            'company' => 'required | min:5'
        ]);

        // preparamos los datos que se 

        $data = [
            'loc' => $request->loc,
            'mobil' => $request->mobil,
            'fijo' => $request->fijo,
            'company' => $request->company ];

        // el fijo no es obligatorio, damos un valor predetrminado
            if (!$request->fijo) {
                $data['fijo'] = '00000000';
            }

        if ($this->passenger::firstOrCreate($data)) {
            return redirect('passenger');
        }
    }

    /** 
    * busqueda de un contacto por el localizador y compania aerea
    * @return 
    */
    public function search() {
        return view('passengers.search');
    }

    /**
    * presenta el resultado de la busqueda
    * @return \Illuminate\Http/Response
    */ 
    public function show(Request $request) {
        // validamos datos
        $validatedData = $this->validate($request, [
            'loc' => 'required',
            'company' => 'required | min:5']);

        $contact = $this->passenger->where('loc', '=',$request->loc)
                            ->where('company','=',$request->company)
                            ->get();

        if (!$contact->isEmpty()) {
            return view('passengers.show',compact('contact'));
            
        }

        return view('errors.error_message')->withMessage('
                Lo sentimos, pero no hemos encontrado ningun registro 
                aferente al localizador: '.$request->loc);
        
    }

}
