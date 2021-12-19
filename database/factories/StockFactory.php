<?php

namespace Database\Factories;

use Faker\Provider\ar_EG\Text;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'models_id' => rand(1,100),
            'serialno' => $this->faker->uuid()
            
        ];
    }
}
