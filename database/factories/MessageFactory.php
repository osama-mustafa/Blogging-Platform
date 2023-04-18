<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->userName,
            'email' => $this->faker->unique()->freeEmail,
            'title' => $this->faker->sentence(3),
            'body' => $this->faker->sentence(12)
        ];
    }
}
