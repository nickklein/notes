<?php

use notes\Models\Notes;
use Faker\Generator as Faker;

$factory->define(Notes::class, function (Faker $faker) {
    return [
        //
        'note_title' => substr($faker->text, 0, 30),
        'note_content' => $faker->text,
        'note_caption' => $faker->text,
        'published' => 0
    ];
});