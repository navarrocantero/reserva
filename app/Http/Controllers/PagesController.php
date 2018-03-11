<?php

namespace App\Http\Controllers;

use App\Feature;
use App\House;
use Illuminate\Support\Facades\View;


class PagesController extends Controller
{
    /**
     * Pagina principal de la aplicacion con la lista de casas
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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



    protected function auth()
    {
        return view('auth');
    }

    /**
     * Metodo para paginar asincronamente
     * @return array
     */
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
