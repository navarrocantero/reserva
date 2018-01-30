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

// Create and insert new HOUSE routes
Route::get('/add', "HouseController@create")->middleware('auth');
Route::post('/add', "HouseController@store")->middleware('auth');

// Asynchronus Validation Routes
Route::post('/add/validate', "HouseController@validateAjax")->middleware('auth');

// Auth Routes

Auth::routes();

// Profile Routes

Route::get('/profile', 'UserController@show')->middleware('auth');
Route::get('/user/{username}', 'UserController@show');
