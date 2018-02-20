<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// HOME route
Route::get('/', "PagesController@index");

Route::get('/asyncLoad', 'PagesController@asyncLoad');


// FEATURES routes
Route::get('/feature/{slugname}', "FeatureController@index");

// Profile Routes
Route::get('/user/{slugname}', 'UserController@index');


// Auth Routes
Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    // Profile Routes
    Route::get('/profile', 'UserController@index');

    // HOUSE routes
    Route::get('/add', "HouseController@create");
    Route::post('/add', "HouseController@store");
    Route::get('house/{slugname}', "HouseController@show");

    // RESERVE routes
    Route::post('house/{slugname}/reserve', "ReserveController@validateAjax");
    Route::post('house/{slugname}/confirm', "ReserveController@store");

    // COMMENTS routes
    Route::post('/house/{slugname}/validate', "CommentController@validateAjax");
    Route::post('/house/{slugname}/comment', "CommentController@store");

    // Asynchronus Validation Routes
    Route::post('/add/validate', "HouseController@validateAjax");
});