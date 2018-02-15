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

// FEATURES routes
Route::get('/feature/{slugname}', "FeatureController@index");


// COMMENTS routes
Route::post('/house/{slugname}/validate', "CommentController@validateAjax")->middleware('auth');
Route::post('/house/{slugname}/comment', "CommentController@store")->middleware('auth');

// Asynchronus Validation Routes
Route::post('/add/validate', "HouseController@validateAjax")->middleware('auth');


// RESERVE routes
Route::post('house/{slugname}/reserve', "ReserveController@validateAjax")->middleware('auth');
Route::post('house/{slugname}/confirm', "ReserveController@store")->middleware('auth');

// HOUSE routes
Route::get('/add', "HouseController@create")->middleware('auth');
Route::post('/add', "HouseController@store")->middleware('auth');
Route::get('house/{slugname}', "HouseController@show")->middleware('auth');


// Auth Routes
Auth::routes();

// Profile Routes
Route::get('/profile', 'UserController@index')->middleware('auth');
Route::get('/user/{slugname}', 'UserController@index');
