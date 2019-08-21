<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Movie;
use Faker\Generator as Faker;

$factory->define(Movie::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(4),
        'year' => $faker->year('now'),
        'description' => $faker->text(255)
    ];
});
