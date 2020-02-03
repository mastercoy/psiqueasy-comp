<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Responsavel::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'parentesco' => $faker->name,
        'end' => $faker->address,
        'active' => true,
        'user_id' => 1
    ];
});
