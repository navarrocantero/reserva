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
            'name'=> $request->input('name'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\user $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\user $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        //
    }

//    Public profile info request for ALL users

    public function showPublic(Request $request)
    {
        $userName = str_replace("user/", "", $request->path());
        $user = (User::where('username', $userName)->first());

        if($user == null){
            return view('user.error', [
                "user" => $user
            ]);
        }
        else{
            return view('user.profile', [
                "user" => $user
            ]);
        }

    }

//    Private profile info request only AUTH users

    public function showPrivate(Request $request)
    {
        return view('user.profile', [
            "user" => $request->user()
        ]);
    }
}
