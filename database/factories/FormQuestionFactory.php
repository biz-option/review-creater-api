<?php

namespace Database\Factories;

use App\Models\FormQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;

class FormQuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FormQuestion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'question_type' => 1, // 1: text, 2: checkbox, 3: radiobutton
        ];
    }
}
