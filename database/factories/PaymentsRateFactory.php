<?php

$factory->define(App\PaymentsRate::class, function (Faker\Generator $faker) {
    return [
        "payment_type" => $faker->name,
        "amount" => $faker->randomNumber(2),
    ];
});
