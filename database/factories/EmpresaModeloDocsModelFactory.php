<?php

use Faker\Generator as Faker;

$factory->define(App\Models\EmpresaModeloDocs::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'conteudo' => $faker->paragraph,
        'active' => '1',
        'empresa_id' => ''
    ];
});
