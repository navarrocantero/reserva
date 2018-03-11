<?php

use Faker\Generator as Faker;
use Carbon\Carbon as Carbon;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Feature::class, function (Faker $faker) {
    $date = $faker->dateTimeThisDecade();
    return [
        'slugname' => str_slug($faker->word . $faker->title . $faker->name),
        'created_at' => Carbon::createFromTimestamp($date->getTimestamp()),
        'updated_at' => Carbon::createFromTimestamp($faker->dateTimeBetween($date, now())->getTimestamp())
    ];
});
