<?php

namespace Tests\Feature;

use App\Comment;
use App\House;
use App\User;
use Tests\TestCase;


class CommentControllerTest extends TestCase
{

    /**
     * Actualiza comentario
     * Route::patch '/comment/update'
     * CommentController@update
     */
    public function testUpdate()
    {        gc_collect_cycles();

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
     * Edita comentario
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
     *  Crea comentario
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
//
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
     * Destruye la entidad comentario
     * Route::delete /profile/comment/delete/{id}
     * CommentController@destroy
     */
    public function testDelete()
    {
        $user = $this->logNewUser(new User());
        $house = factory(House::class)->create(['user_id'=>$user->id])->first();
        $comment = factory(Comment::class)->create([
            'user_id'=>$user->id,
            'house_id'=>$house->id
        ]);
        $response = ($this->actingAs($user)->delete('/profile/comment/delete',[
            'comment-id'=>$comment->id
        ]));
        $this->assertDatabaseMissing('comments', [
            'user_id'=>$user->id,
            'id'=> $comment->id
        ]);

    }

    /**
     * Muestra las comentarios del usuario
     * Route::get /profiles/comments
     * CommentController@profile
     */
    public function testProfile()
    {
        $user = $this->logNewUser(new User());
        $house = factory(House::class, 1)->create(['user_id' => $user->id])->first();
        $comment = factory(Comment::class, 1)->create([
            'user_id' => $user->id,
            'house_id' => $house->id
        ])->first();
        $response = ($this->actingAs($user)->get('/profile/comments/'));
        $response->assertStatus(200);
        $response->assertSee($house->slugname);
    }


}