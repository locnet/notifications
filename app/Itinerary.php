<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    // mass asignmemet
    protected $fillable = ['title','carrier','departure_station','arrival_station','return_flight',
                        'outbound_dep_time','outbound_arr_time','outbound_scale',
                        'outbound_scale_station','outbound_scale_start_time','outbound_scale_end_time',
                        'return_dep_time','return_arr_time', 'return_scale',
                        'return_scale_station', 'return_scale_start_time','return_scale_end_time'
        ];

    

    /** cambios hechos al itinerario
    * @return void
    */
    public function changes() {
        return $this->hasMany('App\Change');
    }
    /** codigos reservas afectadas
    * @return void
    */
    public function pnrs() {
        return $this->hasMany('App\Pnr');
    }
}
