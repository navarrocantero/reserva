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

// Send data to PagesController, index Function
Route::get('/', "PagesController@index");
Route::get('/home', "PagesController@index");

Route::get('/auth', "PagesController@auth");

Route::get('/add', "HouseController@create");
Route::post('/add', "HouseController@store");
Auth::routes();


