<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pnr extends Model
{
    protected $fillable = ['pnr','change_id','passenger','phone','comments'];

    /**
    * el itineario al que pertenece el pnr
    * pueden existir varios pnr para el mismo itinearario, para DRY
    
    * @return App\Itinerary
    */
    public function change() {
        return $this->belongsTo('App\Change');
    }

    

}
