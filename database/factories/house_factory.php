<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\House::class, function (Faker $faker) {
    $date = $faker->dateTimeThisDecade();


    return [
        'location' => $faker->city,
        'direction' => $faker->streetAddress,
        'images' => 'http://lorempixel.com/150/150/city/' . mt_rand(0, 1000),
        'name' => $faker->streetName,
        'price_user_night' => doubleval('0.' . rand(1, 9)),
        'users_comments' => $faker->realText(200),
        'rating' => doubleval('0.' . rand(1, 9)),
        'max_users_house' => rand(1, 9),
        'features' => $faker->realText(200),
        'activities' => $faker->realText(200),
        'description' => $faker->realText(200),
        'created_at' => Carbon::createFromTimestamp($date->getTimestamp()),
        'updated_at' => Carbon::createFromTimestamp($faker->dateTimeBetween($date, now())->getTimestamp())
    ];
});
