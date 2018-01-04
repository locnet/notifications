<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    /* la ruta que le pertenece
    * @return void
    */

    public function route() {
        return $this->hasOne('App\Route');
    }
}
