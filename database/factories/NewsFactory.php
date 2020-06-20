<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\News;
use App\User;
use Faker\Generator as Faker;

$factory->define(
    News::class,
    function (Faker $faker) {
        return [
            'title'   => $faker->title,
            'body'    => $faker->text,
            'user_id' => User::all()->random()->id
        ];
    }
);
