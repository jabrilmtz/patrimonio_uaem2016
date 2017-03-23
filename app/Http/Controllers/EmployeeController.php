<?php

namespace App\Http\Controllers;

use App\Entities\Employee;
use Illuminate\Http\Request;
use Session;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index')->with('employees',$employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
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
            'surname' => 'required',
            'email' => 'required|email|unique:employees',
            'code' => 'required|unique:employees',
        ]);

        // Se crea una variable de tipo Encargado
        $employee =  new Employee();
        // Se empiezan a guardar los datos del request en el modelo
        $employee->name = $request->name;
        $employee->surname = $request->surname;
        $employee->email = $request->email;
        $employee->code = $request->code;

        //Se redirecciona y se envía el resultado de la solicitud
        if($employee->save()){
            Session::flash('save','Se ha agregado correctamente el encargado');
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
        $employee = Employee::find($id);
        return view('employees.update')->with('employee',$employee);
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
            'surname' => 'required',
            'email' => 'required|email',
        ]);

        // Se crea una variable de tipo Encargado
        $employee = Employee::find($id);
        // Se empiezan a guardar los datos del request en el modelo
        $employee->name = $request->name;
        $employee->surname = $request->surname;
        $employee->email = $request->email;

        //Se redirecciona y se envía el resultado de la solicitud
        if($employee->save()){
            Session::flash('update','Se ha modificado correctamente el encargado');
            return redirect('employee');
        }else{
            Session::flash('error','¡Lo sentimos! Ocurrio un error');
            return redirect('employee');
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
        if(Employee::destroy($id)){
            Session::flash('delete','Se ha eliminado correctamente el empleado');
            return redirect('employee');
        }else{
            Session::flash('error','¡Lo sentimos! Ocurrio un error');
            return redirect('employee');
        }
    }
}
