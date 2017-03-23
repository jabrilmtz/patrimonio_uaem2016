<?php

namespace App\Http\Controllers;

use App\Entities\IncidencesType;
use Illuminate\Http\Request;
use Session;

class IncidenceTypeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Se validan los datos ingresados
        $this->validate($request, [
            'name' => 'required',
        ]);

        // Se crea una variable de tipo Incidence
        $incidenceType =  new IncidencesType();
        // Se empiezan a guardar los datos del request en el modelo
        $incidenceType->name = $request->name;
        //Se redirecciona y se envía el resultado de la solicitud
        if($incidenceType->save()){
            Session::flash('save','Se ha agregado correctamente el tipo de incidencia');
            return back();
        }else{
            Session::flash('error','¡Lo sentimos! Ocurrio un error');
            return back();
        }
    }
}
