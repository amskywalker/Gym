<?php

namespace Database\Factories;

use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends Factory<Material>
 */
class MaterialFactory extends Factory
{


    #[ArrayShape(
        [
            'name' => "string",
            'photo' => "string",
            'quantity' => 'int',
            'available_quantity' => 'int',
            'available' => 'boolean',
        ]
    )]
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'photo' => $this->faker->image,
            'quantity' => $this->faker->randomNumber(),
            'available_quantity' => $this->faker->randomNumber(),
            'available' => true
        ];
    }
}
