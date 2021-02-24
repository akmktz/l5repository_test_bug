<?php

namespace Database\Factories\Entities;

use App\Entities\Test;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Test::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'variable_parameter' => $this->faker->text,
            'immutable_parameter' => $this->faker->text,
        ];
    }
}
