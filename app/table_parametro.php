<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class table_parametro extends Model
{
    //
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Modelo',
		'Habitat',
		'Provida',
		'Cuprum',
		'PlanVital',
		'Uno',
		'UF',
		'Cesantia',
		'AsigFamA',
		'AsigFamB',
		'AsigFamC',
		'TopeImpAFP',
		'TopeImpIPS',
		'TopeImpSegCesantia'
    ];
}
