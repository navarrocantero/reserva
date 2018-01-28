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
Route::get('/add', "HouseController@create");
Route::post('/add', "HouseController@store");


// Asynchronus Validation Routes
Route::match(['get', 'post'],'/register/validar', 'Auth\RegisterController@validar');

Auth::routes();



//Route::get('/auth', "PagesController@auth");