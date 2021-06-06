<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use notes\Models\Notes;
use Faker\Generator as Faker;
use notes\Services\Encryption;

class NotesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Notes::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'note_title' => Encryption::encrypt(substr($this->faker->text, 0, 30)),
            'note_content' => Encryption::encrypt($this->faker->text . $this->faker->text . $this->faker->text),
            'note_caption' => Encryption::encrypt(substr($this->faker->text, 0, 60)),
            'published' => 0
        ];
    }
}
