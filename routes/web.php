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
	
	SEO::setTitle('Calculo liquidacion de sueldo. Como hacer una liquidacion de sueldo chile');
    SEO::setDescription('Como hacer una liquidacion de sueldo paso a paso, desde un formulario de la forma mas simple. Ingresa el sueldo líquido pactado y obtendrás el sueldo base y todos los demás componentes de tu liquidación.');
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

	SEO::setTitle('Calculo liquidacion de sueldo. Como hacer una liquidacion de sueldo chile');
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

    SEO::setTitle('Calculo liquidacion de sueldo. Como hacer una liquidacion de sueldo chile');
    SEO::setDescription('Como hacer una liquidacion de sueldo paso a paso, desde un formulario de la forma mas simple. Ingresa el sueldo base y obtendrás el sueldo líquido y todos los demás componentes de tu liquidación.');
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
    SEO::setDescription('Como hacer una liquidacion de sueldo paso a paso. Podrás ingresar un archivo csv con tus trabajadores y obtener el sueldo completo más la liquidación en pdf de cada uno.');
    SEO::opengraph()->setUrl('https://liquidaciondesueldo.cl');
    SEO::setCanonical('https://liquidaciondesueldo.cl');
    SEO::opengraph()->addProperty('type', 'articles');
    SEO::twitter()->setSite('@Liquidaciondesueldo');
    return view('importar');
});
Route::post('/MasivoCsvImportacion', 'masivosCsv@importandoCsv')->name("importacion.csv");