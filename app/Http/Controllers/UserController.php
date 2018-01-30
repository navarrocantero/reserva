<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequet;
use App\user;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(CreateUserRequet $request)
    {

        Uesr::create([
            'name' => $request->input('name'),
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
            return view('user.profile', [
                "user" => $user
            ]);
        }

    }

//    Private profile info request only AUTH users

    public function showPrivate(User $user)
    {
        return view('user.profile', [
            "user" => $user
        ]);
    }
}
