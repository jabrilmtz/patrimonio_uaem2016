<?php

namespace App\Http\Controllers;

use App\Entities\Employee;
use App\Entities\Unit;
use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use Storage;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::all();
        return view('units.index')->with('units',$units);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all();
        return view('units.create')->with('employees',$employees);
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
            'code' => 'required|unique:units',
            'name' => 'required',
            'location' => 'required',
            'employee_id' => 'required|exists:employees,id',
        ]);

        // Se crea una variable de tipo Unit
        $unit =  new Unit();
        // Se empiezan a guardar los datos del request en el modelo
        $unit->code = $request->code;
        $unit->name =$request->name;
        $unit->location =$request->location;
        $unit->employee_id = $request->employee_id;

        //Se redirecciona y se envía el resultado de la solicitud
        if($unit->save()){
            Session::flash('save','Se ha registrado correctamente la unidad académica');
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
        $unit = Unit::find($id);
        $employees = Employee::all();
        return view('units.update')->with('unit',$unit)->with('employees',$employees);
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
            'location' => 'required',
        ]);

        // Se crea una variable de tipo Unit
        $unit = Unit::find($id);
        // Se empiezan a guardar los datos del request en el modelo
        $unit->code = $request->code;
        $unit->name =$request->name;
        $unit->location =$request->location;
        $unit->employee_id = $request->employee_id;

        //Se redirecciona y se envía el resultado de la solicitud
        if($unit->save()){
            Session::flash('update','Se ha modificado correctamente la unidad académica');
            return redirect('unit');
        }else{
            Session::flash('error','¡Lo sentimos! Ocurrio un error');
            return redirect('unit');
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
        if(Unit::destroy($id)){
            Session::flash('delete','Se ha eliminado correctamente la unidad académica');
            return redirect('unit');
        }else{
            Session::flash('error','¡Lo sentimos! Ocurrio un error');
            return redirect('unit');
        }
    }
}
