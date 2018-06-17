<?php

$factory->define(App\Pet::class, function (Faker\Generator $faker) {
    return [
        "tag_id" => $faker->name,
        "pet_name" => $faker->name,
        "pet_type" => collect(["dog","cat",])->random(),
        "pet_breed" => $faker->name,
        "pet_color" => $faker->name,
        "pet_age" => $faker->name,
        "pet_sex" => collect(["male","female",])->random(),
        "behaviour" => collect(["docile","aggressive",])->random(),
        "pet_size" => collect(["small","medium","large",])->random(),
        "distinctive_sign" => $faker->name,
        "microchip" => collect(["Yes","No",])->random(),
        "sprayed_neutered" => collect(["yes","no",])->random(),
        "rabies_vacc" => collect(["Yes","No",])->random(),
        "pet_status" => collect(["Active","Deceased","Lost",])->random(),
        "pay_status" => collect(["Paid","Unpaid",])->random(),
        "created_by_id" => factory('App\User')->create(),
    ];
});
