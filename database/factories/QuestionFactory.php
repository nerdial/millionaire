<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->generateMeaninglessQuestion(),
            'point' => $this->faker->numberBetween(5, 20)
        ];
    }

    protected function generateMeaninglessQuestion()
    {
        return str_replace('.', ' ?', $this->faker->sentence);
    }
}
