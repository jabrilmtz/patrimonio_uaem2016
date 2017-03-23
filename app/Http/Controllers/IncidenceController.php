<?php

namespace App\Http\Controllers;

use App\Entities\Asset;
use App\Entities\Incidence;
use App\Entities\IncidencesType;
use Illuminate\Http\Request;
use Storage;
use Session;

class IncidenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incidences = Incidence::all();
        return view('incidences.index')->with('incidences',$incidences);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $assets = Asset::all();
        $incT = IncidencesType::all();
        return view('incidences.create')->with('assets',$assets)->with('incT',$incT);

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
            'comment' => 'required',
            'incidence_type_id' => 'required|exists:incidences_types,id',
            'asset_id' => 'required|exists:assets,id',
        ]);

        // Se crea una variable de tipo Incidence
        $incidence =  new Incidence();
        // Se empiezan a guardar los datos del request en el modelo
        $incidence->comment = $request->comment;
        $incidence->incidence_type_id = $request->incidence_type_id;
        $incidence->asset_id = $request->asset_id;
        $incidence->status = "0";

        // Se obtiene y almacena la información de la imagen en caso de existir
        if ($request->file('image')!=""){
            $img = $request->file('image');
            $file_route = time().'_'.$img->getClientOriginalName();
            Storage::disk('incidences')->put($file_route, file_get_contents($img->getRealPath()));
            $incidence->image = $file_route;
        }

        //Se redirecciona y se envía el resultado de la solicitud
        if($incidence->save()){
            Session::flash('save','Se ha registrado correctamente la incidencia');
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
        $incidence = Incidence::find($id);
        $assets = Asset::all();
        $incT = IncidencesType::all();
        return view('incidences.update')->with('assets',$assets)->with('incT',$incT)->with('incidence',$incidence);
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
        if ($request->option_update == '1') {
            // Se validan los datos ingresados
            $this->validate($request, [
                'comment' => 'required',
            ]);

            // Se crea una variable de tipo Asset
            $incidence = Incidence::find($id);

            // Se empiezan a guardar los datos del request en el modelo
            $incidence->comment = $request->comment;
            $incidence->incidence_type_id = $request->incidence_type_id;
            $incidence->asset_id = $request->asset_id;
            $incidence->status = $request->status;

            // Se obtiene y almacena la información de la imagen en caso de existir
            if ($request->file('image') != "") {
                $img = $request->file('image');
                $file_route = time() . '_' . $img->getClientOriginalName();
                Storage::disk('incidences')->put($file_route, file_get_contents($img->getRealPath()));
                $incidence->image = $file_route;
            }

            //Se redirecciona y se envía el resultado de la solicitud
            if ($incidence->save()) {
                Session::flash('update', 'Se ha modificado correctamente la incidencia');
                return redirect('incidence');
            } else {
                Session::flash('error', '¡Lo sentimos! Ocurrio un error');
                return redirect('incidence');
            }
        }else{
            // Se validan los datos ingresados
            $this->validate($request, [
                'name' => 'required',
                'serial_number' => 'required',
                'model' => 'required',
            ]);

            // Se crea una variable de tipo Asset
            $asset =  Asset::find($id);
            // Se empiezan a guardar los datos del request en el modelo
            $asset->name = $request->name;
            $asset->description = $request->description;
            $asset->serial_number = $request->serial_number;
            $asset->model = $request->model;
            $asset->comment = $request->comment;
            $asset->brand_id = $request->brand_id;
            $asset->program_id = $request->program_id;
            $asset->provider_id = $request->provider_id;
            if ($asset->status == '1' || $asset->status == '2') {
                $asset->unit_id = $request->unit_id;
            }
            $asset->asset_type_id = $request->asset_type_id;

            //Se redirecciona y se envía el resultado de la solicitud
            if($asset->save()){
                Session::flash('update','Se ha actualizado correctamente la información del bien');
                return redirect('incidence');
            }else{
                Session::flash('error','¡Lo sentimos! Ocurrio un error');
                return redirect('incidence');
            }
        }
    }
}
