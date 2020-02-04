<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Empresa::class, function (Faker $faker) {
    return [
        'cpf_cnpj' => $faker->name,
        'logo_marca' => $faker->name,

    ];
});
