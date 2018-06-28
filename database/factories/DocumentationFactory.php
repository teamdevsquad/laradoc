<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Documentation::class, function (Faker $faker) {
    return [
        'title'         => $faker->word,
        'documentation' => $faker->text
    ];
});
