<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\employees_dept>
 */
class employees_deptFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'p_id' => fake()->numberBetween($min = 1, $max = 100),
            'dept_id' => fake()->numberBetween($min = 1, $max = 36),
        ];
    }
}
