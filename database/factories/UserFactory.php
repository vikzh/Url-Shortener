<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Link;
use Faker\Generator as Faker;


$factory->define(Link::class, function (Faker $faker) {
    return [
        'original_url' => $faker->url,
        'code' => 1,
    ];
});
