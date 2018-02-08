<?php

use Faker\Generator as Faker;
use Carbon\Carbon as Carbon;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Reserve::class, function (Faker $faker) {
    $date = $faker->dateTimeThisYear()->setTime(12,0);
    $dateTwo = $faker->dateTimeBetween($date, now())->setTime(20,0);
    return [
        'entry_date' => Carbon::createFromTimestamp($date->getTimestamp()),
        'exit_date' => Carbon::createFromTimestamp($dateTwo->getTimestamp()),
    ];
});
