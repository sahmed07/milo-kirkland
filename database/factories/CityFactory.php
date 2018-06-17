<?php

$factory->define(App\City::class, function (Faker\Generator $faker) {
    return [
        "city_name" => $faker->name,
    ];
});
