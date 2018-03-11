<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\UserImage::class, function (Faker $faker) {

    return [
        'image_url' => 'https://picsum.photos/700/400/?image=' . mt_rand(0, 100),
        'image_id'=> mt_rand(0,3000),
    ];
});
