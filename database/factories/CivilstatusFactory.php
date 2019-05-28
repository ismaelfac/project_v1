<?php
use App\Modelsgenerals\Civilstatus;
use Faker\Generator as Faker;

$factory->define(Civilstatus::class, function (Faker $faker) {
    return [
        'description' => 'Soltero'
    ];
});
