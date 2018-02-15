<?php

namespace App\Http\Controllers;

use App\Feature;
use App\House;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    protected function index()
    {
        $features = Feature::take('10')->get();

        $houses = House::orderBy('created_at', 'desc')->paginate(9);

        return view('home', [
                "houses" => $houses,
                "features"=> $features
            ]
        );
    }

    protected function auth()
    {
        return view('auth');
    }
}
