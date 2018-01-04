<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Change extends Model
{
    protected $fillable = ['itinerary_id','remember_token','departure_time','arrival_time'];

    // belongsTo relationship
    public function itinerary() {
        return $this->belongsTo('App\Itinerary');
    }
}
