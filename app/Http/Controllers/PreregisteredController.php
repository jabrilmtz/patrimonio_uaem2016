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
use Storage;
use Session;
use App\Http\Requests;

class PreregisteredController extends Controller
{
    /**
     * Mostrar el listado de los bienes en esta categoría.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Se extraen todos los registros en la tabla de Bienes que pertenezcan al tipo de bien
        $assets = Asset::all();
        $assets = $assets->where('status_id','==','2');
        // Se manda a llamar a la vista que presenta el listado de bienes
        return view('assets.preregistered.index')->with('assets',$assets);
    }

    /**
     * Mostrar el formulario para la creación de un nuevo pre-registro
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Se extraen todos los registros de las tablas en la base de datos
        $brands = Brand::all();
        $providers = Provider::all();
        $programs = Program::all();
        $units = Unit::all();
        $assets_types = AssetsType::all();
        // Se manda a llamar a la vista que presenta el formulario para modificar
        // y se envían las variables con todos los registros
        return view('assets.preregistered.create')->with('brands',$brands)->with('providers',$providers)
            ->with('programs',$programs)->with('units',$units)->with('assets_types',$assets_types);
    }

    /**
     * Almacenar el nuevo registro en la Base de datos
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
        $asset->status_id = "2";
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
     * Mostrar el formulario para modificar un registro en específico
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Se extraen todos los registros de las tablas en la base de datos
        $asset = Asset::find($id);
        $brands = Brand::all();
        $providers = Provider::all();
        $programs = Program::all();
        $units = Unit::all();
        $assets_types = AssetsType::all();
        // Se manda a llamar a la vista que presenta el formulario para modificar
        // y se envían las variables con todos los registros
        return view('assets.preregistered.update')->with('asset',$asset)->with('brands',$brands)
            ->with('providers',$providers)->with('programs',$programs)->with('units',$units)
            ->with('assets_types',$assets_types);
    }

    /**
     * Modificar el registro específico y guardar cambios en Base de datos
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
            return redirect('preregistered');
        }else{
            Session::flash('error','¡Lo sentimos! Ocurrio un error');
            return redirect('preregistered');
        }
    }

    /**
     * Eliminar un registro de la base de datos
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
            return redirect('preregistered');
        }else{
            Session::flash('error','¡Lo sentimos! Ocurrio un error');
            return redirect('preregistered');
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
            return redirect('preregistered');
        }else{
            Session::flash('error','¡Lo sentimos! Ocurrio un error');
            return redirect('preregistered');
        }
    }
}
