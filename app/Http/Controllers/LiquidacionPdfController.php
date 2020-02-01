<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LiquidacionPdfController extends Controller
{
    //
    public function procesarPdf(Request $request){
    	
    	$objeto_liquidaciones = $request->input('objeto_liquidaciones');
    	$modelo = new \App\LiquidacionesRealizadas;
    	$modelo->objeto_liquidacion = $objeto_liquidaciones;
		$modelo->mes= $request->input('mes');
		$modelo->anio= $request->input('anio');
		$modelo->user_id = $request->input('user_id');
		$modelo->invitado= $request->input('invitado');
		$modelo->save();

		return response($modelo->toJson());

    }


    public function GuardarDatosInvitadoLiquidacion(Request $request){

        //$modelo_trabajador = new \App\Trabajador; // Ingresar trabajador y obtener su id ( modo insertorupdate byrut)
        //$modelo_empresa = new \App\Empresa; // Ingresa la empresa ( modo de insertorupdate by rut empresa)
        //$modelo_liquidacion = new \App\LiquidacionesRealizadas; // Update agregando el id del trabajador
        $razonSocial = $request->input('razonSocial');
        $rutEmpresa = $request->input('rutEmpresa');
        $rutTrabajador = $request->input('rutTrabajador');
        $nombreTrabajador = $request->input('nombreTrabajador');
        $apellidosTrabajador = $request->input('apellidosTrabajador');
        $CargoTrabajador = $request->input('CargoTrabajador');
        $sucursal = $request->input('sucursal');
        $DireccionSucursal = $request->input('DireccionSucursal');
        $fechaIngreso = $request->input('fechaIngreso');
        $liquidacionGenerada = $request->input('liquidacionGenerada');

        $guest = ($request->input('usuario_id') > 0) ? $request->input('usuario_id') : true;

        $modelo_empresa = \App\Empresa::updateOrCreate(
            [ 'rutEmpresa' => $rutEmpresa ],
            [ 'razonSocial' => $razonSocial , 'rutEmpresa' => $rutEmpresa, 'guest' => $guest, 'user_id' => $request->input('usuario_id')]
        );


        $modelo_trabajador = \App\Trabajador::updateOrCreate(
            [ 'rut' => $rutTrabajador ],
            [   'rut' => $rutTrabajador , 
                'nombre' => $nombreTrabajador, 
                'apellidos' => $apellidosTrabajador,
                'cargo' => $CargoTrabajador,
                'establecimiento' => $sucursal,
                'fechaIngreso' => $fechaIngreso,
                'direccionEstablecimiento' => $DireccionSucursal,
                'empresas_id' => $modelo_empresa->id
            ]
        );


        $modelo_liquidacion = \App\LiquidacionesRealizadas::updateOrCreate(
            ['id' => $liquidacionGenerada['_idPdf']],

            [
                'trabajadors_id' => $modelo_trabajador->id


            ]


        );

        // return id_liquidacion para generar pdf
        return $liquidacionGenerada['_idPdf'];

    }
}
