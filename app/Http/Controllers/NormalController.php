<?php

namespace App\Http\Controllers;

use App\Entities\Asset;
use App\Entities\AssetsType;
use App\Entities\Binnacle;
use App\Entities\Brand;
use App\Entities\Incidence;
use App\Entities\Program;
use App\Entities\Provider;
use App\Entities\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Session;

class NormalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Se extraen todos los bienes normales de la base de datos
        $assets = Asset::all();
        $assets = $assets->where('status_id','==','1');
        return view('assets.normal.index')->with('assets',$assets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
        $providers = Provider::all();
        $programs = Program::all();
        $units = Unit::all();
        $assets_types = AssetsType::all();
        return view('assets.normal.create')->with('brands',$brands)->with('providers',$providers)
            ->with('programs',$programs)->with('units',$units)->with('assets_types',$assets_types);
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
            'asset_code' => 'required|unique:assets',
            'name' => 'required',
            'serial_number' => 'required',
            'model' => 'required',
            'original_cost' => 'required|numeric',
            'image' => 'image',
            'brand_id' => 'required|exists:brands,id',
            'provider_id' => 'required|exists:providers,id',
            'program_id' => 'required|exists:programs,id',
            'unit_id' => 'required|exists:units,id',
            'asset_type_id' => 'required|exists:assets_types,id',
            'assign_date' => 'required|date|before:today',
        ]);

        // Se crea una variable de tipo Asset
        $asset =  new Asset();
        // Se empiezan a guardar los datos del request en el modelo
        $asset->asset_code = $request->asset_code;
        $asset->name = $request->name;
        $asset->description = $request->description;
        $asset->serial_number = $request->serial_number;
        $asset->model = $request->model;
        $asset->original_cost = $request->original_cost;
        $asset->actual_cost = $request->original_cost;
        $asset->comment = $request->comment;
        $asset->brand_id = $request->brand_id;
        $asset->program_id = $request->program_id;
        $asset->provider_id = $request->provider_id;
        $asset->unit_id = $request->unit_id;
        $asset->assign_date = $request->assign_date;
        $asset->status_id = "1";
        $asset->category = "Sin revisar";
        $asset->asset_type_id = $request->asset_type_id;
        $asset->user_id = Auth::user()->id;

        // Se obtiene y almacena la información de la imagen en caso de existir
        if ($request->file('image')!=""){
            $img = $request->file('image');
            $file_route = time().'_'.$img->getClientOriginalName();
            Storage::disk('imgAssets')->put($file_route, file_get_contents($img->getRealPath()));
            $asset->image = $file_route;
        }

        //Se redirecciona y se envía el resultado de la solicitud
        if($asset->save()){
            // Se obtiene el último usuario agregado, para utilizar su id
            $new_asset = Asset::all();
            $new_asset = $new_asset->last();

            // Se crea una variable de tipo Asset
            $binnacle =  new Binnacle();
            // Se empiezan a guardar los datos del request en el modelo
            $binnacle->asset_id = $new_asset->id;
            $binnacle->year = 0;
            $binnacle->anual_depreciation = 0;
            $binnacle->accumulated_depreciation = 0;
            $binnacle->value = $request->original_cost;
            $binnacle->save();
            Session::flash('save','Se ha agregado correctamente el bien');
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
        $asset = Asset::find($id);
        $brands = Brand::all();
        $providers = Provider::all();
        $programs = Program::all();
        $units = Unit::all();
        $assets_types = AssetsType::all();
        return view('assets.normal.update')->with('asset',$asset)->with('brands',$brands)->with('providers',$providers)
            ->with('programs',$programs)->with('units',$units)->with('assets_types',$assets_types);

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
            'serial_number' => 'required',
            'model' => 'required',
            'image' => 'image',
            'assign_date' => 'required|date|before:today',
        ]);

        // Se crea una variable de tipo Asset
        $asset =  Asset::find($id);
        // Se empiezan a guardar los datos del request en el modelo
        $asset->asset_code = $request->asset_code;
        $asset->name = $request->name;
        $asset->description = $request->description;
        $asset->serial_number = $request->serial_number;
        $asset->model = $request->model;
        $asset->actual_cost = $request->actual_cost;
        $asset->comment = $request->comment;
        $asset->brand_id = $request->brand_id;
        $asset->program_id = $request->program_id;
        $asset->provider_id = $request->provider_id;
        $asset->unit_id = $request->unit_id;
        $asset->assign_date = $request->assign_date;
        $asset->asset_type_id = $request->asset_type_id;

        // Se obtiene y almacena la información de la imagen en caso de existir
        if ($request->file('image')!=""){
            $img = $request->file('image');
            $file_route = time().'_'.$img->getClientOriginalName();
            Storage::disk('imgAssets')->put($file_route, file_get_contents($img->getRealPath()));
            $asset->image = $file_route;
        }

        //Se redirecciona y se envía el resultado de la solicitud
        if($asset->save()){
            Session::flash('update','Se ha modificado correctamente el bien');
            return redirect('normal');
        }else{
            Session::flash('error','¡Lo sentimos! Ocurrio un error');
            return redirect('normal');
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
        // Se eliminan los registros de depreciación que tengan relación con el bien
        $binnacles = Binnacle::all();
        $binnacles = $binnacles->where('asset_id','==',$id);
        foreach ($binnacles as $binnacle){
            Binnacle::destroy($binnacle->id);
        }
        // Se elimina los registros de incidencias que tengan relación con el bien
        $incidences = Incidence::all();
        $incidences = $incidences->where('asset_id','==',$id);
        foreach ($incidences as $incidence){
            Incidence::destroy($incidence->id);
        }
        //Se redirecciona y se envía el resultado de la solicitud
        if(Asset::destroy($id)){
            Session::flash('delete','Se ha eliminado correctamente el bien');
            return redirect('normal');
        }else{
            Session::flash('error','¡Lo sentimos! Ocurrio un error');
            return redirect('normal');
        }
    }

    /**
     * Método para cambiar de sin revisar a revisado el bien (escanear)
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function scan($id)
    {
        // Se crea una variable de tipo Asset
        $asset =  Asset::find($id);
        // Se empiezan a guardar los datos del request en el modelo
        $asset->category = "Revisado";
        if($asset->save()){
            Session::flash('update','Se ha escaneado correctamente el bien');
            return redirect('normal');
        }else{
            Session::flash('error','¡Lo sentimos! Ocurrio un error');
            return redirect('normal');
        }
    }
}
