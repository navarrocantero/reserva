<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\House::class, function (Faker $faker) {
    $date = $faker->dateTimeThisDecade();
    $streetName = $faker->streetName;


    return [
        'location' => ($faker->latitude."/".$faker->longitude),
        'direction' => $faker->streetAddress,
        'name' => $streetName,
        'slugname' => str_slug($streetName),
        'price_user_night' => doubleval(rand(10, 100)),
        'rating' => intval(rand(0, 10)),
        'max_users_house' => rand(1, 9),
        'description' => $faker->realText(200),
        'created_at' => Carbon::createFromTimestamp($date->getTimestamp()),
        'updated_at' => Carbon::createFromTimestamp($faker->dateTimeBetween($date, now())->getTimestamp())
    ];
});
