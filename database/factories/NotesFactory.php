<?php

use App\Notes;
use Faker\Generator as Faker;

$factory->define(Notes::class, function (Faker $faker) {
    return [
        //
        'note_title' => $faker->name,
    ];
});
