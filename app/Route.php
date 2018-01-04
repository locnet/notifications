<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = ['departure_station','arrival_station','departure_time',
    'arrival_time','carrier_id'];

        
    /*
    * la compania que opera la ruta
    * @return void
    */
    public function carrier() {
        return $this->belongsTo('App\Carrier');
    }

    // ciudades
    /*
    * @return void
    */
    public function departure_city() {
        return $this->belongsTo('App\City', 'departure_station_id');
    }

    /*
    * @return void
    */
    public function arrival_city() {
        return $this->belongsTo('App\City', 'arrival_station_id');
    }
}
