<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Documentation::class, function (Faker $faker) {
    $title = $faker->word;
    return [
        'title'         => $title,
        'version'       => '1.0',
        'documentation' => $faker->text,
        'slug'          => str_slug($title)
    ];
});
