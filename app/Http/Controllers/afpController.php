<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class afpController extends Controller
{
    //
    public function getAfpPorMes(Request $request){
    	return \App\afp::where('mes', $request->input('mes'))->where('anio',$request->input('anio') )
        ->select('Provida', 'Capital', 'Cuprum', 'PlanVital', 'Uno', 'IPS', 'Modelo', 'Habitat', 'Pensionado')
        ->first()->toJson();
    }
}
