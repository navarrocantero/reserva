<?php

use Illuminate\Http\Request;
use App\House;
use App\Reserve;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/houses', function () {
    return House::all();
});
Route::get('/reserves', 'ReserveController@api');


Route::get('/features', 'FeatureController@api');
