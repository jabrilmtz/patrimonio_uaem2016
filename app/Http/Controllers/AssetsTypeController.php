<?php

namespace App\Http\Controllers;

use App\Entities\AssetsType;
use Illuminate\Http\Request;
use Session;

class AssetsTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assets_types = AssetsType::all();
        return view('assets_types.index')->with('assets_types',$assets_types);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('assets_types.create');
    }

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
            'percentage' => 'required|numeric|between:1,100',
        ]);

        // Se crea una variable del Tipo de bien
        $assets_type =  new AssetsType();
        // Se empiezan a guardar los datos del request en el modelo
        $assets_type->name =$request->name;
        $assets_type->percentage =$request->percentage;
        $assets_type->useful_life = 100/$request->percentage;

        //Se redirecciona y se envía el resultado de la solicitud
        if($assets_type->save()){
            Session::flash('save','Se ha registrado correctamente el tipo de activo');
            return back();
        }else{
            Session::flash('error','¡Lo sentimos! Ocurrio un error');
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $assets_type = AssetsType::find($id);
        return view('assets_types.update')->with('assets_type',$assets_type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Se validan los datos ingresados
        $this->validate($request, [
            'name' => 'required',
            'percentage' => 'required|numeric|between:1,100',
        ]);

        // Se crea una variable del Tipo de activo
        $assets_type = AssetsType::find($id);
        // Se empiezan a guardar los datos del request en el modelo
        $assets_type->name =$request->name;
        $assets_type->percentage =$request->percentage;
        $assets_type->useful_life = 100/$request->percentage;

        //Se redirecciona y se envía el resultado de la solicitud
        if($assets_type->save()){
            Session::flash('update','Se ha modificado correctamente el tipo de activo');
            return redirect('assetsTypes');
        }else{
            Session::flash('error','¡Lo sentimos! Ocurrio un error');
            return redirect('assetsTypes');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Se redirecciona y se envía el resultado de la solicitud
        if(AssetsType::destroy($id)){
            Session::flash('delete','Se ha eliminado correctamente el tipo de activo');
            return redirect('assetsTypes');
        }else{
            Session::flash('error','¡Lo sentimos! Ocurrio un error');
            return redirect('assetsTypes');
        }
    }
}
