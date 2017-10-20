<?php

use Faker\Generator as Faker;

$factory->define(App\Restaurant::class, function (Faker $faker) {
    $usersIDs = DB::table('users')->pluck('id')->toArray();
    return [
        'name'       => $faker->company,
        'manager_id' => $faker->randomElement($usersIDs),
    ];
});
