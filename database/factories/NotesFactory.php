<?php

use notes\Models\Notes;
use Faker\Generator as Faker;
use notes\Services\Encryption;


$factory->define(Notes::class, function (Faker $faker) {
    return [
        //
        'note_title' => Encryption::encrypt(substr($faker->text, 0, 30)),
        'note_content' => Encryption::encrypt($faker->text . $faker->text . $faker->text),
        'note_caption' => Encryption::encrypt(substr($faker->text, 0, 60)),
        'published' => 0
    ];
});