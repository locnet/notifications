<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['city_name', 'iata_code'];

    // hasOne relationship
    public function departure_city() {
        return $this->hasOne('App\Route', 'departure_station_id');
    }
    public function arrival_city() {
        return $this->hasOne('AppRoute', 'arrival_station_id');
    }
}
