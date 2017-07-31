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
        'body' => $faker->paragraph(5),
    ];
});

$factory->define(App\County::class, function (Faker\Generator $faker) {

    return [
        'state_id' => 1,
        'name' => 'Cook',
    ];
});

$factory->define(App\Contact::class, function (Faker\Generator $faker) {

    return [
        'user_id' => 1,
        'county_id' => 1,
        'contact_name' => $faker->name,
        'phone'  => $faker->phoneNumber,
        'ext' => '8675',
        'address1' => $faker->streetAddress,
        'address2' => $faker->streetAddress,
        'city' => $faker->city,
        'zip' => $faker->postcode,
        'fax' => $faker->phoneNumber,
        'email' => $faker->email,
        'website' => $faker->url,
        'fee' => 50.00,
        'notes' => $faker->paragraph(2)
        ];
});

