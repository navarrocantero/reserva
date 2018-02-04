<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        "content" => $faker->realText(300)
    ];
});
