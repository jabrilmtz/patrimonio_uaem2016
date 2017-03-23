<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |    I N I C I O    D E     S E S I Ó N
    | Este controlador gestiona la autenticación de los usuarios para la aplicación
    | y los redirecciona a su pantalla de inicio. El controlador utiliza un rasgo
    | para proporcionar convenientemente su funcionalidad a sus aplicaciones.
    */

    use AuthenticatesUsers;

    /**
     * Ruta a la cual se redireccionará el sistema después de "login" / "registration".
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Se crea una nueva instancia del controlador
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
}
