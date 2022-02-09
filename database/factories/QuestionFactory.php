<?php

namespace Database\Factories;

use App\Models\Question;
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
            'point' => $this->faker->numberBetween(5, 20)
        ];
    }

    protected function generateMeaningfulQuestion()
    {
        return $this->faker->title;
    }
}
