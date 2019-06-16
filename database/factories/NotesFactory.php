<?php

use notes\Models\Notes;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Crypt;


$factory->define(Notes::class, function (Faker $faker) {
    return [
        //
        'note_title' => substr($faker->text, 0, 30),
        'note_content' => Crypt::encrypt($faker->text),
        'published' => 0
    ];
});