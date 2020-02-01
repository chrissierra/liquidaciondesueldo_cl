<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class parametrosController extends Controller
{
    //
        public function parametrosDelMesEnCurso(Request $request){
    	$respuesta = \App\table_parametro::where('mes', $request->input('mes'))
    	->where('anio', $request->input('anio'))
    	->get();

    	$cantidad = \App\table_parametro::where('mes', $request->input('mes'))
        ->where('anio', $request->input('anio'))->count();

        if($cantidad > 0){
            return $respuesta->toJson();
        }else{
            return response('Error', 404);
        }

    	//return $respuesta->toJson();
    }


    public function ingresarParametros(Request $request){

    	$parametros = new \App\table_parametro;
    	
        $Modelo= $request->input('Modelo');
		$Habitat= $request->input('Habitat');
		$Provida= $request->input('Provida');
		$Cuprum= $request->input('Cuprum');
		$PlanVital= $request->input('PlanVital');
		$Uno= $request->input('Uno');
		$UF= $request->input('UF');
		$Cesantia= $request->input('Cesantia');
		$AsigFamA= $request->input('AsigFamA');
		$AsigFamB= $request->input('AsigFamB');
		$AsigFamC= $request->input('AsigFamC');
		$TopeImpAFP= $request->input('TopeImpAFP');
		$TopeImpIPS= $request->input('TopeImpIPS');
		$TopeImpSegCesantia= $request->input('TopeImpSegCesantia');
		$mes= $request->input('mes');
		$anio= $request->input('anio');

    	$parametros::updateOrCreate(
		    ['mes' => $request->input('mes'), 'anio' => $request->input('anio') ],
		    [	'Modelo' => $Modelo,
		    	'Habitat'=> $Habitat,
				'Provida'=> $Provida,
				'Cuprum'=> $Cuprum,
				'PlanVital'=> $PlanVital,
				'Uno'=> $Uno,
				'UF'=> $UF,
				'Cesantia'=> $Cesantia,
				'AsigFamA'=> $AsigFamA,
				'AsigFamB'=> $AsigFamB,
				'AsigFamC'=> $AsigFamC,
				'TopeImpAFP'=> $TopeImpAFP,
				'TopeImpIPS'=> $TopeImpIPS,
				'TopeImpSegCesantia'=> $TopeImpSegCesantia,
				'mes'=> $mes,
				'anio'=> $anio ]
		);

    	/*$impuestos->desde = $desde;
    	$impuestos->hasta = $hasta;
    	$impuestos->mes = $mes;
    	$impuestos->anio = $anio;
    	$impuestos->factor = $factor;
    	$impuestos->cantidadRebajar = $cantidadRebajar;
    	$impuestos->save(); */

    	return view('parametros_adicionales.ingresoParametros', compact('parametros'));

    }
}
