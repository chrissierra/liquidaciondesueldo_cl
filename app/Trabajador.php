<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    //
    protected $guarded = [];

    public function empresa()
    {
        return $this->hasOne('App\Empresa', 'id', 'empresas_id');
    } 
}
