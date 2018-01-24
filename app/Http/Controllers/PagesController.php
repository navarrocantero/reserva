<?php

namespace App\Http\Controllers;

use App\House;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    protected function index()
    {

        $houses = House::orderBy('created_at', 'desc')->paginate(10);

        return view('home', [
                "houses" => $houses
            ]
        );
    }

    protected function auth()
    {
        return view('auth');
    }
}
