<?php

use Faker\Generator as Faker;

$factory->define(App\Models\UserModeloDocs::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'conteudo' => $faker->paragraph,
        'active' => '1',
        'user_id' => ''
    ];
});
