<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Change extends Model
{
    protected $fillable = ['itinerary_id',
                        'departure_station','arrival_station','return_flight',
                        'outbound_dep_time','outbound_arr_time','outbound_scale',
                        'outbound_scale_station','outbound_scale_start_time','outbound_scale_end_time',
                        'return_dep_time','return_arr_time', 'return_scale',
                        'return_scale_station', 'return_scale_start_time','return_scale_end_time'];

    /** belongsTo relationship
    * @return App\Itinerary
    */
    public function itinerary() {
        return $this->belongsTo('App\Itinerary');
    }

    /**
     * devuelve los PNR's afectados por el cambio
     *
     * @return App\Pnr
     */
    public function pnrs() {
        return $this->hasMany('App\Pnr');
    }

    /**
     * Devuelve una coleccion de la tabla cambios junto con la tabla de los pnr afectados
     *
     * @return 
     */
    public function getChangesWithPnrs() {
        return DB::table('changes')
                ->join('pnrs', 'pnrs.change_id','=','changes.id')
                ->select('changes.id','changes.outbound_dep_time','changes.itinerary_id',
                        'pnrs.pnr','pnrs.passenger')
                ->get();
    }
}
