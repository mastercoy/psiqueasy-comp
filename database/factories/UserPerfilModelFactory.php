<?php

use Faker\Generator as Faker;

$factory->define(App\Models\UserPerfil::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'label' => $faker->name,
        'active' => '1',
    ];
});
