<?php

namespace App\Http\Controllers;

use App\Entities\Asset;
use App\Entities\AssetsType;
use App\Entities\Brand;
use App\Entities\Employee;
use App\Entities\Incidence;
use App\Entities\IncidencesType;
use App\Entities\Program;
use App\Entities\Provider;
use App\Entities\Role;
use App\Entities\Status;
use App\Entities\Unit;
use App\Entities\UsersRole;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;
use Session;

class ExcelController extends Controller
{
    public function excelImport(){
        if (Input::file('excel1')!=""){
            Excel::selectSheets('assets')->load(Input::file('excel1'),function ($reader){
                $reader->each(function ($sheet){
                    foreach ($sheet->toArray() as $row){
                        if(!Asset::firstOrCreate($sheet->toArray())){
                            Session::flash('error','No se puede importar, no se ha seleccionado ningun archivo.');
                        }
                    }
                });
            });
        }else{
            Session::flash('error','No se puede importar, no se ha seleccionado ningun archivo.');
            return back();
        }
    }

    public function excelExport(){
        // Se extraen las tablas de la BD
        $brands = Brand::select('name')->get();
        $employees = Employee::select('name','surname', 'code', 'email')->get();
        $incidencesT = IncidencesType::select('name')->get();
        $incidences = Incidence::select('image','comment', 'incidence_type_id', 'asset_id', 'created_at', 'updated_at')->get();
        $programs = Program::select('name','description')->get();
        $provider = Provider::select('name','email', 'code')->get();
        $units = Unit::select('id','code', 'name', 'location', 'employee_id')->get();
        $assets_types = AssetsType::select('name','percentage', 'useful_life')->get();
        $assets = Asset::select('asset_code','name', 'description','serial_number', 'model', 'original_cost',
            'actual_cost', 'image', 'assign_date', 'comment', 'category', 'brand_id', 'program_id', 'provider_id',
            'status_id', 'unit_id', 'user_id', 'asset_type_id')->get();

        // Se comienza a crear el archivo
        // se le da un 'nombre' y se le envían los datos
        Excel::create('SP_UAEM_Datos',function ($excel) use($brands,$employees, $incidencesT, $incidences, $programs,
            $provider, $units, $assets_types, $assets){
            //Se comienzan a crear cada una de las hojas del archivo
            $excel->sheet('brands',function ($sheet) use($brands){
                $sheet->fromArray($brands);
            });
            $excel->sheet('employees',function ($sheet) use($employees){
                $sheet->fromArray($employees);
            });
            $excel->sheet('incidences_types',function ($sheet) use($incidencesT){
                $sheet->fromArray($incidencesT);
            });
            $excel->sheet('incidences',function ($sheet) use($incidences){
                $sheet->fromArray($incidences);
            });
            $excel->sheet('programs',function ($sheet) use($programs){
                $sheet->fromArray($programs);
            });
            $excel->sheet('providers',function ($sheet) use($provider){
                $sheet->fromArray($provider);
            });
            $excel->sheet('units',function ($sheet) use($units){
                $sheet->fromArray($units);
            });
            $excel->sheet('assets_types',function ($sheet) use($assets_types){
                $sheet->fromArray($assets_types);
            });
            $excel->sheet('assets',function ($sheet) use($assets){
                $sheet->fromArray($assets);
            });
        })->export('xls');
    }
}
