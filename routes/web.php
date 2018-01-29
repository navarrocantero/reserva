<?php

use Faker\Generator as Faker;

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
Route::match(['get', 'post'], '/register/validar', 'Auth\RegisterController@validar');

// Auth Routes

//Route::get('/register',"UserController@create");
//Route::post('/register',"UserController@store");
Auth::routes();


Route::get('/user/{username}', 'UserController@showPublic');
Route::get('/profile', 'UserController@showPrivate')->middleware('auth');



//Route::get('/auth', "PagesController@auth");