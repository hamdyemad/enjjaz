<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Deal;
use Faker\Generator as Faker;

$factory->define(Deal::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'beneficiary_name' => $faker->sentence,
        'price' => $faker->numberBetween(10, 500)
    ];
});
