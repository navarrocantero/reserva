<?php

namespace Tests\Feature;

use App\User;
use Tests\DuskTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersControllerTest extends TestCase
{

//    public function testIndexPublic()
//    {
//        $user = factory(User::class, 1)->create()->first();
//        $response = $this->get('/user/' . $user->slugname);
//        $response->assertStatus(200);
//        $response->assertSee('Perfil Publico');
//    }

    public function testIndexPrivate()
    {

        $user = $this->logNewUser(new User());
        $this->assertAuthenticatedAs($user);
        $response = $this->get('/profile/' . $user->slugname);
        $response->assertSee('Mi perfil');


    }

    private function logNewUser()
    {
        $user = factory(User::class, 1)->create()->first();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret',
        ]);
        return $user;
    }


}
