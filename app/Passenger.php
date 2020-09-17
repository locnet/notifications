<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    protected $fillable = ['loc','mobil','fijo','company','created_at','updated_at'];

   /**
     * relaciones en base de datos
     * @return void
     */
    public function pnrs() {
        return $this->hasMany('App\Pnr');
    }
}
