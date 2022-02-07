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
            'title' => $this->generateMeaningfulQuestion(),
            'description' => $this->faker->paragraph,
            'point' => $this->faker->randomDigit()
        ];
    }

    protected function generateMeaningfulQuestion()
    {
        return $this->faker->title;
    }
}
