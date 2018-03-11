<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\House;
use App\Reserve;
use App\User;
use Carbon\Carbon as Carbon;
use Faker;

class ReservesControllerTest extends TestCase
{


    /**
     *   Crea reserva
     *   Route::post  house/{slugname}/confirm
     *   ReserveController@store
     */
    public function testStore()
    {
        gc_collect_cycles();

        $user = $this->logNewUser();
        $house = factory(House::class)->create(['user_id' => $user->id]);
        $date1 = Carbon::createFromTimestamp(now()->getTimestamp());
        $date2 = Carbon::createFromTimestamp($date1->addDays(20)->getTimestamp());

        $response = $this->actingAs($user)->post('/house/' . $house->slugname . '/confirm', [
            'user_id' => $user->id,
            'house_id' => $house->id,
            'entryDate' => $date1,
            'exitDate' => $date2,

        ]);

        $this->assertDatabaseHas('reserves', [
            'user_id' => $user->id,
            'house_id' => $house->id,
            'entry_date' => $date1,
            'exit_date' => $date2,
        ]);

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
     * Muestra las reservas del usuario
     * Route::get /profiles/reserves
     * CommentController@profile
     */
    public function testProfile()
    {
        $this->faker = Faker\Factory::create();

        $date = $this->faker->dateTimeThisYear()->setTime(12, 0);
        $dateTwo = $this->faker->dateTimeBetween($date, now())->setTime(20, 0);

        $user = $this->logNewUser(new User());
        $house = factory(House::class, 1)->create(['user_id' => $user->id])->first();
        $comment = factory(Reserve::class, 1)->create([
            'user_id' => $user->id,
            'house_id' => $house->id,
            'entry_date' => Carbon::createFromTimestamp($date->getTimestamp()),
            'exit_date' => Carbon::createFromTimestamp($dateTwo->getTimestamp()),
        ])->first();
        $response = ($this->actingAs($user)->get('/profile/reserves'));
        $response->assertStatus(200);
        $response->assertSee($house->slugname);
    }

    /**
     * Destruye la entidad reserva
     * Route::delete /profile/reserves/{id}
     * CommentController@destroy
     */
    public function testDelete()
    {
        $user = $this->logNewUser(new User());
        $house = factory(House::class)->create(['user_id'=>$user->id])->first();
        $reserve = factory(Reserve::class)->create([
            'user_id'=>$user->id,
            'house_id'=>$house->id
        ]);

        $response = ($this->actingAs($user)->delete('/profile/reserves/delete/'.$reserve->id));
        $this->assertDatabaseMissing('reserves', [
            'user_id'=>$user->id,
            'id'=> $reserve->id
        ]);

    }
}
