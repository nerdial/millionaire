<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() :array
    {
        return [
            'title' => $this->generateMeaninglessOption(),
            'is_correct' => false
        ];
    }

    public function generateMeaninglessOption() :string
    {
        return $this->faker->word(2);
    }
}
