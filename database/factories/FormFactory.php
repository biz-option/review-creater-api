<?php

namespace Database\Factories;

use App\Models\Form;
use Illuminate\Database\Eloquent\Factories\Factory;
use Hashids\Hashids;

class FormFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Form::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $hashids = new Hashids('', 24, '0123456789ABCDEFGHIJKMLNOPQRSTUVWKYZ');
        return [
            'code' => $hashids->encode(rand()),
            'status' => 1,
        ];
    }
}
