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
        
        $cantidad = \App\Impuesto::where('mes', $request->input('mes'))
        ->where('anio', $request->input('anio'))->count();

        if($cantidad > 0){
            
            return response($respuesta->toJson(), 200);
        }else{
            return response('Error', 404);
        }
    	

    }


    public function ingresarImpuestos(Request $request){

    	$impuestos = new \App\Impuesto;
    	
    	$desde = $request->input('desde');
    	$hasta = $request->input('hasta');
    	$mes = $request->input('mes');
    	$anio = $request->input('anio');
    	$factor = $request->input('factor');
    	$cantidadRebajar = $request->input('cantidadRebajar');
    	$tramo = $request->input('tramo');


    	$impuestos::updateOrCreate(
		    ['mes' => $request->input('mes'), 'anio' => $request->input('anio'), 'tramo' => $request->input('tramo')],
		    ['desde' => $desde, 'hasta' => $hasta, 'mes' => $mes, 'anio' => $anio, 'factor' => $factor, 'cantidadRebajar' => $cantidadRebajar,'tramo' => $tramo ]
		);

    	/*$impuestos->desde = $desde;
    	$impuestos->hasta = $hasta;
    	$impuestos->mes = $mes;
    	$impuestos->anio = $anio;
    	$impuestos->factor = $factor;
    	$impuestos->cantidadRebajar = $cantidadRebajar;
    	$impuestos->save(); */

    	return view('impuestos.ingresoRealizadoImpuesto', compact('impuestos'));

    }







}
