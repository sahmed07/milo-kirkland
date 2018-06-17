<?php

$factory->define(App\Breed::class, function (Faker\Generator $faker) {
    return [
        "breed_title" => $faker->name,
    ];
});
