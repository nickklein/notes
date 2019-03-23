<?php

use App\Models\Tags;
use Faker\Generator as Faker;

$factory->define(Tags::class, function (Faker $faker) {
    return [
        //
        'tag_name' => substr($faker->text, 0, 10),
    ];
});
