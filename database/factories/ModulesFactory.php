<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Modules;
use Faker\Generator as Faker;

$factory->define(Modules::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'description' => $faker->sentence
    ];
});
