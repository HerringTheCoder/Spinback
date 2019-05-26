<?php

use Faker\Generator as Faker;

$factory->define(App\Department::class, function (Faker $faker) {
    $city = $faker->unique()->city;

    return [
        'name' => 'Spinback ' . $city,
        'city' => $city,
        'address' => $faker->address,
        'phone_number' => $faker->numberBetween(100000000, 999999999)
    ];
});
