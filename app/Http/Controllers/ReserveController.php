<?php

namespace App\Http\Controllers;

use App\House;
use App\Http\Requests\CreateReserveRequest;
use App\Reserve;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;


class ReserveController extends Controller
{

    public function store(Request $request){
        $user = $request->user();
        $houseNameUrl = str_replace(["house/", "/confirm"], "", $request->path());
        $house = House::where('slugname', $houseNameUrl)->first();
 

         Reserve::create([
             'user_id'=> $user->id,
             'house_id'=> $house->id,
             'entry_date' => Carbon::parse(request()->input('entryDate')),
             'exit_date' => Carbon::parse(request()->input('exitDate'))
         ]);
         return back();
    }
    /**Coje el nombre de la casa por la URL y comprueba que no este ocupada entre las fechas introducidas por el
     * usuario
     * @param Request $request
     * @return array|string
     */
    public function validateAjax(Request $request)
    {
        $houseNameUrl = str_replace(["house/", "/reserve"], "", $request->path());
        $house = House::where('slugname', $houseNameUrl)->first();
        $entryDate = ($_POST['entryDate']);
        $exitDate = ($_POST['exitDate']);
        $checkActualReserve = $house->reserves()->whereBetween('entry_date', array($entryDate, $exitDate))->get();
        if (sizeof($checkActualReserve) !== 0) {
            return array("invalid");
        } else {
            return array();
        }
    }
}

