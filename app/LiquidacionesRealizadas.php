<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LiquidacionesRealizadas extends Model
{
    //
    protected $guarded = [];

     public function trabajador()
    {
       // return $this->hasOne('App\Trabajador', 'id', 'trabajadors_id');
    	return $this->hasOne('App\Trabajador', 'id', 'trabajadors_id');
    } 
}
