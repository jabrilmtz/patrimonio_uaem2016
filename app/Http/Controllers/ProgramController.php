<?php

namespace App\Http\Controllers;

use App\Entities\Program;
use Illuminate\Http\Request;
use Session;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs = Program::all();
        return view('programs.index')->with('programs',$programs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('programs.create');
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
            'branch' => 'required',
            'modality' => 'required',
        ]);

        // Se crea una variable de tipo Programa
        $program =  new Program();
        // Se empiezan a guardar los datos del request en el modelo
        $program->name = $request->name;
        $program->branch = $request->branch;
        $program->modality = $request->modality;
        $program->description = $request->description;

        //Se redirecciona y se envía el resultado de la solicitud
        if($program->save()){
            Session::flash('save','Se ha agregado correctamente el programa académico');
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
        $program = Program::find($id);
        return view('programs.update')->with('program',$program);
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
            'branch' => 'required',
            'modality' => 'required',
        ]);

        // Se crea una variable de tipo Programa
        $program =  Program::find($id);
        // Se empiezan a guardar los datos del request en el modelo
        $program->name = $request->name;
        $program->branch = $request->branch;
        $program->modality = $request->modality;
        $program->description = $request->description;

        //Se redirecciona y se envía el resultado de la solicitud
        if($program->save()){
            Session::flash('update','Se ha modificado correctamente el programa académico');
            return redirect('program');
        }else{
            Session::flash('error','¡Lo sentimos! Ocurrio un error');
            return redirect('program');
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
        if(Program::destroy($id)){
            Session::flash('delete','Se ha eliminado correctamente el programa académico');
            return redirect('program');
        }else{
            Session::flash('error','¡Lo sentimos! Ocurrio un error');
            return redirect('program');
        }
    }
}
