<?php

namespace App\Http\Controllers;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;
class masivosCsv extends Controller
{
    //
    public function importandoCsv(Request $request){
    	
    	$archivo = $request->file('csv');

    	$collection = (new UsersImport)->toCollection($archivo);

        /*foreach ($collection as $key => $value) {
            # code...
            foreach ($value as $key => $valor2) {
                # code...
                echo $valor2['nombre'] . "<br>";
            }
        } */

       return view('ProcesadoImportacionCsv')
       ->with("datos", $collection->toJson())
        ->with("parametros_desde_bbdd", \App\table_parametro::All()
            );

    }




}








class UsersImport implements ToModel,WithCustomCsvSettings, WithHeadingRow,  ToCollection
{
    use Importable;

    public function model(array $row)
    {
        return new User([
            'name' => $row[0],
        ]);
    }


     public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }


    public function collection(Collection $rows)
    {
        return $rows;
    }
}
