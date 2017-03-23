<?php

namespace App\Http\Controllers;

use App\Entities\Asset;
use App\Entities\Unit;
use Illuminate\Http\Request;
use Session;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::all();
        return view('reports.index')->with('units',$units);
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
            'unit_id' => 'required|exists:units,id',
        ]);

        // Se extrae la información de la base de datos, haciendo uniones con las demás tablas
        $assets = Asset::all()->where('unit_id', '==', $request->unit_id);

        if (count($assets) == 0) {
            Session::flash('error','¡Lo sentimos! No existe información suficiente para generar el reporte.');
            return redirect('reports');
        } else {
            $units = Unit::all();
            return view('reports.generate')->with('units',$units)->with('unit_id',$request->unit_id);
        }
    }

}
