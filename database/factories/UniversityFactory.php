<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(App\Universities::class, function (Faker $faker) {
    return [
        'uni_id' => Str::random(10),
        'name' => $faker->company
    ];
});
