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

Route::group(['middleware' => 'auth'], function () {

    Route::post('/add/validate', "HouseController@validateAjax"); // Ruta para validar casaas async
    // Profile Routes
    Route::patch('/profile', 'UserController@update');    // Actualiza la entidad usuario
    Route::patch('/profile/password', 'UserController@update');       // Actualiza los datos de acceso

    Route::get('/profile', 'UserController@index');      // Muestra el perfil privado de usuario
    Route::get('/profile/reserves', 'ReserveController@profile');   // Muestra las reservas del usuario
    Route::get('/profile/comments', 'CommentController@profile');  // Muestra los comentarios del usuario
    Route::get('/profile/password', 'UserController@profile');   // Muestra los datos de acceso
    Route::get('/profile/houses', 'HouseController@profile');   // Muestra casas del usuario
    Route::patch('/profile/houses/{id}', 'HouseController@profile');   // Edita la entidad casa

    Route::delete('/profile/houses/delete/{slugname}', 'HouseController@destroy'); // Destruye la entidad casa
    Route::delete('/profile/reserves/delete/{id}', 'ReserveController@destroy'); // Destruye la entidad reserva
    Route::delete('/profile/delete', 'UserController@destroy'); // Destruye la entidad usuario
    Route::delete('/profile/comment/delete', 'CommentController@destroy'); // Destruye la entidad comentario
    Route::get('/user/login', 'UserController@login');   // Metodo usado para redireccionar tras login


    // HOUSE routes
    Route::get('/add', "HouseController@create"); // Muestra el menu de añadir casa
    Route::post('/add', "HouseController@store"); // Crear casa
    Route::get('house/{slugname}', "HouseController@show"); // Muestra la entidad casa
    Route::get('/house/edit/{id}','HouseController@edit'); // Muestra los datos de la entidad casa
    Route::patch('/house/update/{id}','HouseController@update'); // Muestra los datos de la entidad casa
    // RESERVE routes
    Route::post('house/{slugname}/confirm', "ReserveController@store"); // Crea reserva

    // COMMENTS routes
    Route::post('/add/uploadImage', 'HouseController@uploadImage'); // Ruta para subir imagenes async
    Route::post('house/{slugname}/reserve', "ReserveController@validateAjax");  // Ruta para validar reservas async
    Route::post('/house/{slugname}/validate', "CommentController@validateAjax"); // Ruta para validar comentarios async
    Route::post('/profile/comments/async', "CommentController@validateAjax"); // Ruta para validar comentarios del usuario async
    Route::post('/profile/comments/async/update', "CommentController@updateAjax"); // Ruta para actualicar comentarios del usuario async

    Route::post('/house/{slugname}/comment', "CommentController@store"); // Crea comentario
    Route::get('/comment/edit/{id}', "CommentController@edit"); // Edita comentario
    Route::patch('/comment/update/{id}', "CommentController@update")->name('comment.patch'); // Actualiza comentario


});


// HOME route
Route::get('/', "PagesController@index")->name('home'); // Ruta raiz
Route::get('/home', "PagesController@index"); // Ruta raiz
Route::get('/500', "PagesController@get500"); // Devuelve el error 500

Route::get('/asyncLoad', 'PagesController@asyncLoad'); // Ruta para paginar async


// FEATURES routes
Route::get('/feature/{slugname}', "FeatureController@index"); // Muestra la entidad caracteristica

// Profile Routes
Route::get('/user/{slugname}', 'UserController@index'); // Muestra el perfil publico de usuario


// Auth Routes
Auth::routes();
 

