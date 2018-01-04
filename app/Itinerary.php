<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    // mass asignmemet
    protected $fillable = ['user_id', 'pnr', 'company_id', 'outbound_route', 'return_route', 'outbound_date',
                            'return_date'];

    

    /* cambios hechos al itinerario
    * @return void
    */
    public function changes() {
        return $this->hasMany('App\Change');
    }
    /* ruta del vuelo
    * @return void
    */
    public function route() {
        return $this->hasOne('App\Routes');
    }

    /* compania aeriana
    * @return void
    */
    public function carrier() {
        return $this->hasOne('App\Carrier');
    }
}
