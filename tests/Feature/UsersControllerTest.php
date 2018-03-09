<?php

namespace Tests\Feature;

use App\Login;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersControllerTest extends TestCase
{
    /**
     * Route::get /user/{slugname}
     * UserController@index
     */
    public function testIndexPublic()
    {
        $user = factory(User::class, 1)->create()->first();
        $response = $this->get('/user/' . $user->slugname);
        $response->assertStatus(200);
        $response->assertSee('Perfil Publico');
    }

    /**
     * Route::get /profile
     * UserController@index
     */
    public function testIndexPrivate()
    {

        $user = $this->logNewUser(new User());
        $this->assertAuthenticatedAs($user);
        $response = $this->get('/profile/' . $user->slugname);
        $response->assertSee('Mi perfil');


    }

    /**
     * Route::get /user/login
     * UserController@login
     */
    public function testLogin()
    {

        $user = $this->logNewUser(new User());
        $userId = $user->id;
        $response = $this->get('/user/login');
        $assert =Login::where(['user_id'=>$userId])->first();
        $this->assertTrue(isset($assert));

    }

    /**
     * Funcion  interna que crea, logea y devuelve a un usuario
     */
    private function logNewUser()
    {
        $user = factory(User::class, 1)->create()->first();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret',
        ]);
        return $user;
    }

    /**
     * Route::get /profile/password
     * UserController@profile
     */
    public function testPassword()
    {
        $user = $this->logNewUser(new User());
        $response = $this->get('/profile/password');
        $response->assertSee('Borrar Cuenta');

    }

    /**
     * Route::delete /profile/delete
     * UserController@destroy
     */
    public function testDelete()
    {
        $user = $this->logNewUser(new User());
        $response = ($this->delete('/profile/delete'));
        $response->assertStatus(302);

    }

}
