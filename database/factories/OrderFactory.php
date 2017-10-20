<?php

use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
    $usersIDs = DB::table('users')->pluck('id')->toArray();

    return [
        'user_id'          => $faker->randomElement($usersIDs),
        'shipping_address' => $faker->address,
        'is_submitted'     => $faker->boolean($chanceOfGettingTrue = 50),
    ];
});
