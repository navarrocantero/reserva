<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Feature;
use App\House;
use App\Http\Requests\CreateHouseRequest;
use App\Http\Requests\CreateHouseAjaxRequest;
use App\User;
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

    public function show(Request $request)
    {
        $houseSlugNameUrl = str_replace("house/", "", $request->path());


        $house = (House::where('slugname', $houseSlugNameUrl)->firstOrFail());
        $features = $house->features()->get();
        $images = $house->images()->get();
        $comments = Comment::where('house_id', $house->id)->get();
        $commentsCustom = [];
        $loggedUserId = $request->user()->id;
        $commented = false;
        $i = 0;
        foreach ($comments as $comment) {
            $i++;
            $user = (User::where('id', $comment->user_id)->first());

            if ($user->id === $loggedUserId) {
                $commented = true;
            }

            $singleComment = [
                'user' => $user->slugname,
                'comment' => $comment->comment,
            ];

            $commentsCustom [$i] = $singleComment;
        }


        return view('house.show', [
            "house" => $house,
            "images" => $images,
            "comments" => $commentsCustom,
            "features" => $features,
            "commented" => $commented
        ]);
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
        $noImageUrl = "http://www.hotelsandholiday.com/wp-content/themes/hotel-holiday/images/no-image.jpg";
        $feature = $request->input('features');
        $image = ($request->input('images') ?? $noImageUrl);

        $house = House::create([
            'user_id' => $user->id,
            'name' => $request->input('name'),
            'slugname' => str_slug($request->input('name')),
            'location' => $request->input('location'),
            'direction' => $request->input('direction'),
            'price_user_night' => $request->input('price_user_night'),
            'rating' => $request->input('rating'),
            'max_users_house' => $request->input('max_users_house'),
            'description' => $request->input('description'),
        ]);

        $feature = Feature::create([
            'slugname' => $feature,
            'user_id' => $house->user_id,
            'house_id' => $house->id
        ]);

        $house->features()->sync($feature);


        return redirect('/');
    }

    protected function validateAjax(CreateHouseAjaxRequest $request)
    {

        //Obtenermos todos los valores y devolvemos un array vacio
        return array();
    }


}
