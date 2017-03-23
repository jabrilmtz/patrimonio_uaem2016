<?php

namespace App\Http\Controllers;

use App\Entities\Asset;
use App\Entities\AssetsType;
use App\Entities\Brand;
use App\Entities\Status;
use App\Entities\Unit;
use App\User;
use Illuminate\Http\Request;
use Excel;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::all();
        return view('inventories.index')->with('units',$units);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Se validan las fechas seleccionadas
        $this->validate($request, [
            'date_start' => 'required|date|before:today',
            'date_end' => 'required|date|after:date_start',
            'unit_id' => 'required|exists:units,id',
        ]);

        // Se extrae la información de la base de datos, haciendo uniones con las demás tablas
        $assets = Asset::join('brands', 'assets.brand_id', '=', 'brands.id')
            ->join('programs', 'assets.program_id', '=', 'programs.id')
            ->join('providers', 'assets.provider_id', '=', 'providers.id')
            ->join('statuses', 'assets.status_id', '=', 'statuses.id')
            ->join('units', 'assets.unit_id', '=', 'units.id')
            ->join('users', 'assets.user_id', '=', 'users.id')
            ->select('assets.asset_code as Código de barras', 'assets.name as Nombre',
                'assets.serial_number as Num_Serie', 'assets.model as Modelo', 'brands.name as Marca',
                'providers.name as Proveedor', 'programs.name as Programa', 'statuses.name as Estado',
                'assets.assign_date as Fecha registro', 'assets.category as Categoria',
                'assets.original_cost as Valor_original', 'assets.actual_cost as Valor_actual')
            ->where([
                ['assets.assign_date','>=',$request->date_start],
                ['assets.assign_date','<=',$request->date_end],
                ['assets.unit_id','=',$request->unit_id],
            ])->get();

        $cant_assets = count($assets);
        $cant_assets = $cant_assets+5;
        $celda = 'K'.$cant_assets;
        $celdaT = 'L'.$cant_assets;
        $cant_assets = $cant_assets+1;
        $celda2 = 'K'.$cant_assets;
        $celdaT2 = 'L'.$cant_assets;
        $tot_assets = 0;
        $tot_due = 0;

        foreach ($assets as $asset){
            // Se evalua si el bien ya fue revisado o no
            if ($asset->Categoria != 'Revisado'){
                // No ha sido revisado, por lo tanto es una deuda
                $tot_due = $tot_due + $asset->Valor_actual;
            }
            $tot_assets = $tot_assets + $asset->Valor_actual;
        }

        $unit = Unit::find($request->unit_id);

        // Se comienza a crear el archivo
        // se le da un 'nombre' y se le envían los datos
        Excel::create('Inventario_SP_UAEM',function ($excel) use($assets, $celda, $celdaT, $tot_assets, $celda2,
            $celdaT2, $tot_due, $unit){
            $excel->sheet('Bienes',function ($sheet) use($assets, $celda, $celdaT, $tot_assets, $celda2,
                $celdaT2, $tot_due, $unit){
                $sheet->cell('G1', function($cell) use($unit) {
                    $cell->setValue('Universidad Autónoma del Estado de Morelos');
                    $cell->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '12',
                        'bold'       =>  true
                    ));
                });
                $sheet->cell('G2', function($cell) use($unit) {
                    $cell->setValue($unit->name);
                    $cell->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '12',
                        'bold'       =>  true
                    ));
                });
                // Se asignan los registros a la hoja
                $sheet->fromArray($assets, null, 'A4', false, true);
                // Se le da un formato a los títulos
                $sheet->cells('A4:L4', function($cells) {
                    $cells->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '12',
                        'bold'       =>  true
                    ));
                    $cells->setAlignment('center');
                    $cells->setBackground('#D8D8D8');
                });
                $sheet->setBorder('A4:L4', 'thin');
                // Se le da un margen de página al archivo
                $sheet->setPageMargin(array(
                    0.25, 0.30, 0.25, 0.30
                ));
                $sheet->cell($celda, function($cell) {
                    $cell->setValue("TOTAL:");
                    $cell->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '12',
                        'bold'       =>  true
                    ));
                });
                $sheet->cell($celdaT, function($cell) use($tot_assets) {
                    $cell->setValue($tot_assets);
                    $cell->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '12',
                        'bold'       =>  true
                    ));
                });
                $sheet->cell($celda2, function($cell) {
                    $cell->setValue("Deuda:");
                    $cell->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '12',
                        'bold'       =>  true
                    ));
                });
                $sheet->cell($celdaT2, function($cell) use($tot_due) {
                    $cell->setValue($tot_due);
                    $cell->setFont(array(
                        'family'     => 'Calibri',
                        'size'       => '12',
                        'bold'       =>  true
                    ));
                });
            });

            $excel->setTitle('Inventario de bienes de la UAEM');
        })->export('xls');
    }
    /* Fin método store*/
}
