<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(App\User::class, mt_rand(0, 1000))->create()->each(function (App\User $user) {
        });



        $houses = [];

        for ($i = 0; $i < sizeof($users); $i++) {
            $houses[$i] = factory(App\House::class, mt_rand(0, 2))->create(['user_id' => $users[$i]->id])->each(function (App\House $house) {
                $house->features()->sync(factory(App\Feature::class, mt_rand(1,4))->create());
            });
        }

        // Aleatoriedad para crear comentarios
        for ($i = 0; $i < sizeof($users); $i++) {
            if (mt_rand(1, 400) % 3 !== 1) {
                $ramdonHouse = ($houses[mt_rand(1, (sizeof($houses) - 1))]);
                foreach ($ramdonHouse as $house) {

                    // Si no es la propia casa del usuario se crea el comentario y la reserva
                    if ($house->user_id !== $users[$i]->id) {
                        factory(\App\Comment::class, 1)->create([
                            'user_id' => $users[$i]->id,
                            'house_id' => $house->id
                        ]);
                        factory(\App\Reserve::class,1)->create([
                            'user_id' => $users[$i]->id,
                            'house_id' => $house->id
                        ]);
                    }
                }

            }
        }



    }
}
