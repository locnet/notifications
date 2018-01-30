<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Change;
use App\Pnr;
use Carbon\Carbon;

class PnrController extends Controller
{
    protected $change;
    protected $pnr;

    public function __construct(Change $change, Pnr $pnr) {
        $this->middleware('auth');
        
        $this->change = $change;
        $this->pnr = $pnr;
    }

    public function create ($change_id) {
        $change = $this->change::find($change_id);
        return view('pnrs.create_pnr',compact('change'));
    }

    /**
     * crea un nuevo pnr en la base de datos
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request) {
        $this->validate($request,[
            'change_id' => 'required|numeric',
            'pnr' => 'required|min:6',
            'passenger' => 'required',
            'phone' => 'required|min:9'
        ]);

        // db
        $data = [
            'change_id' => $request->change_id,
            'pnr' => $request->pnr,
            'passenger' => $request->passenger,
            'phone' => $request->phone,
            'comments' => $request->comments
        ];
        // no insertar sin comentarios
        $dt = Carbon::now(); // fecha actual

        if (strlen($request->comments) == 0) {
            $newComment = array($dt, 'Sin detalles.');
            $data['comments'] = implode(';',$newComment);
        }
        
        if ($p = $this->pnr::firstOrCreate($data)) {
            return redirect('home');
        } else {
            return "NO se ha podido crear";
        }
    }

    /**
    * actualiza entrada "comments" en tabla pnrs
    * @param $request
    * @return boolean true
    */
    public function updateComments(Request $request) {

        $id = $request->id;

        $dt = Carbon::now(); // fecha actual

        // array
        $comment = array($dt->toDayDateTimeString(), $request->comment);

        // transfomamos el array en un string
        $imploded = implode(';' , $comment);

        $p = $this->pnr->find($id);

        // comentarios antiguos
        if ( strlen($request->comment) > 0) {

            if (strlen($p->comments) > 0) {
                $new_comments = $p->comments.'&'. $imploded;
            } else {
                $new_comments = $imploded;
            }

            $p->comments = $new_comments;
            $response = $p->save();

            return "true";
        }
        return "false";   
    }

    public function close($id) {
        $p = $this->pnr->find($id);
        $p->status = 0;

        $p->update();
        return redirect('home');
    }
}
