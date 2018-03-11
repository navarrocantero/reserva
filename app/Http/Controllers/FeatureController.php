<?php

namespace App\Http\Controllers;

use App\House;
use Illuminate\Http\Request;
use App\Feature;

class FeatureController extends Controller
{
   public function index(Request $request){

       $featureSlugNameUrl = str_replace("feature/", "", $request->path());
       $feature = (Feature::where('slugname', $featureSlugNameUrl)->firstOrFail()) ;
       $houses = $feature->houses()->get();

       return view('feature.show', [
               "houses" => $houses,
               "features"=> $feature
           ]
       );

   }

    /**
     * Devuelve todos los nombres de caracteristicas
     * @return string
     */
   public function api(){
       $feature = Feature::all(['slugname']);
       return json_encode($feature);
   }
}
