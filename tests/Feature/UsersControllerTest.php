<?php

namespace Tests\Feature;

use App\Login;
use App\User;
use Faker\Factory;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersControllerTest extends TestCase
{
    /**
     * Muestra el perfil publico de usuario
     * Route::get /user/{slugname}
     * UserController@index
     */
    public function testIndexPublic()
    {
        $user = factory(User::class, 1)->create()->first();
        $response = $this->get('/user/' . $user->slugname);
        $response->assertStatus(200);
        $response->assertSee('Perfil Publico');
        gc_collect_cycles();

    }

    /**
     *  // Muestra el perfil privado de usuario
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
     * Metodo usado para redireccionar tras login
     * Route::get /user/login
     * UserController@login
     */
    public function testLogin()
    {

        $user = $this->logNewUser(new User());
        $userId = $user->id;
        $response = $this->get('/user/login');
        $assert = Login::where(['user_id' => $userId])->first();
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
     * Muestra los datos de acceso
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
     * Destruye la entidad usuario
     * Route::delete /profile/delete
     * UserController@destroy
     */
    public function testDelete()
    {
        $user = $this->logNewUser(new User());
        $response = ($this->delete('/profile/delete'));
        $response->assertStatus(302);

    }

    /**
     * Actualiza datos de acceso
     * Route::patch '/profile/password'
     * UserController@update
     */
    public function testUpdatePassword()
    {
        $user = $this->logNewUser(new User());
        $userId = $user->id;
        $newPass = 'secret';

        $response = $this->patch('/profile/password', [
            'current_password' => 'secret',
            'password' => $newPass,
            'password_confirmation' => $newPass,
        ]);

        $this->assertTrue(Hash::check($newPass, $user->password));
    }

    /**
     * Actualiza la entidad usuario
     * Route::patch 'profile
     * UserController@update
     */
    public function testUpdateData()
    {
        $user = $this->logNewUser(new User());
        $userId = $user->id;
        $faker = Factory::create();
        $firstname = $faker->firstName;
        $lastname = $faker->lastName;


        $response = $this->patch('/profile', [
            'name' => $firstname,
            'lastname' => $lastname,
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $userId,
            'name' => $firstname,
            'lastname' => $lastname,

        ]);
    }

}
