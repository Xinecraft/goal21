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

$factory->define(App\User::class, function (Faker $faker) {
    $users = \App\User::pluck('id');
    $tasksCount = \App\Task::where('is_active',1)->count();
    return [
        'full_name' => $faker->name,
        'uuid' => $faker->uuid,
        'username' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'phone_number' => $faker->phoneNumber,
        'last_login_ip' => $faker->ipv4,
        'status' => 1,
        'total_task_pending' => $tasksCount,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'gender' => $faker->randomElement(['M', 'F', 'O']),
        'dob' => $faker->dateTimeThisCentury(),
        'remember_token' => str_random(10),
        'referral_user_id' => $faker->randomElement($users)
    ];
});
