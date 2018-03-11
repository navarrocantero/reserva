<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Login::class, function (Faker $faker) {
    return [
        "user_ip" => $faker->ipv4,
        'user_agent'=> $faker->userAgent,
        'created_at'=> $faker->dateTimeThisYear
    ];
});
