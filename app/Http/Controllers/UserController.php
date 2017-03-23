<?php

namespace App\Http\Controllers;

use App\Entities\Role;
use App\Entities\UsersRole;
use App\User;
use Illuminate\Http\Request;
use Storage;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create')->with('roles',$roles);
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
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => 'required|digits:10',
            'role_id' => 'required|exists:roles,id',
        ]);

        // Se crea una variable de tipo User
        $user =  new User();
        // Se empiezan a guardar los datos del request en el modelo
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        //Se redirecciona y se envía el resultado de la solicitud
        if($user->save()){
            // Se obtiene el último usuario agregado, para utilizar su id
            $new_user = User::all();
            $new_user = $new_user->last();

            // Se genera una nueva relación del usuario creado y su rol
            $user_rol = new UsersRole();
            $user_rol->role_id = $request->role_id;
            $user_rol->user_id = $new_user->id;
            $user_rol->phone = $request->phone;
            if($user_rol->save()){
                Session::flash('save','Se ha agregado correctamente el usuario');
                return back();
            }else{
                User::destroy($new_user->id);
            }
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
        $user = User::find($id);
        $user_role = UsersRole::find($id);
        $roles = Role::all();
        return view('users.update')->with('user',$user)->with('user_role',$user_role)->with('roles',$roles);
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
            'phone' => 'required|digits:10',
        ]);

        // Se crea una variable de tipo User
        $user = User::find($id);
        // Se empiezan a guardar los datos del request en el modelo
        $user->name = $request->name;
        $user->email = $request->email;

        //Se redirecciona y se envía el resultado de la solicitud
        if($user->save()){
            // Se genera una nueva relación del usuario creado y su rol
            $user_rol = UsersRole::find($id);
            if ($request->option_update == 1) {
                $user_rol->role_id = $request->role_id;
            }
            $user_rol->phone = $request->phone;
            $user_rol->save();
            if ($request->option_update == 1) {
                Session::flash('update','Se ha modificado correctamente el usuario');
                return redirect('users');
            }else{
                Session::flash('update','Se ha modificado correctamente el usuario');
                return back();
            }
        }else{
            Session::flash('error','¡Lo sentimos! Ocurrio un error');
            return back();
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
        if(UsersRole::destroy($id)){
            User::destroy($id);
            Session::flash('delete','Se ha eliminado correctamente el usuario');
            return redirect('users');
        }else{
            Session::flash('error','¡Lo sentimos! Ocurrio un error');
            return redirect('users');
        }
    }
}
