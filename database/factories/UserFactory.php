<?php

use Faker\Generator as Faker;
use Propaganistas\LaravelPhone\PhoneNumber;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    $name = str_replace(' ', '', $faker->firstName);
    $lastName = trim($faker->lastName);
    $emailSufix = $faker->freeEmailDomain;
    $email = $name . "." . $lastName . "@" . $emailSufix;
    $username = $name . (rand(0, 100) . trim($faker->jobTitle));
    $phone = (string) PhoneNumber::make($faker->e164PhoneNumber)->ofCountry('ES');


    return [
        'name' => $name,
        'lastname' => $lastName,
        'username' => $username,
        'slugname' => str_slug($username),
        'email' => $email,
        'sex' => 'other',
        'telephone' => $phone,
        'website' => $faker->url,
        'city' => $faker->city,
        'status' => 'other',
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});
