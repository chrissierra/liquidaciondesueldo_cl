<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class afpController extends Controller
{
    //
    public function getAfpPorMes(Request $request){
    	return \App\afp::where('mes', $request->input('mes'))->where('anio',$request->input('anio') )
        ->select('Provida', 'Capital', 'Cuprum', 'PlanVital', 'Uno', 'IPS', 'Modelo', 'Habitat', 'Pensionado')
        ->firstOrFail()->toJson();
    }

   public function ingresarAfps(Request $request){

    	$AFP = new \App\afp;
    	
		$Provida = $request->input('Provida');
		$Modelo = $request->input('Modelo');
		$Capital = $request->input('Capital');
		$Cuprum = $request->input('Cuprum');
		$Habitat = $request->input('Habitat');
		$Uno = $request->input('Uno');
		$PlanVital = $request->input('PlanVital');
		$IPS = $request->input('IPS');
		$mes = $request->input('mes');
		$anio = $request->input('anio');
		$Pensionado = $request->input('Pensionado');

    	$AFP::updateOrCreate(
		    ['mes' => $request->input('mes'), 'anio' => $request->input('anio') ],
		    [	
				'Provida' => $Provida,
				'Modelo' => $Modelo,
				'Capital' => $Capital,
				'Cuprum' => $Cuprum,
				'Habitat' => $Habitat,
				'Uno' => $Uno,
				'PlanVital' => $PlanVital,
				'IPS' => $IPS,
				'mes' => $mes,
				'anio' => $anio,
				'Pensionado' => $Pensionado
			]
		);


    	return view('afp.ingresoAfps', compact('AFP'));

    }    
}
