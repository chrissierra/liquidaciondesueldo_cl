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

Route::get('/', function () {
	//parametros_desde_bbdd

	$mes = date("n");

    return view('liquidoabase')
    ->with("parametros_desde_bbdd", App\table_parametro::All())
	    ->with("afps", App\afp::where('mes', $mes)
	    ->select('Provida', 'Capital', 'Cuprum', 'PlanVital', 'Uno', 'IPS', 'Modelo', 'Habitat')
	    ->first()->toJson()
	);
});


Route::get('/Inicio', function () {
	//parametros_desde_bbdd

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
    return view('importar');
});
Route::post('/MasivoCsvImportacion', 'masivosCsv@importandoCsv')->name("importacion.csv");