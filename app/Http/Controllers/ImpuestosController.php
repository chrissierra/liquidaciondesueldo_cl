<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImpuestosController extends Controller
{
    //
     public function __construct()
    {
       // $this->middleware('auth');
    }
    public function impuestosDelMesEnCurso(Request $request){
    	$respuesta = \App\Impuesto::where('mes', $request->input('mes'))
    	->where('anio', $request->input('anio'))
    	->get();

    	return $respuesta->toJson();
    }


    public function ingresarImpuestos(Request $request){

    	$impuestos = new \App\Impuesto;
    	
    	$desde = $request->input('desde');
    	$hasta = $request->input('hasta');
    	$mes = $request->input('mes');
    	$anio = $request->input('anio');
    	$factor = $request->input('factor');
    	$cantidadRebajar = $request->input('cantidadRebajar');

    	$impuestos->desde = $desde;
    	$impuestos->hasta = $hasta;
    	$impuestos->mes = $mes;
    	$impuestos->anio = $anio;
    	$impuestos->factor = $factor;
    	$impuestos->cantidadRebajar = $cantidadRebajar;
    	$impuestos->save();

    	return view('impuestos.ingresoRealizadoImpuesto', compact('impuestos'));

    }
}
