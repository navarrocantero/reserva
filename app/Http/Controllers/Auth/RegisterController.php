<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    protected function validar(Request $request)
    {
        $data = $request->all();
        $errores = array();
        $errores["name"] = array();
        $errores["email"] = array();
        $errores["name"] = $this->validarNombre(trim($data["name"]));


        echo json_encode($errores);


    }

    private function validarNombre($nombre)
    {
        $errores = array();

        if ($nombre !== "") {

            if (strlen($nombre) < 4) {
                $errores[] = "El nombre debe tener al menos 4 caracteres";
            }
            if (!preg_match("/^[A-Za-z]*$/", $nombre)) {
                $errores[] = "EL nombre sólo puede contener letras";
            }
        } else {
            $errores[] = "EL nombre esta no puede estar vacío";
        }
        return $errores;
    }

    function validarEmail($email)
    {
        $errores = array();
        if (strlen($email) < 6) {
            $errores[] = "El email debe ser mayo a 6 caracteres";
        }
        return $errores;
    }
}
