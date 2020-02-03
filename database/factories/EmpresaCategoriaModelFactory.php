<?php

use Faker\Generator as Faker;

$factory->define(App\Models\EmpresaCategoria::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'descricao' => $faker->paragraph,
        'active' => '1'
    ];
});
