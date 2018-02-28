<?php

namespace App\Http\Controllers;

use App\Feature;
use App\House;
use Illuminate\Support\Facades\View;


class PagesController extends Controller
{
    protected function index()
    {
        $features = Feature::take('10')->get();

        $houses = House::orderBy('created_at', 'desc')->paginate(9);

        return view('home', [
                "houses" => $houses,
                "features" => $features
            ]
        );
    }

    protected function home(){
        return view('title');
    }

    protected function auth()
    {
        return view('auth');
    }

    public function asyncLoad()
    {

        if (request()->ajax()) {
            $houses = House::orderBy('created_at', 'desc')->paginate(9);
            return View::make('house.list', array('houses' => $houses))->render();
        }else{
              return array("jose"=>"no");
        }

    }
}
