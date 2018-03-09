<?php

namespace Tests\Feature;

use App\Comment;
use App\House;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentControllerTest extends TestCase
{
    /**
     * Route::patch '/comment/update'
     * CommentController@update
     */
    public function testUpdate()
    {
        $user = $this->logNewUser(new User());
        $userId = $user->id;
        $house = factory(House::class, 1)->create(
            ['user_id' => $userId,]
        )->first();

        $comment = factory(Comment::class, 1)->create([
                'user_id' => $userId,
                'house_id' => $house->id]
        )->first();

        $this->patch('/comment/update/' . $comment->id, [
            'comment' => 'ojkhsojsdiofjsodifjsdoifjojkhsojsdiofjsodifjsdoifjojkhsojsdiofjsodifjsdoifjo
            ojkhsojsdiofjsodifjsdoifjjkhsojsdiofjsodifjsdoifj',
        ]);

        $this->assertDatabaseHas('comments', [
            'id' => $comment->id,
            'comment' => 'ojkhsojsdiofjsodifjsdoifjojkhsojsdiofjsodifjsdoifjojkhsojsdiofjsodifjsdoifjo
            ojkhsojsdiofjsodifjsdoifjjkhsojsdiofjsodifjsdoifj'
        ]);
    }

    /**
     * Route::get comment/edit
     * CommentController@edit
     */
    public function testEdit()
    {

        $user = $this->logNewUser(new User());
        $this->assertAuthenticatedAs($user);
        $response = $this->get('comment/edit');
        $response->assertSee('Identificador');

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
     *  Route::post /house/{slugname}/comment
     *  CommentController@store
     */
    public function testStore()
    {
        $user = $this->logNewUser(new User());
        $house = factory(House::class)->create(['user_id' => $user->id]);
        $this->actingAs($user);
        $this->post('/house/' . $house->slugname . '/comment', [
            'user_id' => $user->id,
            'comment' => 'ojkhsojsdiofjsodifjsdoifjojkhsojsdiofjsodifjsdoifjojkhsojsdiofjsodifjsdoifjo
            ojkhsojsdiofjsodifjsdoifjjkhsojsdiofjsodifjsdoifj'

        ]);
        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'comment' => 'ojkhsojsdiofjsodifjsdoifjojkhsojsdiofjsodifjsdoifjojkhsojsdiofjsodifjsdoifjo
            ojkhsojsdiofjsodifjsdoifjjkhsojsdiofjsodifjsdoifj'
        ]);
    }

    /**
     *  Route::post /house/{slugname}/validate
     *  CommentController@validateAjax
     */
    public function testValidateAjax()
    {
        $user = $this->logNewUser(new User());
        $house = factory(House::class)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->post('/house/' . $house->slugname . '/comment/validate', [
            'user_id' => $user->id,
            'comment' => 'ojkhsojsdiofjsodifjsdoifjojkhsojsdiofjsodifjsdoifjojkhsojsdiofjsodifjsdoifjo
            ojkhsojsdiofjsodifjsdoifjjkhsojsdiofjsodifjsdoifj'

        ]);
        dd($response);
    }
}