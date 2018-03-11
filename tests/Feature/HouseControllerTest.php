<?php

namespace Tests\Feature;

use App\HouseImage;
use App\User;
use App\House;
use Carbon\Carbon;
use Faker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HouseControllerTest extends TestCase
{
    /**
     * Muestra la entidad casa
     * Route::get /house/{slugname}
     * HouseController@show
     */
    public function testShow()
    {
        $user = $this->logNewUser();
        $house = factory(House::class, 1)->create(['user_id' => $user->id])->first();
        $noImageUrl = House::$NO_IMAGE_LINK;

        factory(HouseImage::class, 1)->create(
            ['house_id' => $house->id,
                'image_url' => $noImageUrl]
        );
        $response = $this->actingAs($user)->get('/house/' . $house->slugname);
        $response->assertStatus(200);
        $response->assertSee(' <form class="mt-5" action="http://reserva.test/house/');
        $user->delete();

    }

    /**
     *  Crear casa
     *  Route::post /house/{slugname}/comment
     *  CommentController@store
     */
    public function testStore()
    {
        $faker = Faker\Factory::create();
        $date = $faker->dateTimeThisDecade();
        $streetName = $faker->streetName;


        $user = $this->logNewUser();
        $response = $this->actingAs($user)->post('/add', [
            'user_id' => $user->id,
            'location' => ($faker->latitude . "/" . $faker->longitude),
            'direction' => $faker->streetAddress,
            'name' => $streetName,
            'slugname' => str_slug($streetName),
            'price_user_night' => doubleval(rand(10, 100)),
            'rating' => intval(rand(0, 10)),
            'max_users_house' => rand(1, 9),
            'description' => $faker->realText(200),
            'features' => 'wifi, bar, television, juegos, playa, montaña , coches, masajes'
        ]);
        $this->assertDatabaseHas('houses', [
            'user_id' => $user->id,
        ]);
        $user->delete();

    }

    /**
     * Muestra el menu de añadir casa
     * Route::get /add
     * HouseController@Store
     */
    public function testAdd()
    {

        $user = $this->logNewUser();
        $response = $this->actingAs($user)->get('/add');
        $response->assertSee('Añadir nueva casa');

        $user->delete();

    }

    /**
     * Destruye la entidad casa
     * Route::delete /houses/delete/{slugname}
     * HouseController@destroy
     */
    public function testDelete()
    {
        $user = $this->logNewUser();
        $house = factory(House::class)->create(['user_id' => $user->id])->first();
        $noImageUrl = House::$NO_IMAGE_LINK;


        $response = ($this->actingAs($user)->delete('profile/houses/delete/' . $house->slugname));
        $this->assertDatabaseMissing('houses', [
            'user_id' => $user->id,
            'id' => $house->id
        ]);
        $user->delete();

    }

    /**
     * Muestra las casas del usuario
     * Route::get /profiles/houses
     * HouseController@profile
     */
    public function testProfile()
    {
        $user = $this->logNewUser();
        $house = factory(House::class, 1)->create(['user_id' => $user->id])->first();
        $noImageUrl = House::$NO_IMAGE_LINK;

        factory(HouseImage::class, 1)->create(
            ['house_id' => $house->id,
                'image_url' => $noImageUrl]
        );
        $response = ($this->actingAs($user)->get('/profile/houses/'));
        $response->assertStatus(200);
        $response->assertSee($house->slugname);
        $user->delete();

    }

    /**
     * Actualiza casa
     * Route::patch '/house/update/{id}'
     * HouseController@update
     */
    public function testUpdate()
    {

        $user = $this->logNewUser();
        $userId = $user->id;
        $house = factory(House::class, 1)->create(
            ['user_id' => $userId,]
        )->first();
        $noImageUrl = House::$NO_IMAGE_LINK;

        factory(HouseImage::class, 1)->create(
            ['house_id' => $house->id,
                'image_url' => $noImageUrl]
        );

        $this->patch('/house/update/' . $house->id, [
            'price_user_night' => 19.90
        ]);

        $this->assertDatabaseHas('houses', [
            'id' => $house->id,
            'price_user_night' => 19.90
        ]);
        $user->delete();

    }

    /**
     * Edita casa
     * Route::edit '/house/edit/{id}'
     * HouseController@edit
     */
    public function testEdit()
    {
        gc_collect_cycles();
        $noImageUrl = House::$NO_IMAGE_LINK;


        $user = $this->logNewUser();
        $house = factory(House::class, 1)->create(
            ['user_id' => $user->id,]
        )->first();
        $image = factory(HouseImage::class, 1)->create(
            ['house_id' => $house->id,
                'image_url' => $noImageUrl]
        );

        $response = $this->actingAs($user)
            ->get('house/edit/' . $house->id);
        $response->assertSee($house->name);
        $user->delete();

    }

    /**
     * Funcion  interna que crea, logea y devuelve a un usuario
     */
    protected function logNewUser()
    {
        $user = factory(User::class, 1)->create()->first();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret',
        ]);
        return $user;
    }
}
