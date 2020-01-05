<?php

use notes\Models\Notes;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Crypt;


$factory->define(Notes::class, function (Faker $faker) {
    return [
        //
        'note_title' => substr($faker->text, 0, 30),
        'note_content' => Crypt::encrypt($faker->text . $faker->text . $faker->text),
        'note_caption' => Crypt::encrypt(substr($faker->text, 0, 30)),
        'published' => 0
    ];
});