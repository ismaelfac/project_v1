<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\{User, Post};
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'title' => $faker->sentence
    ];
});
$factory->state(Post::class, 'unpublished', ['status' => 'unpublished']);
$factory->state(Post::class, 'published', ['status' => 'published']);