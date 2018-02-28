<?php

namespace App\Http\Controllers;


use App\user;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUserRequest;
use App\House;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
        $this->user = auth()->user();
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


            if (!Hash::check($request->get('current_password'), $user->password)) {
                return redirect()->back()->with('error', 'La constraseña actual no es correcta');
            }
            if (strcmp($request->get('current_password'), $request->get('password')) == 0) {
                return redirect()->back()->with('error', 'La nueva contraseña debe ser diferente de la antigua.');
            }
            if (strcmp($request->get('password'), $request->get('password_confirmation')) !== 0) {
                return redirect()->back()->with('error', 'Las contraseña de confirmarcion no coincide.');
            }

            $user->password = bcrypt($request->get('password'));
        }
        $user->save();
        return redirect()
            ->back()
            ->with('exito', 'Datos actualizados');

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
        $houses = House::where('user_id', $user->id)->paginate(9);
        return view('user.profile', [
            "user" => $user,
            'houses' => $houses
        ]);
    }

    public function profile()
    {
        return view('user.profile');
    }
}
