<?php

$factory->define(App\Payment::class, function (Faker\Generator $faker) {
    return [
        "payment_type" => $faker->name,
        "amount" => $faker->randomNumber(2),
        "payment_date" => $faker->date("Y-m-d", $max = 'now'),
        "created_by_id" => factory('App\User')->create(),
    ];
});
