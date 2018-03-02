<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\HouseImage::class, function (Faker $faker) {

    return [
        'house_id'=> "2",
        'content' => 'https://picsum.photos/700/400/?image=' . mt_rand(0, 100),
    ];
});
