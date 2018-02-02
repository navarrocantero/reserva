<?php

namespace App\Http\Controllers;


use App\Http\Requests\CreateUserRequet;
use App\user;
use App\House;
use Illuminate\Http\Request;

class UserController extends Controller
{

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

    /**
     * Display the specified resource.
     *
     * @param  \App\user $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
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
    public function showPublic(String $userName)
    {

        $user = (User::where('username', $userName)->first());


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
}
