<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(\App\Models\User::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(\App\Models\Email::class, function (\Faker\Generator $faker) {

    static $reduce = 999;

    return [
        'sender' => $faker->unique()->safeEmail,
        'recipient' => $faker->unique()->safeEmail,
        'subject' => substr($faker->sentence,0,50),
        'text' => $faker->realText(),
        'html' => $faker->paragraph,
        'created_at' => \Carbon\Carbon::now()->subSeconds($reduce--),
    ];
});


$factory->state(App\Models\Attachment::class, 'with-email', function (\Faker\Generator $faker) {

    return [
        'filename' => $faker->name,
        'created_at' => \Carbon\Carbon::now(),
        'email_id' => factory(\App\Models\Email::class)->create()->id,
    ];
});
$factory->define(App\Models\Attachment::class, function (\Faker\Generator $faker) {

    return [
        'filename' => $faker->name,
        'created_at' => \Carbon\Carbon::now(),
        'email_id' => factory(\App\Models\Email::class)->create()->id,
    ];
});
