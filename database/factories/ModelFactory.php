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
$factory->define(\App\Entities\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'uuid'  =>  $faker->uuid,
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
$factory->define(\App\Entities\Account::class, function (Faker\Generator $faker) {

    return [
        'uuid'  =>  $faker->uuid,
        'name' => $faker->name,

    ];
});
$factory->define(App\Entities\Catalogs\Regime::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});
$factory->define(App\Entities\Catalogs\Contact::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});