<?php

namespace App\Http\Controllers;

use App\Entities\Brand;
use Illuminate\Http\Request;
use Session;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('brands.index')->with('brands',$brands);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brands.create');
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
        ]);

        // Se crea una variable de tipo Encargado
        $brand =  new Brand();
        // Se empiezan a guardar los datos del request en el modelo
        $brand->name = $request->name;

        //Se redirecciona y se envía el resultado de la solicitud
        if($brand->save()){
            Session::flash('save','Se ha agregado correctamente la marca.');
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
        $brand = Brand::find($id);
        return view('brands.update')->with('brand',$brand);
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
        ]);

        // Se crea una variable de tipo Encargado
        $brand = Brand::find($id);
        // Se empiezan a guardar los datos del request en el modelo
        $brand->name = $request->name;

        //Se redirecciona y se envía el resultado de la solicitud
        if($brand->save()){
            Session::flash('update','Se ha modificado correctamente la marca');
            return redirect('brand');
        }else{
            Session::flash('error','¡Lo sentimos! Ocurrio un error');
            return redirect('brand');
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
        if(Brand::destroy($id)){
            Session::flash('delete','Se ha eliminado correctamente la marca');
            return redirect('brand');
        }else{
            Session::flash('error','¡Lo sentimos! Ocurrio un error');
            return redirect('brand');
        }
    }
}
