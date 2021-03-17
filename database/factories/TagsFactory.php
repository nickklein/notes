<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use notes\Models\Tags;
use Faker\Generator as Faker;

class TagsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tags::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'tag_name' => substr($this->faker->text, 0, 10),
        ];
    }
}
