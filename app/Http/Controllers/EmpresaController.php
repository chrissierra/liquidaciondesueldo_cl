<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    //
	public function GetTrabajadoresPorIdUsuario(Request $request){

		$datosEmpresa = \App\Empresa::where('user_id', $request->input('user_id'))->firstOrFail();

		$trabajadores = \App\Trabajador::where( 'empresas_id' ,$datosEmpresa['id'])->get();

		return response(array(
			'datosEmpresa' => $datosEmpresa,
			'trabajadores' => $trabajadores
		));

	}
}
