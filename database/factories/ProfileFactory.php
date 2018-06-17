<?php

$factory->define(App\Profile::class, function (Faker\Generator $faker) {
    return [
        "firstname" => $faker->name,
        "lastname" => $faker->name,
        "dob" => $faker->date("Y-m-d", $max = 'now'),
        "city" => $faker->name,
        "province" => $faker->name,
        "postalcode" => $faker->name,
        "phone" => $faker->name,
        "auth_user_fname" => $faker->name,
        "auth_user_lname" => $faker->name,
        "auth_user_phone" => $faker->name,
        "created_by_id" => factory('App\User')->create(),
    ];
});
