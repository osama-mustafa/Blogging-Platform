<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'body'      => $this->faker->text(40),
            'status'    => $this->faker->numberBetween(0, 1),
            'post_id'   => $this->faker->numberBetween(1, 10)
        ];
    }
}
