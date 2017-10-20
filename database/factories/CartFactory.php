<?php

use Faker\Generator as Faker;

$factory->define(App\Cart::class, function (Faker $faker) {
    $usersIDs = DB::table('users')->pluck('id')->toArray();
    return [
        'user_id' => $faker->randomElement($usersIDs),
    ];
});
