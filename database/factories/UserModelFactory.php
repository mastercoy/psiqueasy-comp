<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'empresa_id' => '1',
        'password' => $password = bcrypt('secret'), // secret
    ];
});
