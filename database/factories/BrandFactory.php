<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends Factory<Brand>
 */
class BrandFactory extends Factory
{
    #[ArrayShape(
        [
            'name' => "string",
            'initial_value' => "float",
            'final_value' => "float"
        ]
    )]
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'initial_value' => $this->faker->randomFloat(nbMaxDecimals: 2, max:100),
            'final_value' => $this->faker->randomFloat(nbMaxDecimals: 2, max:100)
        ];
    }
}
