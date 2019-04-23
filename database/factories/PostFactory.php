<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\{User, Post};
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
    ];
});
