<?php

namespace App\Http\Controllers;

use App\House;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateReserveRequest;
use App\Reserve;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReserveController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user();
        $houseNameUrl = str_replace(["house/", "/confirm"], "", $request->path());

        $house = House::where('slugname', $houseNameUrl)->first();

        $entryDate = ($request->input('entryDate'));
        $exitDate = ($request->input('exitDate'));
        $checkActualReserve = $house->reserves()->where('entry_date', '>=', $entryDate)
            ->where('entry_date', '<', $exitDate)->get();
        if ($checkActualReserve !== 0) {
            Reserve::create([
                'user_id' => $user->id,
                'house_id' => $house->id,
                'entry_date' => Carbon::parse($entryDate),
                'exit_date' => Carbon::parse($exitDate)
            ]);
            return back()->with('success', 'Reserva realizada con exito');

        }
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
        $checkActualReserve = $house->reserves()->where('entry_date', '>=', $entryDate)
            ->where('entry_date', '<', $exitDate)->get();
        if (sizeof($checkActualReserve) !== 0) {
            return array("invalid");
        } else {
            return array();
        }
    }

    public function api()
    {
        $houseId = $_GET['houseId'];
        $house = House::where(['slugname' => $houseId])->first();
        return json_encode(Reserve::houseReserves($house->id));
    }

    public function profile(Request $request)
    {
        $user = $request->user();

        $reserves = Reserve::where('user_id', $user->id)->get();
        return view('user.profile',
            [
                'reserves' => $reserves,
                'user' => $user
            ]
        );
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();
        $reserveId = str_replace("profile/reserves/delete/", "", $request->path());
        $reserve = Reserve::where(['id' => $reserveId])->firstOrFail();

        if ($reserve->user()->first()->id === $user->id) {
            $reserve->delete();
            return redirect()->back()->with('success', 'Reserva eliminada con exito');;
        } else {
            return redirect()->back()->with('error', 'No se ha eliminado la reserva');;

        }
    }
}
