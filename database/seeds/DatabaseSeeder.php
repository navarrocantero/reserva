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
        factory(App\User::class, 10)->create()->each(function (App\User $user) {

            factory(App\House::class, mt_rand(2,7))->create(['user_id' => $user->id])->each(function (App\House $house){

                factory(App\Comment::class,mt_rand(0,1))->create(['user_id'=>$house->user_id, 'house_id'=> $house->id]);
            });
        });
    }
}
