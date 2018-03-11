<?php

namespace App\Http\Controllers;

use App\House;

use Illuminate\Support\Facades\Auth;
use App\Reserve;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReserveController extends Controller
{
    /**
     * Metodo para crear una reserva de una casa solo si:
     * la fecha de entrada no esta ocupada o si se queda vacia ese dia
     * la fecha de salida no este ocupada por otro usuario
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Coje el nombre de la casa por la URL y comprueba que no este ocupada entre las fechas introducidas por el
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

    /**
     * Devuelve en formato Json todas las reservas de la casa, para su posterior tratamiento en cliente
     * @return string
     */
    public function api()
    {
        $houseId = $_GET['houseId'];
        $house = House::where(['slugname' => $houseId])->first();
        return Reserve::getJsonReserve($house);
    }

    /**
     * Devuelve la vista de menu del usuario con todas sus reservas
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

    /**
     * Destruye una reserva de un usuario, solo si le pertenece
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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
