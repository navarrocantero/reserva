<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Feature;
use App\House;
use App\HouseImage;
use App\Http\Requests\CreateHouseRequest;
use App\Http\Requests\CreateHouseAjaxRequest;
use App\Http\Requests\UpdateHouseRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


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
        return view('house.test');
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();
        $houseSlugNameUrl = str_replace("profile/houses/delete/", "", $request->path());
        $house = House::where(['slugname' => $houseSlugNameUrl])->firstOrFail();

        if ($house->user_id === $user->id) {
            $house->delete();
            return redirect()->back()->with('success', 'Casa eliminada con exito');;
        } else {
            return redirect()->back()->with('error', 'No se ha eliminado la casa');;

        }
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
        $features = (explode(',', $request->input('features')));


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

        $createImage = HouseImage::create([
            'image_url' => $image,
            'image_id' => mt_rand(0, 3000),
            'house_id' => $house->id,
        ]);

        foreach ($features as $feature) {
            $feature = Feature::firstOrCreate([
                'slugname' => $feature,
            ]);
            $house->features()->attach($feature);
        }

        return redirect('/');
    }

    /**
     * @param $results
     */
    public function eraseFields($results): void
    {
        unset($results{"_method"});
        unset($results{"_token"});
    }

    protected function validateAjax(CreateHouseAjaxRequest $request)
    {

        //Obtenermos todos los valores y devolvemos un array vacio
        return array();
    }

    public function uploadImage(Request $request)
    {

        return json_encode($request->file());
    }

    public function profile(Request $request)
    {
        $user = $request->user();
        $houses = $user->houses()->get();
        return view('user.profile',
            [
                'user' => $user,
                'houses' => $houses
            ]
        );
    }

    public function edit(Request $request)
    {

        $user = $request->user();

        $houseId = str_replace("house/edit/", "", $request->path());

        $house = House::where(['id' => $houseId])->firstOrFail();

        if ($house->user_id === $user->id) {
            return View::make('house.edit', ['house' => $house])->render();
        }
    }

    public function update(UpdateHouseRequest $request)
    {
        $results = array_filter($request->input());
        $this->eraseFields($results);
        $user = Auth::user();
        $houseId = str_replace(["house/update/"], "", $request->path());
        $house = House::where(['id' => $houseId])->firstOrFail();

        if ($house->user()->firstOrFail()->id === $user->id) {
            $house->update($results);
            return redirect()
                ->back()
                ->with('success', 'Datos actualizados');
        } else {
            return redirect()->back();
        }
    }
}
