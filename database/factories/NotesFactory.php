<?php

use App\Models\Notes;
use Faker\Generator as Faker;

$factory->define(Notes::class, function (Faker $faker) {
    return [
        //
        'note_title' => substr($faker->text, 0, 30),
        'content' => $faker->text,
        'user_id' => rand(1, 100),
        'order' => 0
    ];
});