<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\House::class, function (Faker $faker) {
    $date = $faker->dateTimeThisDecade();


    return [
        'name'    => $faker->streetAddress,
        'image'     => 'http://lorempixel.com/150/150/city/'.mt_rand(0,1000),
        'created_at'=> Carbon::createFromTimestamp($date->getTimestamp()),
        'updated_at'=> Carbon::createFromTimestamp($faker->dateTimeBetween($date,now())->getTimestamp())
    ];
});
