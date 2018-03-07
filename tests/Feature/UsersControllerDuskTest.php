<?php

namespace Tests\Feature;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Chrome;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersControllerDuskTest extends DuskTestCase
{
    Use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUpdatePost()
    {

        $user = $this->logNewUser(new User());
        $this->assertAuthenticatedAs($user);
        $this->browse(function ($browser) use ($user) {
            $browser->visit('/profile')->type('username', 'pepe');
        });


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
