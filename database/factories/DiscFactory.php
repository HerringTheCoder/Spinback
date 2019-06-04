<?php

use Faker\Generator as Faker;
use App\Album;
use App\Department;

$factory->define(App\Disc::class, function (Faker $faker) {
    $conditions = ['', 'box slightly damaged', 'disc slightly scratched', 'perfect condition', 'in original foil', 'missing booklet'];

    return [
        'album_id' => Album::pluck('id')->random(),
        'condition' => $faker->randomElement($conditions),
        'photo_path' => '',
        'offer_price' => $faker->numberBetween(10, 200),
        'sold' => $faker->boolean(10),
        'department_id' => Department::pluck('id')->random()
    ];
});
