<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Model;
use App\Videos;
use App\Courses;
use App\Departments;
use App\Universities;
use Faker\Generator as Faker;

$factory->define(Videos::class, function (Faker $faker) {
    return [
        'user_id' =>' User::all()',
        'uni_id' => Universities::all(),
        'dept_id' => Departments::all(),
        'course_id' => Courses::all(),
        'title' => $faker->word,
        'description' => $faker->paragraph
    ];
});
