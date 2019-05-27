<?php

use Faker\Generator as Faker;

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
/*
    make random data using tinker

    php artisan tinker
    factory('App\Post')->create()

*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'body' => $faker->text,
        'user_id' => $faker->numberBetween(1, 2),
    ];
});

$factory->define(App\Problem::class, function (Faker $faker) {
    return [
        'author_id' => $faker->numberBetween(1, 2), 
        'title' => $faker->name,
        'time_limit' => $faker->numberBetween(1, 5), 
        'memory_limit' => $faker->numberBetween(100, 5000), 
        'body' => $faker->text(500),
        'input_sec' => $faker->text, 
        'output_sec' => $faker->text
    ];
});
