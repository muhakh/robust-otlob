<?php

use Faker\Generator as Faker;

$factory->define(App\MenuItem::class, function (Faker $faker) {
    $restaurantsIDs = DB::table('restaurants')->pluck('id')->toArray();
    return [
        'price'         => $faker->randomNumber(2),
        'restaurant_id' => $faker->randomElement($restaurantsIDs),
        'title'         => $faker->sentence($nbWords = 2,  $variableNbWords = true),
        'description'   => $faker->sentence($nbWords = 10, $variableNbWords = true),
    ];
});
