<?php

namespace App\Http\Controllers;


use App\Login;
use App\user;
Use Imgur\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUserRequest;
use App\House;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $user;
    private $imgur;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Uesr::create([
            'username' => $request->input('username'),
        ]);
    }

    public function update(UpdateUserRequest $request)
    {

        $path = $request->path();
        $user = $this->user;
        if ($path === 'profile') {
            $data = array_filter($request->all());
            $user = User::findOrFail($user->id);
            $user->fill($data);
        } elseif ($path === 'profile/password') {

            if (!Hash::check($request->input('current_password'), $user->password)) {
                return redirect()->back()->with('error', 'La constraseña actual no es correcta');
            }
            if (strcmp($request->input('current_password'), $request->get('password')) == 0) {
                return redirect()->back()->with('error', 'La nueva contraseña debe ser diferente de la antigua.');
            }
            if (strcmp($request->input('password'), $request->get('password_confirmation')) !== 0) {
                return redirect()->back()->with('error', 'Las contraseña de confirmarcion no coincide.');
            }

            $user->password = bcrypt($request->input('password'));
        }
        $user->save();
        return redirect()
            ->back()
            ->with('success', 'Datos actualizados');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\user $user
     * @return \Illuminate\Http\Response
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

//    Public profile info request for ALL users
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

//    Private profile info request only AUTH users
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

    public function profile(Request $request)
    {
        $user = $request->user();
        return view('user.profile',
            [
                'user' => $user
            ]
        );
    }

    public function destroy()
    {
        $this->user->delete();

        return redirect()->route('home')->with('success', 'Cuenta eliminada con exito');;
    }

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
