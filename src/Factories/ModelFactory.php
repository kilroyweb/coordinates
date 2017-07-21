<?php

$factory->define(App\Coordinate::class, function (Faker\Generator $faker) {
    return [
        'city' => $faker->city,
        'state' => strtoupper($faker->randomLetter.$faker->randomLetter),
        'zipcode' => $faker->postcode,
        'county' => $faker->city.' County',
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
    ];
});
