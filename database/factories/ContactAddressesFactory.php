<?php

use Faker\Generator as Faker;

$factory->define(App\ContactAddresses::class, function (Faker $faker) {
    return [
        'email' =>  $faker->email,
        'contact_number' => $faker->phoneNumber
    ];
});
