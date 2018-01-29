<?php

namespace App\Http\Controllers;

use App\House;
use App\Http\Requests\CreateHouseRequest;
use Illuminate\Http\Request;

class HouseController extends Controller
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
        return view('house.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateHouseRequest $request)
    {
        $user = $request->user();

        House::create([
            'user_id'=> $user->id,
            'name' => $request->input('name'),
            'location' => $request->input('location'),
            'direction' => $request->input('direction'),
            'price_user_night' => $request->input('price_user_night'),
            'users_comments' => $request->input('users_comments'),
            'rating' => $request->input('rating'),
            'max_users_house' => $request->input('max_users_house'),
            'features' => $request->input('features'),
            'activities' => $request->input('activities'),
            'description' => "$request->input('description')",
            'images' => $request->input('images'),
        ]);

        return redirect('/');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\House $house
     * @return \Illuminate\Http\Response
     */
    public
    function show(House $house)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\House $house
     * @return \Illuminate\Http\Response
     */
    public
    function edit(House $house)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\House $house
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, House $house)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\House $house
     * @return \Illuminate\Http\Response
     */
    public
    function destroy(House $house)
    {
        //
    }
}
