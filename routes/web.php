<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
Route::get('/', function (Request $request) {
	//parametros_desde_bbdd

	$mes = date("n");
	
	SEO::setTitle('Calcular sueldo. Como hacer una liquidacion de sueldo chile');
    SEO::setDescription('Calcular sueldo liquido. Como hacer una liquidacion de sueldo paso a paso, desde un formulario de la forma mas simple. Ingresa el sueldo líquido pactado y obtendrás el sueldo base y todos los demás componentes de tu liquidación.');
    SEO::opengraph()->setUrl('https://liquidaciondesueldo.cl');
    SEO::setCanonical('https://liquidaciondesueldo.cl');
    SEO::opengraph()->addProperty('type', 'articles');
    SEO::twitter()->setSite('@Liquidaciondesueldo');

    


    return view('liquidoabase')
    ->with("parametros_desde_bbdd", App\table_parametro::All())
	->with("afps", App\afp::where('mes', $mes)
	    ->select('Provida', 'Capital', 'Cuprum', 'PlanVital', 'Uno', 'IPS', 'Modelo', 'Habitat')
	    ->first()->toJson()
	);
});


Route::get('/Inicio', function () {
	//parametros_desde_bbdd

	SEO::setTitle('Calcular sueldo liquido. Como hacer una liquidacion de sueldo chile');
    SEO::setDescription('Como hacer una liquidacion de sueldo paso a paso, desde un formulario de la forma mas simple. Ingresa el sueldo líquido pactado y obtendrás el sueldo base y todos los demás componentes de tu liquidación.');
    SEO::opengraph()->setUrl('https://liquidaciondesueldo.cl');
    SEO::setCanonical('https://liquidaciondesueldo.cl');
    SEO::opengraph()->addProperty('type', 'articles');
    SEO::twitter()->setSite('@Liquidaciondesueldo');

	$mes = date("n");

    return view('liquidoabase')
    ->with("parametros_desde_bbdd", App\table_parametro::All())
	    ->with("afps", App\afp::where('mes', $mes)
	    ->select('Provida', 'Capital', 'Cuprum', 'PlanVital', 'Uno', 'IPS', 'Modelo', 'Habitat')
	    ->first()->toJson()
	);
});


Route::get('/BaseaLiquido', function () {
	//parametros_desde_bbdd

    SEO::setTitle('Calculo liquidacion de sueldo. Como hacer una liquidacion de sueldo chile. Calcular sueldo liquido');
    SEO::setDescription('Calcular sueldo liquido. Como hacer una liquidacion de sueldo paso a paso, desde un formulario de la forma mas simple. Ingresa el sueldo base y obtendrás el sueldo líquido y todos los demás componentes de tu liquidación.');
    SEO::opengraph()->setUrl('https://liquidaciondesueldo.cl');
    SEO::setCanonical('https://liquidaciondesueldo.cl');
    SEO::opengraph()->addProperty('type', 'articles');
    SEO::twitter()->setSite('@Liquidaciondesueldo');



	$mes = date("n");

    return view('basealiquido')
    ->with("parametros_desde_bbdd", App\table_parametro::All())
	    ->with("afps", App\afp::where('mes', $mes)
	    ->select('Provida', 'Capital', 'Cuprum', 'PlanVital', 'Uno', 'IPS', 'Modelo', 'Habitat')
	    ->first()->toJson()
	);
});

Route::get('/testeo2', function () {
    return view('test2');
});


Route::get('/Importando', function () {
	SEO::setTitle('Calculo liquidacion de sueldo masivo. Como hacer una liquidacion de sueldo chile');
    SEO::setDescription('Calcular sueldo liquido. Como hacer una liquidacion de sueldo paso a paso. Podrás ingresar un archivo csv con tus trabajadores y obtener el sueldo completo más la liquidación en pdf de cada uno.');
    SEO::opengraph()->setUrl('https://liquidaciondesueldo.cl');
    SEO::setCanonical('https://liquidaciondesueldo.cl');
    SEO::opengraph()->addProperty('type', 'articles');
    SEO::twitter()->setSite('@Liquidaciondesueldo');
    return view('importar');

})->middleware('auth');


Route::post('/MasivoCsvImportacion', 'masivosCsv@importandoCsv')->name("importacion.csv");

Route::post('/ProcesarLiquidacionPdf', 'LiquidacionPdfController@procesarPdf');
Route::get('/Descargar_liquidacion/{id}', function ($id) {
       
    // Consultar base de datos, según el id de liquidacion . Usar esos datos para generar liquidacion.

    $modelo =  \App\LiquidacionesRealizadas::with('trabajador.empresa')->where('id', $id)->first();

    //dd($modelo);

    //return view('liquidacion_en_pdf', compact('modelo'));

    // \Dompdf\Options::$isHtml5ParserEnabled

    $pdf = PDF::loadView('liquidacion_en_pdf', compact('modelo'));

    return $pdf->stream('listado.pdf'); // SÍ USAR
    

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/IngresoImpuestos', function (Request $request) {
    
    return view('impuestos.IngresoImpuestos');

})->name('IngresoImpuestos');


Route::get('/IngresoAfp', function (Request $request) {
    
    return view('afp.ingresoAfps');

})->name('IngresoAfp');

Route::get('/IngresoParametros', function (Request $request) {
    
    return view('parametros_adicionales.ingresoParametros');

})->name('IngresoParametros');

Route::post('/IngresandoImpuestos', 'ImpuestosController@ingresarImpuestos')->name('IngresandoImpuestos');
Route::post('/IngresandoAfp', 'afpController@ingresarAfps')->name('IngresandoAfp');
Route::post('/IngresandoParametros', 'parametrosController@ingresarParametros')->name('IngresandoParametros');
Route::post('/GuardarDatosInvitadoLiquidacion', 'LiquidacionPdfController@GuardarDatosInvitadoLiquidacion')->name('GuardarDatosInvitadoLiquidacion');


Route::post('/GetTrabajadoresPorIdUsuario', 'EmpresaController@GetTrabajadoresPorIdUsuario');

