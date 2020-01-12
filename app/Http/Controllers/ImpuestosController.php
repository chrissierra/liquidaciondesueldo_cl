<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImpuestosController extends Controller
{
    //
    public function impuestosDelMesEnCurso(Request $request){
    	$respuesta = \App\Impuesto::where('mes', $request->input('mes'))
    	->where('anio', $request->input('anio'))
    	->get();

    	return $respuesta->toJson();
    }
}
