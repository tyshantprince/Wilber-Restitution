<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\State::class, function (Faker\Generator $faker){

    return [
        'abbr' => $faker->stateAbbr,
        'name' => $faker->state,
        'url' => $faker->url
    ];
});


$factory->define(App\Note::class, function (Faker\Generator $faker) {

    return [
        'state_id' => 1,
        'note' => $faker->paragraph(5),
    ];
});
