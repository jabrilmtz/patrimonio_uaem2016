<?php

namespace App\Http\Controllers\Auth;

use App\Entities\UsersRole;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |        C O N T R O L A D O R      N U E V O     U S U A R I O
    | Este controlador gestiona el registro de nuevos usuarios así como su validación y creación.
    | De forma predeterminada, este controlador utiliza un rasgo para proporcionar esta funcionalidad
    | sin necesidad de ningún código adicional.
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Creación de una nueva instancia del controlador
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Validar la información de una nueva solicitud de registro.
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|digits:10'
        ]);
    }

    /**
     * Creación de un nuevo usuario después de haber sido validada su información.
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        // Se obtiene el último usuario agregado, para utilizar su id
        $new_user = User::all();
        $new_user = $new_user->last();
        // Se genera una nueva relación del usuario creado y su rol
        $user_rol = new UsersRole();
        $user_rol->role_id = 2;
        $user_rol->user_id = $new_user->id;
        $user_rol->phone = $data['phone'];
        $user_rol->save();
        return $user;
    }
}
