<?php

use Faker\Generator as Faker;

$factory->define(App\Models\UserPermissao::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'active' => '1'
    ];
});
