<?php

namespace App\Http\Controllers;


use App\Login;
use App\user;
Use Imgur\Client;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUserRequest;
use App\House;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $user;
    private $imgur;

    /**
     * Se inicializa un usuario autenticado y se le añade un perfil de imgur (para su posterior subida a la nube)
     * UserController constructor.
     */
    public function __construct()
    {
        $this->imgur = new \Imgur\Client();
        $this->imgur->setOption('client_id', '62dd16fbdeacb6c');
        $this->imgur->setOption('client_secret', '1e9272a28bfac0ba0ebc604b19add6f952ae8a4d');


        $this->middleware(function ($request, $next) {


            if (isset($_SESSION['token'])) {
                $this->setAccessToken($_SESSION['token']);

                if ($this->imgur->checkAccessTokenExpired()) {
                    $this->imgur->refreshToken();
                }
            } elseif (isset($_GET['code'])) {

                $this->imgur->requestAccessToken($_GET['code']);
                $_SESSION['token'] = $this->imgur->getAccessToken();
            }
            $this->user = auth()->user();
            return $next($request);
        });
    }

    /**
     * Devuelve la vista de registro para un nuevo usuario
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Metodo para crear un usuario
     * @param Request $request
     */
    public function store(Request $request)
    {

        Uesr::create([
            'username' => $request->input('username'),
        ]);
    }

    /**
     * Metodo para actualizar tanto el usuario como sus datos de acceso
     * @param UpdateUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserRequest $request)
    {
        $path = $request->path();
        $user = $this->user;
        if ($path === 'profile') {
            $data = array_filter($request->all());
            $user = User::findOrFail($user->id);
            $user->fill($data);
        } elseif ($path === 'profile/password') {


            if( ! Hash::check($request->get('current_password'), $this->user->password ) ){
                return redirect()->back()->with('error', 'La constraseña actual no es correcta');
            }
            if( strcmp($request->get('current_password'), $request->get('password')) == 0){
                return redirect()->back()->with('error', 'La nueva contraseña debe ser diferente de la antigua.');
            }
            $this->user->password = bcrypt($request->get('password'));
        }
        $user->save();
        return redirect()
            ->back()
            ->with('success', 'Datos actualizados');

    }

    /**
     * Muestra la vista del menu del perfil de usuario
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $userLogged = ($request->user());
        $userNameURL = str_replace("user/", "", $request->path());

        if ($userLogged !== $userNameURL && $userNameURL !== "profile") {
            return $this->showPublic($userNameURL);

        } else {
            return $this->showPrivate($userLogged);
        }
    }

    /**
     * Muestra la vista publica de un usuario
     * @param String $slugname
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPublic(String $slugname)
    {
        $user = (User::where('slugname', $slugname)->firstOrFail());
        if ($user == null) {
            return view('user.error', [
                "user" => $user
            ]);
        } else {
            $houses = House::where('user_id', $user->id)->paginate(9);

            return view('user.profile', [
                "user" => $user,
                'houses' => $houses
            ]);
        }

    }

    /**
     * Muestra la vista privada de un usuario
     * @param user $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPrivate(User $user)
    {
        $avatar = $user->image()->first()['image_url'];
        $imageData = [
            'image' => $avatar,
            'type' => 'url',
        ];

//        $uploadImg = $this->imgur->api('image')->upload($imageData);
        $houses = House::where('user_id', $user->id)->paginate(9);
        return view('user.profile', [
            "user" => $user,
            'houses' => $houses,
            'avatar' => $avatar
        ]);
    }

    /**
     * Muestra el menu privado de un usuario
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile(Request $request)
    {
        $user = $request->user();
        return view('user.profile',
            [
                'user' => $user
            ]
        );
    }

    /**
     * Destruye un usuario
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {
        $this->user->delete();

        return redirect()->route('home')->with('success', 'Cuenta eliminada con exito');;
    }

    /**
     * Metodo que se activa tras logearse para guardar su datos de logeo y redireccionarlo
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {

        $ip = $request->ip();
        $userId = $this->user->id;
        $agent = ($request->server->getHeaders())['USER_AGENT'];
        Login::create([
            'user_ip' => $ip,
            'user_id' => $userId,
            'user_agent' => $agent,
            'created_at' => now()
        ]);
        return redirect()->back();
    }
}
