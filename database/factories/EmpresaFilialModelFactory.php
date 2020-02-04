<?php

use Faker\Generator as Faker;

$factory->define(App\Models\EmpresaFilial::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'empresa_id' => '1'
    ];
});
