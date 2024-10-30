<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AccessLog>
 */
class AccessLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'system_id' => 1,
            'user_id' => $this->faker->numberBetween(1, 2),
            'activity' => $this->faker->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
            'is_deleted' => false,
        ];
    }
}
