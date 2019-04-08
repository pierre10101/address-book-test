<?php

use App\Contacts;
use Faker\Generator as Faker;

$factory->define(Contacts::class, function (Faker $faker) {
    return [
        'name' => $faker->firstname,
        'surname' => $faker->lastname,
        'id_number' => $faker->uuid,
    ];
});
