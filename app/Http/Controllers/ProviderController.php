<?php

namespace App\Http\Controllers;

use App\Entities\Provider;
use Illuminate\Http\Request;
use Session;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Provider::all();
        return view('providers.index')->with('providers',$providers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('providers.create');
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
            'email' => 'required|email|unique:providers',
            'code' => 'required|unique:providers',
        ]);

        // Se crea una variable de tipo Proveedor
        $provider =  new Provider();
        // Se empiezan a guardar los datos del request en el modelo
        $provider->name = $request->name;
        $provider->email = $request->email;
        $provider->code = $request->code;

        //Se redirecciona y se envía el resultado de la solicitud
        if($provider->save()){
            Session::flash('save','Se ha agregado correctamente el proveedor');
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
        $provider = Provider::find($id);
        return view('providers.update')->with('provider',$provider);
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
            'email' => 'required|email',
        ]);

        // Se crea una variable de tipo Proveedor
        $provider = Provider::find($id);
        // Se empiezan a guardar los datos del request en el modelo
        $provider->name = $request->name;
        $provider->email = $request->email;

        //Se redirecciona y se envía el resultado de la solicitud
        if($provider->save()){
            Session::flash('update','Se ha modificado correctamente el proveedor');
            return redirect('provider');
        }else{
            Session::flash('error','¡Lo sentimos! Ocurrio un error');
            return redirect('provider');
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
        if(Provider::destroy($id)){
            Session::flash('delete','Se ha eliminado correctamente el proveedor');
            return redirect('provider');
        }else{
            Session::flash('error','¡Lo sentimos! Ocurrio un error');
            return redirect('provider');
        }
    }
}
